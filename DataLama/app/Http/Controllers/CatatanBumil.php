<?php

namespace App\Http\Controllers;

use App\Models\Bumil;
use App\Models\Laporan;
use Illuminate\Http\Request;

class CatatanBumil extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_posyandu, $tahun)
    {
        $title = 'Laporan Kegiatan Posyandu';
        $sidebarLaporan = 'active';
        $collapseLaporan = 'show';
        $sidebarcatatanbumil = 'active';
        if ($id_posyandu != 0) {
            $bumil = Bumil::whereYear('tanggal', $tahun)->where('posyandu_id', $id_posyandu)->get();
        } else {
            $bumil = Bumil::whereYear('tanggal', $tahun)->get();
        }
        $keterangan = Laporan::where('laporan', 'catatan_bumil')->where('posyandu_id', $id_posyandu)->whereYear('tanggal', $tahun)->first();
        if (isset($keterangan->id)) {
            $keterangan = json_decode($keterangan->keterangan);
        }
        return view(
            'laporan.catatan_bumil.index',
            [
                'title' => $title,
                'sidebarLaporan' => $sidebarLaporan,
                'collapseLaporan' => $collapseLaporan,
                'sidebarcatatanbumil' => $sidebarcatatanbumil,
                'id_posyandu' => $id_posyandu,
                'tahun' => $tahun,
                'laporan' => $bumil,
                'keterangan' => $keterangan
            ]
        );
    }
    public function keterangan(Request $request)
    {
        try {
            $year = date('Y', strtotime($request->tahun));
            $laporan = Laporan::whereYear('tanggal', $year)->where('posyandu_id', $request->posyandu_id)->where('laporan', 'catatan_bumil');

            if ($laporan->count() > 0) {
                $laporan->delete();
            }

            Laporan::create([
                'posyandu_id' => $request->posyandu_id,
                'laporan' => 'catatan_bumil',
                'tanggal' => date('Y-m-d', strtotime($request->tahun)),
                'keterangan' => json_encode($request->keterangan_laporan)
            ]);
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
    }

    public function print($id_posyandu, $tahun)
    {
        if ($id_posyandu != 0) {
            $bumil = Bumil::whereYear('tanggal', $tahun)->where('posyandu_id', $id_posyandu)->get();
        } else {
            $bumil = Bumil::whereYear('tanggal', $tahun)->get();
        }
        $keterangan = Laporan::where('laporan', 'catatan_bumil')->where('posyandu_id', $id_posyandu)->whereYear('tanggal', $tahun)->first();
        if (isset($keterangan->id)) {
            $keterangan = json_decode($keterangan->keterangan);
        }
        return view('laporan.catatan_bumil.print', [
            'laporan' => $bumil,
            'keterangan' => $keterangan,
            'tahun' => $tahun,
            'id_posyandu' => $id_posyandu,
        ]);
    }
}
