<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Posyandu;
use App\Models\Bumil;
use App\Models\Bayi;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Detail_Bumil_Timbang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $title = 'laporan';
        $laporan = 'active';
        $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));


        if (session()->has('kader')) {
            $list_posyandu = DB::select(DB::raw("select * from list_posyandu where id = " . session()->get('kader')->posyandu_id));
        }
        // $bumil = Bumil::where('posyandu_id', 18)->get();
        $bumils = Bumil::all();
        $bayi = Bayi::all();
        // return $bumils;
        $jenis = [1, 2];
        return view('laporan.index', compact('title', 'laporan', 'list_posyandu', 'bumils', 'jenis', 'bayi'));
    }


    public function print(Request $request)
    {
        // $bumils = Bumil::where('posyandu_id', $request->posyandu_id)->get();
        if ($request->posyandu_id == 0) {
            $bumils = Bumil::all();
            $bayi = Bayi::all();
        } else {
            $bumils = Bumil::where('posyandu_id', $request->posyandu_id)->get();
            $bayi = Bayi::where('posyandu_id', $request->posyandu_id)->get();
        }

        if ($request->type_id == 0) {
            $jenis = [1, 2];
        }
        if ($request->type_id == 1) {
            $jenis = [1];
        }
        if ($request->type_id == 2) {
            $jenis = [2];
        }
        $pdf = PDF::loadview('laporan.bumil', ['bumils' => $bumils, 'bayi' => $bayi, 'jenis' => $jenis])->setPaper('a3', 'landscape');
        return $pdf->download('laporan_posyandu.pdf');
    }
}
