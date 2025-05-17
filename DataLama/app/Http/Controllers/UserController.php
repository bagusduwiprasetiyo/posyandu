<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Bumil;
use App\Models\Bayi;
use App\Models\Detail_Bayi_Obat;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Detail_Bayi_Imun;
use App\Models\BBL;
use App\Models\BBP;
use App\Models\PBL;
use App\Models\PBP;
use App\Models\Detail_Bumil_TD;
use App\Models\Detail_Bumil_TT;
use App\Models\Detail_Bumil_Timbang;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $title = 'User';
        $userDataDiri = 'active';
        $pasiendata = Pasien::where('users_id', auth()->user()->id)->first();
        return view('user.index', compact('title', 'userDataDiri', 'pasiendata'));
    }

    public function kehamilan()
    {
        $title = 'User';
        $userDataKehamilan = 'active';
        // $pasiendata = Pasien::where('users_id', auth()->user()->id)->first();

        // $bumils = DB::select(DB::raw("select *, bumils.id as id, pasiens.id as id_pasien from bumils join pasiens on bumils.pasien_id = pasiens.id where bumils.pasien_id = " . $pasiendata->id));

        $bumils = DB::select(DB::raw("select * from relasi_bumil join bumils on bumils.id = relasi_bumil.bumils_id where relasi_bumil.users_id = " . session()->get('pasien')->id));

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


        return view('user.kehamilan', compact('title', 'userDataKehamilan', 'bumils', 'dt_bumil_td', 'dt_bumil_timbang', 'dt_bumil_tt'));
    }

    public function detail_kehamilan($id)
    {
        $title = 'User';
        $userDataKehamilan = 'active';


        // $bumils = Bumil::select('*', 'bumils.id as id', 'pasiens.id as pasien_id')->join('pasiens', 'bumils.pasien_id', 'pasiens.id')->where('bumils.id', $id)->first();

        $bumils = Bumil::find($id);

        if (session()->has('kader')) {

            if ($bumils->posyandu_id != session()->get('kader')->posyandu_id) {

                return url('/bumil');
            }
        }


        $dt_bumil_td = Detail_Bumil_TD::where('bumils_id', $bumils->id)->get();

        $dt_bumil_tt = Detail_Bumil_TT::where('bumils_id', $bumils->id)->get();

        $dt_bumil_timbang = Detail_Bumil_Timbang::where('bumils_id', $bumils->id)->get();




        return view('user.detail_kehamilan', compact('title', 'userDataKehamilan', 'bumils', 'dt_bumil_td', 'dt_bumil_timbang', 'dt_bumil_tt'));
    }


    public function bayi()
    {
        $title = 'Bayi';
        $userDataBayi = 'active';
        // $bayi = DB::select(DB::raw('select *, bayi.id as id, pasiens.id as pasiens_id, bayi.nama as nama, pasiens.nama as orangtua from bayi join pasiens on bayi.pasien_id = pasiens.id where bayi.pasien_id = ' . session()->get('pasien')->id));

        $bayi = DB::select(DB::raw("select * from relasi_bayi join bayi on bayi.id = relasi_bayi.bayi_id where relasi_bayi.users_id = " . session()->get('pasien')->id));

        $dt_bayi_timbang = array();

        foreach ($bayi as $b) {

            $dt_bayi_timbang = array_merge($dt_bayi_timbang, ['bayi_' . $b->id => Detail_Bayi_Timbang::where('bayi_id', $b->id)->get()]);
        }

        $dt_bayi_timbang = (object) $dt_bayi_timbang;

        return view('user.bayi', compact('title', 'userDataBayi', 'bayi', 'dt_bayi_timbang'));
    }

    public function detail_bayi($id)
    {
        $title = 'Bayi';
        $userDataBayi = 'active';
        // $bayi = Bayi::select('*', 'bayi.id as id', 'pasiens.id as pasiens_id', 'bayi.nama as nama', 'pasiens.nama as orangtua')->join('pasiens', 'bayi.pasien_id', 'pasiens.id')->where('bayi.id', $id)->first();

        $bayi = Bayi::find($id);
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

        return view('user.detail_bayi', compact('title', 'userDataBayi', 'bayi', 'bayi_timbang', 'bayi_obat', 'sirup_fe', 'vit_a', 'oralit', 'hbo', 'bcg', 'dpthb', 'polio', 'antropometri_bb', 'antropometri_pb'));
    }
}
