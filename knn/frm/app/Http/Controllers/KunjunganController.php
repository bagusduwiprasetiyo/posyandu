<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Kehamilan;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Toastr;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data = Kunjungan::with(['pasien', 'kehamilan'])->get();
//        dd($data);
        $data = Kehamilan::with('pasien', 'kunjunganTerakhir')->get();

        return view('admin.kunjungan.index', compact('data'));
    }

    public function kunjunganPasienDetail($pasien, $kehamilan)
    {
        $data = Kunjungan::where(['pasien_id' => $pasien, 'kehamilan_id' => $kehamilan])->get();
//        dd($data);
        return view('admin.kunjungan.detail', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kunjungan.create');
    }

    public function tambah(Pasien $pasien, Kehamilan $kehamilan)
    {
//        dd($kehamilan);
        $title = 'Tambah Data Kunjungan (' . $pasien->rekam_medik . ' - ' . $pasien->nama_ibu . ')';
        return view('admin.kunjungan.create', compact('pasien', 'kehamilan', 'title'));
    }

    public function hitungKNN($pasien, $kehamilan, $kunjungan)
    {
//        $semua = Kehamilan::with('kunjunganTerakhir')->where('pasien_id','!=', $pasien)->where('id','!=', $kehamilan)->get();
//        dd($semua);

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
            }
            $hasil = Hasil::with('pasien')->get();
            $hasil_k = Hasil::with('pasien')->orderBy('jarak', 'asc')->limit(7)->get();
            $kesimpulan = Hasil::with('pasien')->orderBy('jarak', 'asc')->first();
            Kunjungan::where('id', $kunjungan)->update(['jarak_knn' => $kesimpulan->jarak, 'resiko_knn' => $kesimpulan->kspr]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function store(Request $request)
    {
        $datakunjungan = [
            "pasien_id" => $request->pasien_id,
            "kehamilan_id" => $request->kehamilan_id,
            "bengkak_muka" => $request->bengkak_muka,
            "hidraniom" => $request->hidraniom,
            "bayi_mati" => $request->bayi_mati,
            "lebih_bulan" => $request->lebih_bulan,
            "sungsang" => $request->sungsang,
            "lintang" => $request->lintang,
            "pendarahan" => $request->pendarahan,
            "peb" => $request->peb,
            "catatan" => $request->catatan,
        ];
        $kunjungan = Kunjungan::create($datakunjungan);
        $skor = hitungSkorKSPR($request->kehamilan_id, $kunjungan->id);
        $resiko = resikoKSPR($skor);
        $kunjungan->update([
            "skor_akhir" => $skor,
            "resiko" => $resiko
        ]);
        $this->hitungKNN($request->pasien_id, $request->kehamilan_id, $kunjungan->id);
        Toastr::success('Data Berhasil Disimpan');
        return redirect()->route('pasien.kunjungan', [$request->pasien_id, $request->kehamilan_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
