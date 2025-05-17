<?php

namespace App\Http\Controllers;

use App\Models\Kehamilan;
use App\Models\Kelahiran;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pasien = Pasien::query()->count();
        $kehamilan = Kehamilan::query()->count();
        $kunjungan = Kunjungan::query()->count();
        $kelahiran = Kelahiran::query()->count();
        return view('dashboard', compact('pasien', 'kehamilan', 'kunjungan', 'kelahiran'));
    }
}
