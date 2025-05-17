<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\Bumil;
use App\Models\Detail_Bayi_Timbang;
use Illuminate\Http\Request;

class LaporanRegistrasi extends Controller
{
    public function bayi($id_posyandu, $tahun)
    {
        if ($id_posyandu == 0) {
            $bayi = Bayi::all();
        } else {

            $bayi = Bayi::where('posyandu_id', $id_posyandu)->get();
        }
        $test_arr = array();
        for ($i = 0; $i < 60; $i++) {
            $test_arr[] = $i;
        }

        return view('laporan.laporan_registrasi.print_bayi', [
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,
            'bayi' => $bayi
        ]);
    }

    public function bumil($id_posyandu, $tahun)
    {
        if ($id_posyandu == 0) {
            $bumil = Bumil::all();
        } else {

            $bumil = Bumil::where('posyandu_id', $id_posyandu)->get();
        }
        $test_arr = array();
        for ($i = 0; $i < 60; $i++) {
            $test_arr[] = $i;
        }

        return view('laporan.laporan_registrasi.print_bumil', [
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,
            'bumils' => $bumil
        ]);
    }
}
