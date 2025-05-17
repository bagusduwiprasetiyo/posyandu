<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bumil;
use App\Models\Pasien;
use App\Models\Kader;
use App\Models\Detail_Bumil_TD;
use App\Models\Detail_Bumil_TT;
use App\Models\Detail_Bumil_Timbang;
use App\Models\Relasi_Bayi;
use App\Models\Relasi_Bumil;
use DB;
use Auth;

class BumilController extends Controller
{

    public function index()
    {
        $title = 'Data Ibu Hamil';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBumil = 'active';

        // if (session()->has('kader')) {

        //     $bumils = DB::select(DB::raw("select *, bumils.id as id, pasiens.id as id_pasien from bumils join pasiens on bumils.pasien_id = pasiens.id where pasiens.posyandu_id = " . session()->get('kader')->posyandu_id));
        // } else {

        //     $bumils = DB::select(DB::raw("select *, bumils.id as id, pasiens.id as id_pasien from bumils join pasiens on bumils.pasien_id = pasiens.id"));
        // }

        if (session()->has('kader')) {

            $bumils = DB::select(DB::raw("select * from bumils where bumils.posyandu_id = " . session()->get('kader')->posyandu_id));
        } else {

            $bumils = DB::select(DB::raw("select * from bumils"));
        }


        $dt_bumil_td = array();

        foreach ($bumils as $key => $value) {

            $dt_bumil_td = array_merge($dt_bumil_td, ['pasien_id_' . $value->id => Detail_Bumil_TD::where('bumils_id', $value->id)->get()]);
        }

        $dt_bumil_td = (object) $dt_bumil_td;

        $dt_bumil_tt = array();

        foreach ($bumils as $key => $value) {


            $dt_bumil_tt = array_merge($dt_bumil_tt, ['pasien_id_' . $value->id => Detail_Bumil_TT::where('bumils_id', $value->id)->get()]);
        }

        $dt_bumil_tt = (object) $dt_bumil_tt;

        $dt_bumil_timbang = array();

        foreach ($bumils as $key => $value) {

            $dt_bumil_timbang = array_merge($dt_bumil_timbang, ['pasien_id_' . $value->id => Detail_Bumil_Timbang::where('bumils_id', $value->id)->get()]);
        }

        $dt_bumil_timbang = (object) $dt_bumil_timbang;

        return view('bumil.index', compact('bumils', 'title', 'sidebarPemeriksaan', 'sidebarSubBumil', 'bumils', 'collapsePemeriksaan', 'dt_bumil_td', 'dt_bumil_timbang', 'dt_bumil_tt'));
    }

