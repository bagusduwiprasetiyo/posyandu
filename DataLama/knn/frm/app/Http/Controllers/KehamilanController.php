<?php

namespace App\Http\Controllers;

use App\Models\Kehamilan;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Toastr;
use Illuminate\Http\Request;

class KehamilanController extends Controller
{
    public function index()
    {
        $row = Kehamilan::with('kunjunganTerakhir')->first();
        return view('admin.kehamilan.index', compact('row'));
    }

    public function create($id = null)
    {
        $data = Pasien::all();
        $title = 'Tambah Data Kehamilan';
        $pasien = '';
        $cek_kunjungan = '';
        if ($id != null) {
            $pasien = Pasien::with('kunjungans')->where('id', $id)->first();
            $title = 'Tambah data Kehamilan (' . $pasien->rekam_medik . ' - ' . $pasien->nama_ibu . ')';
        }
        return view('admin.kehamilan.create', compact('data', 'id', 'title', 'pasien'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $kehamilan = [
            "pasien_id" => $request->pasien_id,
            "usia_ibu" => $request->usia_ibu,
            "usia_kehamilan" => $request->usia_kehamilan,
            "hamil_ke" => $request->hamil_ke,
            "berat_badan" => $request->berat_badan,
            "tinggi_badan" => $request->tinggi_badan,
            "lila" => $request->lila,
            "hb" => $request->hb,
            "tesni_a" => $request->tesni_a,
            "tesni_b" => $request->tesni_b,
            "jarak_hamil" => $request->jarak_hamil,
            "imunisasi" => $request->imunisasi,
            "tgl_imunisasi" => $request->tgl_imunisasi,
            "buku_kia" => $request->buku_kia,
            "skor_awal" => 2,
            "terlalu_muda_hamil" => $request->terlalu_muda_hamil,
            "terlalu_tua_hamil" => $request->terlalu_tua_hamil,
            "lambat_hamil_pertama" => $request->lambat_hamil_pertama,
            "lama_hamil_lagi" => $request->lama_hamil_lagi,
            "cepat_hamil_lagi" => $request->cepat_hamil_lagi,
            "banyak_anak" => $request->banyak_anak,
            "umur_terlalu_tua" => $request->umur_terlalu_tua,
            "terlalu_pendek" => $request->terlalu_pendek,
            "gagal_hamil" => $request->gagal_hamil,
            "lahir_vakum" => $request->lahir_vakum,
            "lahir_dirogoh" => $request->lahir_dirogoh,
            "lahir_transfusi" => $request->lahir_transfusi,
            "pernah_sesar" => $request->pernah_sesar,
            "penyakit_kurang_darah" => $request->penyakit_kurang_darah,
            "penyakit_malaria" => $request->penyakit_malaria,
            "penyakit_tbc" => $request->penyakit_tbc,
            "penyakit_jantung" => $request->penyakit_jantung,
            "penyakit_kencing_manis" => $request->penyakit_kencing_manis,
            "penyakit_pms" => $request->penyakit_pms,
            "hamil_kembar" => $request->hamil_kembar
        ];
        $in_kehamilan = Kehamilan::create($kehamilan);

        $skor = 2 +
            $request->terlalu_muda_hamil +
            $request->terlalu_tua_hamil +
            $request->lambat_hamil_pertama +
            $request->lama_hamil_lagi +
            $request->cepat_hamil_lagi +
            $request->banyak_anak +
            $request->umur_terlalu_tua +
            $request->terlalu_pendek +
            $request->gagal_hamil +
            $request->lahir_vakum +
            $request->lahir_dirogoh +
            $request->lahir_transfusi +
            $request->pernah_sesar +
            $request->penyakit_kurang_darah +
            $request->penyakit_malaria +
            $request->penyakit_tbc +
            $request->penyakit_jantung +
            $request->penyakit_kencing_manis +
            $request->penyakit_pms +
            $request->hamil_kembar +
            $request->bengkak_muka +
            $request->hidraniom +
            $request->bayi_mati +
            $request->lebih_bulan +
            $request->sungsang +
            $request->lintang +
            $request->pendarahan +
            $request->peb;
        if ($skor < 6) {
            $kspr = 'KRR';
        } elseif ($skor >= 6 and $skor <= 10) {
            $kspr = 'KRT';
        } else {
            $kspr = 'KRST';
        }
        $kunjungan = [
            "pasien_id" => $request->pasien_id,
            "kehamilan_id" => $in_kehamilan->id,
            "bengkak_muka" => $request->bengkak_muka,
            "hidraniom" => $request->hidraniom,
            "bayi_mati" => $request->bayi_mati,
            "lebih_bulan" => $request->lebih_bulan,
            "sungsang" => $request->sungsang,
            "lintang" => $request->lintang,
            "pendarahan" => $request->pendarahan,
            "peb" => $request->peb,
            "catatan" => $request->catatan,
            "skor_akhir" => $skor,
            "resiko" => $kspr
        ];
        Kunjungan::create($kunjungan);
        Toastr::success('Data Berhasil Disimpan');
        return redirect()->route('pasien.show', $request->pasien_id);
    }
}
