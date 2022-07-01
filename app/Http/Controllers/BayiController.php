<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bumil;
use App\Models\Pasien;
use App\Models\Kader;
use App\Models\Bayi;
use App\Models\Detail_Bayi_Obat;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Detail_Bayi_Imun;
use App\Models\BBL;
use App\Models\BBP;
use App\Models\PBL;
use App\Models\PBP;



use DB;
use Auth;

class BayiController extends Controller
{

    public function index()
    {

        $title = 'Data Bayi';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBayi = 'active';

        if (session()->has('kader')) {

            // $bayi = DB::select(DB::raw('select *, bayi.id as id, pasiens.id as pasiens_id, bayi.nama as nama, pasiens.nama as orangtua from bayi join pasiens on bayi.pasien_id = pasiens.id where pasiens.posyandu_id = ' . session()->get('kader')->posyandu_id));

            $bayi = Bayi::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {

            $bayi = DB::select(DB::raw('select * from bayi'));
        }

        $dt_bayi_timbang = array();

        foreach ($bayi as $b) {

            $dt_bayi_timbang = array_merge($dt_bayi_timbang, ['bayi_' . $b->id => Detail_Bayi_Timbang::where('bayi_id', $b->id)->orderBy('bulan_ke')->get()]);
        }

        $statustmb = array();
        foreach ($dt_bayi_timbang as $key => $value) {
            $arrBulanKe = array();
            $vNow = array();
            $vNow2 = array();
            foreach ($value as $k => $v) {
                array_push($arrBulanKe, $v->bulan_ke);
                // $arrBulanKe = array_merge($arrBulanKe, ['id_' . $v->id . 'bulan_ke' . $v->bulan_ke => 1]);
                // return $arrBulanKe['id_' . $v->id . 'bulan_ke' . $v->bulan_ke];
                if ($v->sd_bb == '-3') {
                    $sd_bb = 7;
                }
                if ($v->sd_bb == '-2') {
                    $sd_bb = 6;
                }
                if ($v->sd_bb == '-1') {
                    $sd_bb = 5;
                }
                if ($v->sd_bb == 'median') {
                    $sd_bb = 4;
                }
                if ($v->sd_bb == '+1') {
                    $sd_bb = 3;
                }
                if ($v->sd_bb == '+2') {
                    $sd_bb = 2;
                }
                if ($v->sd_bb == '+3') {
                    $sd_bb = 1;
                }
                // return $v->sd_bb;

                if ($k == 0) {
                    $vNow = ['bb' => $v->berat_badan, 'sd_bb' => $sd_bb];
                } else {
                    $bln = (int) $v->bulan_ke;
                    $bln = $bln - 1;
                    if (in_array($bln, $arrBulanKe)) {
                        if ($v->berat_badan > $vNow['bb']) {
                            if ($vNow['sd_bb'] < $sd_bb) {
                                $statustmb = array_merge($statustmb, ['dt_bb_' . $v->id => 'T1']);
                            } else {
                                $statustmb = array_merge($statustmb, ['dt_bb_' . $v->id => 'N']);
                            }
                        } elseif ($v->berat_badan == $vNow['bb']) {
                            $statustmb = array_merge($statustmb, ['dt_bb_' . $v->id => 'T2']);
                        } elseif ($v->berat_badan < $vNow['bb']) {
                            $statustmb = array_merge($statustmb, ['dt_bb_' . $v->id => 'T3']);
                        } else {
                            return 'beh';
                        }
                    } else {
                        $statustmb = array_merge($statustmb, ['dt_bb_' . $v->id => 'O']);
                        // return Bayi::where('id', $v->bayi_id)->get();
                    }
                    $vNow = ['bb' => $v->berat_badan, 'sd_bb' => $sd_bb];
                }

                if ($v->sd_pb == '-3') {
                    $sd_pb = 7;
                }
                if ($v->sd_pb == '-2') {
                    $sd_pb = 6;
                }
                if ($v->sd_pb == '-1') {
                    $sd_pb = 5;
                }
                if ($v->sd_pb == 'median') {
                    $sd_pb = 4;
                }
                if ($v->sd_pb == '+1') {
                    $sd_pb = 3;
                }
                if ($v->sd_pb == '+2') {
                    $sd_pb = 2;
                }
                if ($v->sd_pb == '+3') {
                    $sd_pb = 1;
                }

                if ($k == 0) {
                    $vNow2 = ['pb' => $v->tinggi_badan, 'sd_pb' => $sd_pb];
                    // return $vNow2;
                } else {
                    $bln = (int) $v->bulan_ke;
                    $bln = $bln - 1;
                    if (in_array($bln, $arrBulanKe)) {
                        if ($v->tinggi_badan > $vNow2['pb']) {

                            if ($vNow2['sd_pb'] < $sd_pb) {
                                // return [$sd_pb, $vNow2['sd_pb']];
                                // return Bayi::where('id', $v->bayi_id)->get();
                                $statustmb = array_merge($statustmb, ['dt_pb_' . $v->id => 'T1']);
                            } else {
                                $statustmb = array_merge($statustmb, ['dt_pb_' . $v->id => 'N']);
                            }
                        } elseif ($v->tinggi_badan == $vNow2['pb']) {
                            $statustmb = array_merge($statustmb, ['dt_pb_' . $v->id => 'T2']);
                        } elseif ($v->tinggi_badan < $vNow2['pb']) {
                            $statustmb = array_merge($statustmb, ['dt_pb_' . $v->id => 'T3']);
                        } else {
                            return 'beh';
                        }
                    } else {
                        $statustmb = array_merge($statustmb, ['dt_pb_' . $v->id => 'O']);
                        // return Bayi::where('id', $v->bayi_id)->get();
                    }
                    $vNow2 = ['pb' => $v->tinggi_badan, 'sd_pb' => $sd_pb];
                }
            }
            // return $arrBulanKe;
        }
        // return count($dt_bayi_timbang);

        // return $statustmb['dt_276'];

        $dt_bayi_timbang = (object) $dt_bayi_timbang;

        return view('bayi.index', compact('title', 'sidebarPemeriksaan', 'sidebarSubBayi', 'collapsePemeriksaan', 'bayi', 'dt_bayi_timbang', 'statustmb'));
    }

    public function create()
    {
        $title = 'Data Bayi';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBayi = 'active';
        $pasien = Pasien::all();

        if (session()->has('kader')) {

            $pasien = Pasien::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }



        return view('bayi.create', compact('title', 'sidebarPemeriksaan', 'sidebarSubBayi', 'collapsePemeriksaan', 'pasien', 'list_posyandu'));
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
                "nama_ibu" => $request->nama_ibu,
                "nama_ayah" => $request->nama_ayah,
                "nama"  => $request->nama_bayi,
                "posyandu_id"  => $request->posyandu_id,
                "tanggal_lahir"   => $request->tanggal_lahir,
                "bb_pb" => $request->bb_pb,
                "l_p" => $request->jk,
                "campak"  => $request->campak,
                "meninggal" => $request->bayi_meninggal,
                "keterangan" => $request->keterangan,
            ];

            $bayi = Bayi::create($data);

            if (isset($request->bulan_ke)) {
                foreach ($request->bulan_ke as $key => $value) {
                    $data = [
                        "bayi_id" => $bayi->id,
                        "bulan_ke" => $value,
                        "bulan" => $request->bulan_timbang[$key],
                        "umur_bulan" => $request->umur_bulan[$key],
                        "umur_hari" => $request->umur_hari[$key],
                        "berat_badan" => $request->berat_badan[$key],
                        "tinggi_badan" => $request->panjang_badan[$key],
                        "sd_bb" => $request->sd_bb[$key],
                        "sd_pb" => $request->sd_pb[$key],
                        "status_bb" => $request->status_bb[$key],
                        "status_pb" => $request->status_pb[$key],
                        "tanggal" => $request->tanggal_timbang[$key]
                    ];
                    Detail_Bayi_Timbang::create($data);
                }
            }

            $sirup_fe = array();

            if (isset($request->sirup_fe)) {

                foreach ($request->sirup_fe_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->sirup_fe[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->sirup_fe_bulan_2[$key]
                    ];

                    array_push($sirup_fe, $myPush);
                }
            }


            $vit_a = array();

            if (isset($request->vit_a)) {

                foreach ($request->vit_a_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->vit_a[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->vit_a_bulan_2[$key]
                    ];

                    array_push($vit_a, $myPush);
                }
            }

            $oralit = array();

            if (isset($request->oralit)) {

                foreach ($request->oralit_tanggal as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->oralit[$key],
                        'tanggal' => $value
                    ];

                    array_push($oralit, $myPush);
                }
            }

