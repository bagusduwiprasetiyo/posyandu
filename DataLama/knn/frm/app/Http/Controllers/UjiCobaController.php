<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Kehamilan;
use App\Models\Kunjungan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UjiCobaController extends Controller
{

    public function hitung($req)
    {
        $request = $req;
//        dd($request);
        $data = Kehamilan::with('pasien', 'kunjunganTerakhir')->get();
        $hasil = Hasil::with('pasien')->orderBy('jarak', 'asc')->get();
        $kesimpulan = Hasil::with('pasien')->orderBy('jarak', 'asc')->first();
        return view('admin.knn.hitung', compact('data', 'hasil', 'kesimpulan', 'request'));
    }

    public function formProses()
    {
        return view('admin.coba.form-proses');
    }

    public function proses(Request $request)
    {
        // skor awal 2
        $data = Kehamilan::with('pasien', 'kunjunganTerakhir')->get();
        foreach ($data as $isi) {
            $j = sqrt(
                pow(($isi->usia_ibu - $request->usia_ibu), 2)
                + pow(($isi->usia_kehamilan - $request->usia_kehamilan), 2)
                + pow(($isi->hamil_ke - $request->hamil_ke), 2)
                + pow(($isi->berat_badan - $request->berat_badan), 2)
                + pow(($isi->tinggi_badan - $request->tinggi_badan), 2)
                + pow(($isi->lila - $request->lila), 2)
                + pow(($isi->hb - $request->hb), 2)
                + pow(($isi->tesni_a - $request->tesni_a), 2)
                + pow(($isi->tesni_b - $request->tesni_b), 2)
                + pow(($isi->jarak_hamil - $request->jarak_hamil), 2)
                + pow(($isi->lambat_hamil_pertama - $request->lambat_hamil_pertama), 2)
                + pow(($isi->gagal_hamil - $request->gagal_hamil), 2)
                + pow(($isi->lahir_vakum - $request->lahir_vakum), 2)
                + pow(($isi->lahir_dirogoh - $request->lahir_dirogoh), 2)
                + pow(($isi->lahir_transfusi - $request->lahir_transfusi), 2)
                + pow(($isi->pernah_sesar - $request->pernah_sesar), 2)
                + pow(($isi->penyakit_kurang_darah - $request->penyakit_kurang_darah), 2)
                + pow(($isi->penyakit_malaria - $request->penyakit_malaria), 2)
                + pow(($isi->penyakit_tbc - $request->penyakit_tbc), 2)
                + pow(($isi->penyakit_jantung - $request->penyakit_jantung), 2)
                + pow(($isi->penyakit_kencing_manis - $request->penyakit_kencing_manis), 2)
                + pow(($isi->penyakit_pms - $request->penyakit_pms), 2)
                + pow(($isi->hamil_kembar - $request->hamil_kembar), 2)
            );
            Kehamilan::where('pasien_id', $isi->pasien_id)->update(['jarak' => $j]);
        }
        Hasil::truncate();
        $d = Kehamilan::with('pasien', 'kunjunganTerakhir')->get();
        foreach ($d as $isi) {
            Hasil::create([
                    'pasien_id' => $isi->kunjunganTerakhir->pasien_id,
                    'kehamilan_id' => $isi->kunjunganTerakhir->kehamilan_id,
                    'jarak' => $isi->jarak,
                    'kspr' => $isi->kunjunganTerakhir->resiko
                ]
            );
        }
        $r = $request->all();
        $data_uji = '';
        $data = Kehamilan::with('pasien', 'kunjunganTerakhir')->get();
        $hasil = Hasil::with('pasien')->get();
        $hasil_k = Hasil::with('pasien')->orderBy('jarak', 'asc')->limit($request->k)->get();
        $kesimpulan = Hasil::with('pasien')->orderBy('jarak', 'asc')->first();
        return view('admin.knn.hitung', compact('data', 'hasil', 'kesimpulan', 'r', 'hasil_k', 'data_uji'));
    }

    public function ujiKNN($pasien, $kehamilan, $kunjungan)
    {
        $data_uji = Kehamilan::with('kunjunganTerakhir')->where('pasien_id', $pasien)->where('id', $kehamilan)->first();
        $data = Kehamilan::with('kunjunganTerakhir')->where('pasien_id', '!=', $pasien)->where('id', '!=', $kehamilan)->get();
        try {
            DB::beginTransaction();
            Hasil::truncate();

            foreach ($data as $isi) {
                $j = sqrt(
                    pow(($isi->usia_ibu - $data_uji->usia_ibu), 2)
                    + pow(($isi->usia_kehamilan - $data_uji->usia_kehamilan), 2)
                    + pow(($isi->hamil_ke - $data_uji->hamil_ke), 2)
                    + pow(($isi->berat_badan - $data_uji->berat_badan), 2)
                    + pow(($isi->tinggi_badan - $data_uji->tinggi_badan), 2)
                    + pow(($isi->lila - $data_uji->lila), 2)
                    + pow(($isi->hb - $data_uji->hb), 2)
                    + pow(($isi->tesni_a - $data_uji->tesni_a), 2)
                    + pow(($isi->tesni_b - $data_uji->tesni_b), 2)
                    + pow(($isi->jarak_hamil - $data_uji->jarak_hamil), 2)
                    + pow(($isi->lambat_hamil_pertama - $data_uji->lambat_hamil_pertama), 2)
                    + pow(($isi->gagal_hamil - $data_uji->gagal_hamil), 2)
                    + pow(($isi->lahir_vakum - $data_uji->lahir_vakum), 2)
                    + pow(($isi->lahir_dirogoh - $data_uji->lahir_dirogoh), 2)
                    + pow(($isi->lahir_transfusi - $data_uji->lahir_transfusi), 2)
                    + pow(($isi->pernah_sesar - $data_uji->pernah_sesar), 2)
                    + pow(($isi->penyakit_kurang_darah - $data_uji->penyakit_kurang_darah), 2)
                    + pow(($isi->penyakit_malaria - $data_uji->penyakit_malaria), 2)
                    + pow(($isi->penyakit_tbc - $data_uji->penyakit_tbc), 2)
                    + pow(($isi->penyakit_jantung - $data_uji->penyakit_jantung), 2)
                    + pow(($isi->penyakit_kencing_manis - $data_uji->penyakit_kencing_manis), 2)
                    + pow(($isi->penyakit_pms - $data_uji->penyakit_pms), 2)
                    + pow(($isi->hamil_kembar - $data_uji->hamil_kembar), 2)
                    + pow(($isi->kunjunganTerakhir->bengkak_muka - $data_uji->kunjunganTerakhir->bengkak_muka), 2)
                    + pow(($isi->kunjunganTerakhir->hidraniom - $data_uji->kunjunganTerakhir->hidraniom), 2)
                    + pow(($isi->kunjunganTerakhir->bayi_mati - $data_uji->kunjunganTerakhir->bayi_mati), 2)
                    + pow(($isi->kunjunganTerakhir->lebih_bulan - $data_uji->kunjunganTerakhir->lebih_bulan), 2)
                    + pow(($isi->kunjunganTerakhir->sungsang - $data_uji->kunjunganTerakhir->sungsang), 2)
                    + pow(($isi->kunjunganTerakhir->lintang - $data_uji->kunjunganTerakhir->lintang), 2)
                    + pow(($isi->kunjunganTerakhir->pendarahan - $data_uji->kunjunganTerakhir->pendarahan), 2)
                    + pow(($isi->kunjunganTerakhir->peb - $data_uji->kunjunganTerakhir->peb), 2)
                );
                Hasil::create([
                        'pasien_id' => $isi->kunjunganTerakhir->pasien_id,
                        'kehamilan_id' => $isi->kunjunganTerakhir->kehamilan_id,
                        'jarak' => $j,
                        'kspr' => $isi->kunjunganTerakhir->resiko
                    ]
                );
//            echo $j . '<br>';

//            Kehamilan::where('pasien_id', $isi->pasien_id)->update(['jarak' => $j]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        $r = '';
        $data = Kehamilan::with('pasien', 'kunjunganTerakhir')->get();
        $hasil = Hasil::with('pasien')->get();
        $hasil_k = Hasil::with('pasien')->orderBy('jarak', 'asc')->limit(7)->get();
        $kesimpulan = Hasil::with('pasien')->orderBy('jarak', 'asc')->first();
        Kunjungan::where('id', $kunjungan)->update(['jarak_knn' => $kesimpulan->jarak, 'resiko_knn' => $kesimpulan->kspr]);
        return view('admin.knn.hitung', compact('data', 'hasil', 'kesimpulan', 'r', 'hasil_k', 'data_uji'));
    }
}
