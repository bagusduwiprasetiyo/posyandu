<?php

namespace App\Http\Controllers;

use DB;

class RujukanController extends Controller
{
    private function topic($title, $pdf, $page, $summary)
    {
        return compact('title', 'pdf', 'page', 'summary');
    }

    public function index()
    {
        $title = 'Rujukan';
        $sidebarRujukan = 'active';
        $bayiGiziBuruk = $this->bayiGiziBuruk();
        $bayiStunting = $this->bayiStunting();
        $bumilRisikoTinggi = $this->bumilRisikoTinggi();
        $topics = [
            $this->topic('Rujukan Proses Melahirkan', 'Buku_KIA_2024.pdf', 13, 'Jika muncul tanda bahaya pada proses melahirkan, petugas kesehatan segera merujuk ibu ke Rumah Sakit.'),
            $this->topic('Tanda Bahaya Kehamilan Trimester 1', 'Buku_KIA_2024.pdf', 6, 'Tanda bahaya pada masa kehamilan perlu segera diperiksa di Puskesmas atau Rumah Sakit.'),
            $this->topic('Tanda Bahaya Kehamilan Trimester 2', 'Buku_KIA_2024.pdf', 10, 'Tanda bahaya trimester 2 perlu ditangani cepat agar kondisi ibu dan janin tidak memburuk.'),
            $this->topic('Tanda Bahaya Kehamilan Trimester 3', 'Buku_KIA_2024.pdf', 12, 'Trimester akhir perlu pemantauan ketat dan persiapan rujukan bila ada tanda bahaya.'),
            $this->topic('Rujukan Setelah Melahirkan/Nifas', 'Buku_KIA_2024.pdf', 15, 'Jika ada tanda bahaya setelah melahirkan, ibu perlu segera diperiksa di Puskesmas atau Rumah Sakit.'),
            $this->topic('Rujukan Persalinan 2020', 'Buku KIA-2020-Bagian-Ibu.pdf', 29, 'Buku KIA 2020 menegaskan persalinan dengan tanda bahaya harus segera dirujuk ke Rumah Sakit.'),
        ];

        return view('rujukan.index', compact('title', 'sidebarRujukan', 'topics', 'bayiGiziBuruk', 'bayiStunting', 'bumilRisikoTinggi'));
    }

    public function apiBayiGiziBuruk()
    {
        return response()->json([
            'status' => true,
            'data' => $this->bayiGiziBuruk(),
        ]);
    }

    public function apiBumilRisikoTinggi()
    {
        return response()->json([
            'status' => true,
            'data' => $this->bumilRisikoTinggi(),
        ]);
    }

    public function apiBayiStunting()
    {
        return response()->json([
            'status' => true,
            'data' => $this->bayiStunting(),
        ]);
    }

    private function bayiGiziBuruk()
    {
        $latest = DB::table('detail_bayi_timbang')
            ->select('bayi_id', DB::raw('MAX(bulan_ke) as bulan_ke'))
            ->groupBy('bayi_id');

        $query = DB::table('detail_bayi_timbang as t')
            ->joinSub($latest, 'latest', function ($join) {
                $join->on('t.bayi_id', '=', 'latest.bayi_id')
                    ->on('t.bulan_ke', '=', 'latest.bulan_ke');
            })
            ->join('bayi as b', 'b.id', '=', 't.bayi_id')
            ->leftJoin('list_posyandu as p', 'p.id', '=', 'b.posyandu_id')
            ->join('bpb as a', function ($join) {
                $join->whereRaw("a.jenis_kelamin = IF(b.l_p = 1, 'Laki-laki', 'Perempuan')")
                    ->whereRaw("a.jenis_ukur = IF(t.umur_bulan <= 24, 'PB', 'TB')")
                    ->whereRaw('CAST(a.min3 AS DECIMAL(8,2)) = ROUND(CAST(t.tinggi_badan AS DECIMAL(8,2)) * 2) / 2');
            })
            ->whereRaw('CAST(t.berat_badan AS DECIMAL(8,2)) < CAST(a.min2 AS DECIMAL(8,2))')
            ->select(
                'b.id as bayi_id',
                'b.nama',
                'b.nama_ibu',
                'b.tanggal_lahir',
                'b.posyandu_id',
                'p.nama as posyandu',
                DB::raw("IF(b.l_p = 1, 'Laki-laki', 'Perempuan') as jenis_kelamin"),
                't.bulan_ke',
                't.bulan',
                't.umur_bulan',
                't.umur_hari',
                't.berat_badan',
                't.tinggi_badan',
                DB::raw('a.min2 as batas_gizi_buruk'),
                DB::raw("'Gizi buruk' as status_rujukan")
            )
            ->orderBy('p.nama')
            ->orderBy('b.nama');

        if ($this->kaderPosyanduId()) {
            $query->where('b.posyandu_id', $this->kaderPosyanduId());
        }

        return $query->get();
    }