            if (count($sirup_fe) > 0 || count($vit_a) > 0 || count($oralit) > 0) {

                $data = [
                    "bayi_id" => $bayi->id,
                    "sirup_fe" => json_encode($sirup_fe),
                    "vit_a" => json_encode($vit_a),
                    "oralit" => json_encode($oralit)
                ];

                Detail_Bayi_Obat::create($data);
            }

            $hbo = array();

            if (isset($request->hbo)) {

                foreach ($request->hbo_tanggal as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->hbo[$key],
                        'tanggal' => $value
                    ];

                    array_push($hbo, $myPush);
                }
            }

            $bcg = array();

            if (isset($request->bcg)) {

                foreach ($request->bcg_tanggal as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->bcg[$key],
                        'tanggal' => $value
                    ];

                    array_push($bcg, $myPush);
                }
            }


            $dpthb = array();

            if (isset($request->dpthb)) {

                foreach ($request->dpthb_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->dpthb[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->dpthb_bulan_2[$key],
                        'bulan_ke_3' => $request->dpthb_bulan_3[$key]
                    ];

                    array_push($dpthb, $myPush);
                }
            }

            $polio = array();

            if (isset($request->polio)) {

                foreach ($request->polio_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->polio[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->polio_bulan_2[$key],
                        'bulan_ke_3' => $request->polio_bulan_3[$key],
                        'bulan_ke_4' => $request->polio_bulan_4[$key]
                    ];

                    array_push($polio, $myPush);
                }
            }

            if (count($hbo) > 0 || count($bcg) > 0 || count($dpthb) > 0 || count($polio) > 0) {

                $data = [
                    "bayi_id" => $bayi->id,
                    "hbo" => json_encode($hbo),
                    "bcg" => json_encode($bcg),
                    "dpt_hb" => json_encode($dpthb),
                    "polio" => json_encode($polio)
                ];

                Detail_Bayi_Imun::create($data);
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

    public function detail_timbang($id)
    {
        return Detail_Bayi_Timbang::where('bayi_id', $id)->get();
    }

    public function detail($id)
    {
        $title = 'Data Bayi';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBayi = 'active';

        // $bayi = Bayi::select('*', 'bayi.id as id', 'pasiens.id as pasiens_id', 'bayi.nama as nama', 'pasiens.nama as orangtua')->join('pasiens', 'bayi.pasien_id', 'pasiens.id')->where('bayi.id', $id)->first();

        $bayi = Bayi::where('id', $id)->first();

        $bayi_timbang = Detail_Bayi_Timbang::where('bayi_id', $id)->orderBy('bulan_ke')->get();
        $bayi_obat = Detail_Bayi_Obat::where('bayi_id', $id)->first();

        if (isset($bayi_obat->sirup_fe)) {
            $sirup_fe = json_decode($bayi_obat->sirup_fe, true);
        } else {
            $sirup_fe = [];
        }
        if (isset($bayi_obat->vit_a)) {
            $vit_a = json_decode($bayi_obat->vit_a, true);
        } else {
            $vit_a = [];
        }
        if (isset($bayi_obat->oralit)) {
            $oralit = json_decode($bayi_obat->oralit, true);
        } else {
            $oralit = [];
        }

        $bayi_imun = Detail_Bayi_Imun::where('bayi_id', $id)->first();

        if (isset($bayi_imun->hbo)) {
            $hbo = json_decode($bayi_imun->hbo, true);
        } else {
            $hbo = [];
        }
        if (isset($bayi_imun->bcg)) {
            $bcg = json_decode($bayi_imun->bcg, true);
        } else {
            $bcg = [];
        }
        if (isset($bayi_imun->dpthb)) {
            $dpthb = json_decode($bayi_imun->dpthb, true);
        } else {
            $dpthb = [];
        }
        if (isset($bayi_imun->polio)) {
            $polio = json_decode($bayi_imun->polio, true);
        } else {
            $polio = [];
        }

        if ($bayi->l_p == 1) {

            $antropometri_bb = BBL::all();
            $antropometri_pb = PBL::all();
        } else {

            $antropometri_bb = BBP::all();
            $antropometri_pb = PBP::all();
        }

        return view('bayi.detail', compact('title', 'sidebarPemeriksaan', 'sidebarSubBayi', 'collapsePemeriksaan', 'bayi', 'bayi_timbang', 'bayi_obat', 'sirup_fe', 'vit_a', 'oralit', 'hbo', 'bcg', 'dpthb', 'polio', 'antropometri_bb', 'antropometri_pb'));
    }



    public function edit($id)
    {
        $title = 'Data Bayi';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubBayi = 'active';

        // $bayi = Bayi::select('*', 'bayi.id as id', 'pasiens.id as pasiens_id', 'bayi.nama as nama', 'pasiens.nama as orangtua')->join('pasiens', 'bayi.pasien_id', 'pasiens.id')->where('bayi.id', $id)->first();

        $bayi = Bayi::where('id', $id)->first();

        if (session()->has('kader')) {

            $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }

        $bayi_timbang = Detail_Bayi_Timbang::where('bayi_id', $id)->get();
        $bayi_obat = Detail_Bayi_Obat::where('bayi_id', $id)->first();

        if (isset($bayi_obat->sirup_fe)) {
            $sirup_fe = json_decode($bayi_obat->sirup_fe, true);
        } else {
            $sirup_fe = [];
        }
        if (isset($bayi_obat->vit_a)) {
            $vit_a = json_decode($bayi_obat->vit_a, true);
        } else {
            $vit_a = [];
        }
        if (isset($bayi_obat->oralit)) {
            $oralit = json_decode($bayi_obat->oralit, true);
        } else {
            $oralit = [];
        }

        $bayi_imun = Detail_Bayi_Imun::where('bayi_id', $id)->first();

        if (isset($bayi_imun->hbo)) {
            $hbo = json_decode($bayi_imun->hbo, true);
        } else {
            $hbo = [];
        }
        if (isset($bayi_imun->bcg)) {
            $bcg = json_decode($bayi_imun->bcg, true);
        } else {
            $bcg = [];
        }
        if (isset($bayi_imun->dpt_hb)) {
            $dpthb = json_decode($bayi_imun->dpt_hb, true);
        } else {
            $dpthb = [];
        }
        if (isset($bayi_imun->polio)) {
            $polio = json_decode($bayi_imun->polio, true);
        } else {
            $polio = [];
        }

        return view('bayi.edit', compact('title', 'sidebarPemeriksaan', 'sidebarSubBayi', 'collapsePemeriksaan', 'bayi', 'bayi_timbang', 'bayi_obat', 'sirup_fe', 'vit_a', 'oralit', 'hbo', 'bcg', 'dpthb', 'polio', 'list_posyandu'));
    }



    public function update(Request $request, $id)
    {

        try {

            Detail_Bayi_Imun::where('bayi_id', $id)->delete();
            Detail_Bayi_Obat::where('bayi_id', $id)->delete();
            Detail_Bayi_Timbang::where('bayi_id', $id)->delete();
            // Bayi::where('id', $id)->delete();


            $data = [
                "pasien_id" => $request->pasien_id,
                "nama_ibu"  => $request->nama_ibu,
                "nama_ayah"  => $request->nama_ayah,
                "posyandu_id"  => $request->posyandu_id,
                "nama"  => $request->nama,
                "tanggal_lahir"   => $request->tanggal_lahir,
                "bb_pb" => $request->bb_pb,
                "l_p" => $request->jk,
                "campak"  => $request->campak,
                "meninggal" => $request->bayi_meninggal,
                "keterangan" => $request->keterangan,
            ];

            Bayi::find($id)->update($data);
            $bayi = Bayi::find($id);
            if (isset($request->bulan_ke)) {
                foreach ($request->bulan_ke as $key => $value) {
                    $data = [
                        "bayi_id" => $bayi->id,
                        "bulan_ke" => $value,
                        "bulan" => $request->bulan_timbang[$key],
                        "umur_bulan" => $request->umur_bulan[$key],
                        "umur_hari" => $request->umur_hari[$key],
                        "berat_badan" => $request->berat_badan[$key],
                        "tinggi_badan" => $request->panjang_badan[$key],
                        "sd_bb" => $request->sd_bb[$key],
                        "sd_pb" => $request->sd_pb[$key],
                        "status_bb" => $request->status_bb[$key],
                        "status_pb" => $request->status_pb[$key],
                        "tanggal" => $request->tanggal_timbang[$key]
                    ];
                    Detail_Bayi_Timbang::create($data);
                }
            }

            $sirup_fe = array();

            if (isset($request->sirup_fe)) {

                foreach ($request->sirup_fe_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->sirup_fe[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->sirup_fe_bulan_2[$key]
                    ];

                    array_push($sirup_fe, $myPush);
                }
            }


            $vit_a = array();

            if (isset($request->vit_a)) {

                foreach ($request->vit_a_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->vit_a[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->vit_a_bulan_2[$key]
                    ];

                    array_push($vit_a, $myPush);
                }
            }

            $oralit = array();

            if (isset($request->oralit)) {

                foreach ($request->oralit_tanggal as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->oralit[$key],
                        'tanggal' => $value
                    ];

                    array_push($oralit, $myPush);
                }
            }

            if (count($sirup_fe) > 0 || count($vit_a) > 0 || count($oralit) > 0) {

                $data = [
                    "bayi_id" => $bayi->id,
                    "sirup_fe" => json_encode($sirup_fe),
                    "vit_a" => json_encode($vit_a),
                    "oralit" => json_encode($oralit)
                ];

                Detail_Bayi_Obat::create($data);
            }

            $hbo = array();

            if (isset($request->hbo)) {

                foreach ($request->hbo_tanggal as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->hbo[$key],
                        'tanggal' => $value
                    ];

                    array_push($hbo, $myPush);
                }
            }

            $bcg = array();

            if (isset($request->bcg)) {

                foreach ($request->bcg_tanggal as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->bcg[$key],
                        'tanggal' => $value
                    ];

                    array_push($bcg, $myPush);
                }
            }


            $dpthb = array();

            if (isset($request->dpthb)) {

                foreach ($request->dpthb_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->dpthb[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->dpthb_bulan_2[$key],
                        'bulan_ke_3' => $request->dpthb_bulan_3[$key]
                    ];

                    array_push($dpthb, $myPush);
                }
            }

            $polio = array();

            if (isset($request->polio)) {

                foreach ($request->polio_bulan_1 as $key => $value) {

                    $myPush = [
                        'tahun_ke' => $request->polio[$key],
                        'bulan_ke_1' => $value,
                        'bulan_ke_2' => $request->polio_bulan_2[$key],
                        'bulan_ke_3' => $request->polio_bulan_3[$key],
                        'bulan_ke_4' => $request->polio_bulan_4[$key]
                    ];

                    array_push($polio, $myPush);
                }
            }

            if (count($hbo) > 0 || count($bcg) > 0 || count($dpthb) > 0 || count($polio) > 0) {

                $data = [
                    "bayi_id" => $bayi->id,
                    "hbo" => json_encode($hbo),
                    "bcg" => json_encode($bcg),
                    "dpt_hb" => json_encode($dpthb),
                    "polio" => json_encode($polio)
                ];

                Detail_Bayi_Imun::create($data);
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

            Detail_Bayi_Obat::where('bayi_id', $id)->delete();
            Detail_Bayi_Imun::where('bayi_id', $id)->delete();
            Detail_Bayi_Timbang::where('bayi_id', $id)->delete();
            Bayi::where('id', $id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return 'Data memiliki relasi dengan data lain, hapus akun terlebih dahulu';
        }

        return 'success';
    }
}
