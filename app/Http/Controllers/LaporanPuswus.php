<?php

namespace App\Http\Controllers;

use App\Models\Puswus;
use DateTime;
use Illuminate\Http\Request;

class LaporanPuswus extends Controller
{
    public function index($id_posyandu, $tahun, $bulan = 0)
    {
        $title = 'Laporan Puswus Posyandu';
        $sidebarLaporan = 'active';
        $collapseLaporan = 'show';
        $sidebarlaporanpuswus = 'active';

        // return $laporan = $this->jml($id_posyandu, $tahun, $bulan);
        $laporan = $this->jml($id_posyandu, $tahun, $bulan);

        return view('laporan.laporan_puswus.index', [
            'title' => $title,
            'sidebarLaporan' => $sidebarLaporan,
            'collapseLaporan' => $collapseLaporan,
            'sidebarlaporanpuswus' => $sidebarlaporanpuswus,
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,
            'bulan' => $bulan,
            'laporan' => $laporan
        ]);
    }

    public function jml($id_posyandu, $tahun, $bulan = 0)
    {
        $data = array();

        if ($tahun == 0) {
            $tahun = date('Y');
        }

        $query = Puswus::query();
        if ($id_posyandu != 0) {
            $query->where('posyandu_id', $id_posyandu);
        }
        if ($tahun != 0) {
            $query->whereYear('created_at', $tahun);
        }
        if ($bulan != 0) {
            $query->whereMonth('created_at', $bulan);
        }
        $puswus = $query->get();

        foreach ($puswus as $key => $value) {
            if (date('Y') < date('Y', strtotime($value->tgl_lahir_wuspus  . '+49year'))) {
                $value->imunisasi = json_decode($value->imunisasi);
                if (isset($value->imunisasi->imunisasi_tt)) {
                    $value->key_imunisasi = array_keys((array) $value->imunisasi->imunisasi_tt);
                } else {
                    $value->key_imunisasi = [];
                }

                $value->kb = json_decode($value->kb);
                //hitung umur wus
                if ($value->tgl_lahir_wuspus != '' && $value->tgl_lahir_wuspus != NULL) {
                    $date = new
                        DateTime($value->tgl_lahir_wuspus);

                    $now = new DateTime();
                    $umur = $date->diff($now)->format('%y
                    Tahun');
                } else {
                    $umur = '';
                }
                $value->tgl_lahir_wuspus = $umur;

                //hitung umur  pus
                if ($value->tgl_lahir_suami != '' && $value->tgl_lahir_suami != NULL) {
                    $date = new
                        DateTime($value->tgl_lahir_suami);

                    $now = new DateTime();
                    $umur = $date->diff($now)->format('%y
                    Tahun');
                } else {
                    $umur = '';
                }
                $value->tgl_lahir_suami = $umur;

                array_push($data, $value);
            }
        }

        return $data;
    }

    public function keterangan(Request $request)
    {
        // return $request;
        try {
            $year = date('Y', strtotime($request->tahun));
            // return Laporan::whereYear('tanggal', $year)->get();
            $laporan = Laporan::whereYear('tanggal', $year)->where('posyandu_id', $request->posyandu_id)->where('laporan', 'puswus');

            if ($laporan->count() > 0) {
                $laporan->delete();
            }

            Laporan::create([
                'posyandu_id' => $request->posyandu_id,
                'laporan' => 'puswus]',
                'tanggal' => date('Y-m-d', strtotime($request->tahun)),
                'keterangan' => json_encode([
                    'petugas' => $request->petugas,
                    'keterangan_laporan' => $request->keterangan_laporan
                ])
            ]);
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
    }

    public function print($id_posyandu, $tahun, $bulan = 0)
    {
        $laporan = $this->jml($id_posyandu, $tahun, $bulan);
        return view('laporan.laporan_puswus.print_puswus', [
            'laporan' => $laporan,
            'tahun' => $tahun,
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,
            'bulan' => $bulan,

        ]);
    }
}