    private function bayiStunting()
    {
        $latest = DB::table('detail_bayi_timbang')
            ->select('bayi_id', DB::raw('MAX(bulan_ke) as bulan_ke'))
            ->groupBy('bayi_id');

        $query = DB::table('detail_bayi_timbang as t')
            ->joinSub($latest, 'latest', function ($join) {
                $join->on('t.bayi_id', '=', 'latest.bayi_id')
                    ->on('t.bulan_ke', '=', 'latest.bulan_ke');
            })
            ->join('bayi as b', 'b.id', '=', 't.bayi_id')
            ->leftJoin('list_posyandu as p', 'p.id', '=', 'b.posyandu_id')
            ->where(function ($query) {
                $query->whereIn('t.sd_pb', ['-3', '-2'])
                    ->orWhere('t.status_pb', 'like', '%pendek%')
                    ->orWhere('t.status_pb', 'like', '%stunted%');
            })
            ->select(
                'b.id as bayi_id',
                'b.nama',
                'b.nama_ibu',
                'b.tanggal_lahir',
                'b.posyandu_id',
                'p.nama as posyandu',
                DB::raw("IF(b.l_p = 1, 'Laki-laki', 'Perempuan') as jenis_kelamin"),
                't.bulan_ke',
                't.bulan',
                't.umur_bulan',
                't.umur_hari',
                't.tinggi_badan',
                't.sd_pb',
                't.status_pb',
                DB::raw("IF(t.sd_pb = '-3', 'Sangat pendek', 'Pendek') as status_rujukan")
            )
            ->orderBy('p.nama')
            ->orderBy('b.nama');

        if ($this->kaderPosyanduId()) {
            $query->where('b.posyandu_id', $this->kaderPosyanduId());
        }

        return $query->get();
    }

    private function kaderPosyanduId()
    {
        if (!request()->hasSession() || !session()->has('kader')) {
            return null;
        }

        return session()->get('kader')->posyandu_id;
    }

    private function bumilRisikoTinggi()
    {
        $kspr = DB::table('kspr_screening as s')
            ->leftJoin('kspr_screening_detail as d', 'd.kspr_screening_id', '=', 's.id')
            ->leftJoin('bumils as b', 'b.id', '=', 's.bumils_id')
            ->leftJoin('list_posyandu as p', 'p.id', '=', 'b.posyandu_id')
            ->select(
                's.id as kspr_screening_id',
                's.bumils_id as bumil_id',
                DB::raw('COALESCE(b.nama_ibu, s.nama) as nama_ibu'),
                DB::raw('COALESCE(b.umur, s.umur) as umur'),
                DB::raw('COALESCE(b.hamil_ke, s.hamil_ke) as hamil_ke'),
                'b.posyandu_id',
                'p.nama as posyandu',
                DB::raw('COALESCE(SUM(d.value), 0) + 2 as skor_kspr'),
                DB::raw("IF(COALESCE(SUM(d.value), 0) + 2 > 12, 'KRST', 'KRT') as kategori_kspr"),
                DB::raw("'KSPR' as sumber_risiko"),
                DB::raw("'Skor KSPR >= 6' as alasan")
            )
            ->groupBy('s.id', 's.bumils_id', 's.nama', 's.umur', 's.hamil_ke', 'b.nama_ibu', 'b.umur', 'b.hamil_ke', 'b.posyandu_id', 'p.nama')
            ->havingRaw('COALESCE(SUM(d.value), 0) + 2 >= 6');

        if ($this->kaderPosyanduId()) {
            $kspr->where('b.posyandu_id', $this->kaderPosyanduId());
        }

        $items = [];

        foreach ($kspr->get() as $row) {
            $key = $row->bumil_id ? 'b' . $row->bumil_id : 'k' . $row->kspr_screening_id;
            $items[$key] = (object) [
                'bumil_id' => $row->bumil_id,
                'kspr_screening_id' => $row->kspr_screening_id,
                'nama_ibu' => $row->nama_ibu,
                'umur' => $row->umur,
                'hamil_ke' => $row->hamil_ke,
                'posyandu_id' => $row->posyandu_id,
                'posyandu' => $row->posyandu,
                'skor_kspr' => $row->skor_kspr,
                'kategori_kspr' => $row->kategori_kspr,
                'sumber_risiko' => 'KSPR',
                'alasan' => $row->alasan,
            ];
        }

        return array_values($items);
    }
}
