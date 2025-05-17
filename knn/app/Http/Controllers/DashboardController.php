<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Kader;
use App\Models\Bayi;
use App\Models\Bumil;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Users;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $sidebarDashboard = 'active';
        $pasiens = Pasien::all();
        $countPasien = Pasien::all()->count();
        $countKader = Kader::all()->count();
        $countBumil = Bumil::all()->count();
        $countBayi = Bayi::all()->count();
        // $countKader = Kader::all()->count();

        if (Auth::user()->status == 2) {

            session(['kader' => Kader::where('users_id', Auth::user()->id)->first()]);
        }
        $pasiendata = null;

        if (Auth::user()->status == 3) {
            $pasiendata = Users::where('id', Auth::user()->id)->first();
            session(['pasien' => $pasiendata]);
        }


        if (session()->has('kader')) {
            $countBumil = Bumil::where('posyandu_id', session()->get('kader')->posyandu_id)->count();
            $countBayi = Bayi::where('posyandu_id', session()->get('kader')->posyandu_id)->count();
        }


        return view('dashboard.index', compact('title', 'sidebarDashboard', 'pasiens', 'countPasien', 'countKader', 'countBumil', 'countBayi', 'pasiendata'));
    }
}
