<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\Bumil;
use App\Models\Detail_Bayi_Timbang;
use Illuminate\Http\Request;

class LaporanRegistrasi extends Controller
{
    public function bayi($id_posyandu, $tahun, $bulan_dari = 0, $bulan_sampai = 0)
    {
        $query = Bayi::query();

        if ($id_posyandu != 0) {
            $query->where('posyandu_id', $id_posyandu);
        }
        if ($tahun != 0) {
            $query->whereYear('tanggal_lahir', $tahun);
        }
        if ($bulan_dari != 0 && $bulan_sampai != 0) {
            $query->whereMonth('tanggal_lahir', '>=', $bulan_dari)
                  ->whereMonth('tanggal_lahir', '<=', $bulan_sampai);
        } elseif ($bulan_dari != 0) {
            $query->whereMonth('tanggal_lahir', '>=', $bulan_dari);
        }

        $bayi = $query->get();

        return view('laporan.laporan_registrasi.print_bayi', [
            'id_posyandu'  => $id_posyandu,
            'tahun'        => $tahun,
            'bulan_dari'   => $bulan_dari,
            'bulan_sampai' => $bulan_sampai,
            'bayi'         => $bayi,
        ]);
    }

    public function bumil($id_posyandu, $tahun, $bulan_dari = 0, $bulan_sampai = 0)
    {
        $query = Bumil::query();

        if ($id_posyandu != 0) {
            $query->where('posyandu_id', $id_posyandu);
        }
        if ($tahun != 0) {
            $query->whereYear('tanggal', $tahun);
        }
        if ($bulan_dari != 0 && $bulan_sampai != 0) {
            $query->whereMonth('tanggal', '>=', $bulan_dari)
                  ->whereMonth('tanggal', '<=', $bulan_sampai);
        } elseif ($bulan_dari != 0) {
            $query->whereMonth('tanggal', '>=', $bulan_dari);
        }

        $bumil = $query->get();

        return view('laporan.laporan_registrasi.print_bumil', [
            'id_posyandu'  => $id_posyandu,
            'tahun'        => $tahun,
            'bulan_dari'   => $bulan_dari,
            'bulan_sampai' => $bulan_sampai,
            'bumils'       => $bumil,
        ]);
    }
}