    public function create()
    {
        $title = 'Data Ibu Hamil';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBumil = 'active';
        $bumils = Bumil::all();
        if (session()->has('kader')) {
            $pasien = Pasien::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {
            $pasien = Pasien::all();
        }
        if (session()->has('kader')) {

            $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }
        return view('bumil.create', compact('bumils', 'title', 'sidebarPemeriksaan', 'sidebarSubBumil', 'list_posyandu', 'pasien', 'collapsePemeriksaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = [
                "pasien_id" => $request->pasien_id,
                "posyandu_id" => $request->posyandu_id,
                "nama_ibu" => $request->nama_ibu,
                "nama_suami" => $request->nama_suami,
                "umur" => $request->umur,
                "klp_dasa_wisma" => $request->klp_dasa_wisma,
                "tanggal" => $request->tanggal,
                "umur_kelahiran" => $request->umur_kelahiran,
                "hamil_ke" => $request->hamil_ke,
                "lila" => $request->lila,
                "pmt_pemulihan" => $request->pmt_pemulihan,
                "kapsul_yodium" => isset($request->kapsul_yodium) ? 1 : NULL,
                "resiko" => $request->resiko,
                "nama_bayi" => $request->nama_bayi,
                "bayi" => $request->bayi,
                "bayi_meninggal" => $request->bayi_meninggal,
                "persalinan" => isset($request->ditolong_oleh) ? $request->ditolong_oleh : NULL,
                "tanggal_persalinan" => $request->tanggal_persalinan,
                "menyusui" => $request->menyusui,
                "berhenti_menyusui" => $request->berhenti_menyusui,
                "ibu_meninggal" => $request->ibu_meninggal,
                "keterangan" => $request->keterangan,
            ];

            $bumil = Bumil::create($data);

            if (isset($request->tanggal_tambah_darah)) {
                foreach ($request->tanggal_tambah_darah as $key => $value) {
                    $data = [
                        "bumils_id" => $bumil->id,
                        "status" => $request->status_tambah_darah[$key],
                        "tanggal" => $value
                    ];
                    Detail_Bumil_TD::create($data);
                }
            }

            if (isset($request->imunisasi_tt)) {
                foreach ($request->imunisasi_tt as $key => $value) {
                    $data = [
                        "bumils_id" => $bumil->id,
                        "status" => $request->status_imunisasi_tt[$key],
                        "tanggal" => $value
                    ];
                    Detail_Bumil_TT::create($data);
                }
            }

            if (isset($request->bulan_timbang)) {
                foreach ($request->bulan_timbang as $key => $value) {

                    $data = [
                        "bumils_id" => $bumil->id,
                        "bulan_ke" => $request->bulan_ke[$key],
                        "bulan" => $value,
                        "berat_badan" => $request->berat_badan[$key],
                        "tekanan_darah" => $request->tekanan_darah[$key],
                        "tanggal" => $request->tanggal_timbang[$key]
                    ];

                    Detail_Bumil_Timbang::create($data);
                }
            }
        } catch (Exception $e) {

            return $e;
        }

        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $title = 'Data Ibu Hamil';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBumil = 'active';


        $bumils = Bumil::select('*')->where('bumils.id', $id)->first();

        if (session()->has('kader')) {

            if ($bumils->posyandu_id != session()->get('kader')->posyandu_id) {

                return url('/bumil');
            }
        }


        $dt_bumil_td = Detail_Bumil_TD::where('bumils_id', $bumils->id)->get();

        $dt_bumil_tt = Detail_Bumil_TT::where('bumils_id', $bumils->id)->get();

        $dt_bumil_timbang = Detail_Bumil_Timbang::where('bumils_id', $bumils->id)->get();




        return view('bumil.detail', compact('bumils', 'title', 'sidebarPemeriksaan', 'sidebarSubBumil', 'bumils', 'collapsePemeriksaan', 'dt_bumil_td', 'dt_bumil_timbang', 'dt_bumil_tt'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Data Ibu Hamil';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBumil = 'active';

        // $bumils = Bumil::select('*', 'bumils.id as id', 'pasiens.id as pasien_id')->join('pasiens', 'bumils.pasien_id', 'pasiens.id')->where('bumils.id', $id)->first();

        $bumils = Bumil::where('id', $id)->first();

        if (session()->has('kader')) {

            $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {

            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }

        if (session()->has('kader')) {

            if ($bumils->posyandu_id != session()->get('kader')->posyandu_id) {

                return url('/bumil');
            }
        }


        $dt_bumil_td = Detail_Bumil_TD::where('bumils_id', $bumils->id)->get();

        $dt_bumil_tt = Detail_Bumil_TT::where('bumils_id', $bumils->id)->get();

        $dt_bumil_timbang = Detail_Bumil_Timbang::where('bumils_id', $bumils->id)->get();

        return view('bumil.edit', compact('bumils', 'title', 'sidebarPemeriksaan', 'sidebarSubBumil', 'bumils', 'collapsePemeriksaan', 'dt_bumil_td', 'dt_bumil_timbang', 'dt_bumil_tt', 'list_posyandu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Detail_Bumil_TD::where('bumils_id', $id)->delete();
            Detail_Bumil_TT::where('bumils_id', $id)->delete();
            Detail_Bumil_Timbang::where('bumils_id', $id)->delete();
            $data = [
                "pasien_id" => $request->pasien_id,
                "posyandu_id" => $request->posyandu_id,
                "nama_ibu" => $request->nama_ibu,
                "nama_suami" => $request->nama_suami,
                "umur" => $request->umur,
                "klp_dasa_wisma" => $request->klp_dasa_wisma,
                "tanggal" => $request->tanggal,
                "umur_kelahiran" => $request->umur_kelahiran,
                "hamil_ke" => $request->hamil_ke,
                "lila" => $request->lila,
                "pmt_pemulihan" => $request->pmt_pemulihan,
                "kapsul_yodium" => isset($request->kapsul_yodium) ? 1 : NULL,
                "resiko" => $request->resiko,
                "nama_bayi" => $request->nama_bayi,
                "bayi" => $request->bayi,
                "bayi_meninggal" => $request->bayi_meninggal,
                "persalinan" => isset($request->ditolong_oleh) ? $request->ditolong_oleh : NULL,
                "tanggal_persalinan" => $request->tanggal_persalinan,
                "ibu_meninggal" => $request->ibu_meninggal,
                "menyusui" => $request->menyusui,
                "berhenti_menyusui" => $request->berhenti_menyusui,
                "keterangan" => $request->keterangan
            ];
            Bumil::find($id)->update($data);
            $bumil = Bumil::find($id);

            if (isset($request->tanggal_tambah_darah)) {
                foreach ($request->tanggal_tambah_darah as $key => $value) {
                    $data = [
                        "bumils_id" => $bumil->id,
                        "status" => $request->status_tambah_darah[$key],
                        "tanggal" => $value
                    ];
                    Detail_Bumil_TD::create($data);
                }
            }

            if (isset($request->imunisasi_tt)) {
                foreach ($request->imunisasi_tt as $key => $value) {
                    $data = [
                        "bumils_id" => $bumil->id,
                        "status" => $request->status_imunisasi_tt[$key],
                        "tanggal" => $value
                    ];
                    Detail_Bumil_TT::create($data);
                }
            }

            if (isset($request->bulan_timbang)) {
                foreach ($request->bulan_timbang as $key => $value) {

                    $data = [
                        "bumils_id" => $bumil->id,
                        "bulan_ke" => $request->bulan_ke[$key],
                        "bulan" => $value,
                        "berat_badan" => $request->berat_badan[$key],
                        "tekanan_darah" => $request->tekanan_darah[$key],
                        "tanggal" => $request->tanggal_timbang[$key]
                    ];

                    Detail_Bumil_Timbang::create($data);
                }
            }
        } catch (Exception $e) {

            return $e;
        }

        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            Detail_Bumil_TD::where('bumils_id', $id)->delete();
            Detail_Bumil_TT::where('bumils_id', $id)->delete();
            Detail_Bumil_Timbang::where('bumils_id', $id)->delete();
            Relasi_Bumil::where('bumils_id', $id)->delete();
            Bumil::where('id', $id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return 'Data memiliki relasi dengan data lain, hapus akun terlebih dahulu';
        }

        return 'success';
    }
}
