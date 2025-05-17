<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BBL;
use App\Imports\BBLImport;
use App\Models\PBL;
use App\Imports\PBLImport;
use App\Models\BBP;
use App\Imports\BBPImport;
use App\Models\PBP;
use App\Imports\PBPImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class AntropometriController extends Controller
{
    
    public function antropometri_bbl()
    {
        $title = 'Antropometri';
        $sidebarAntropometri = 'active';
        $collapseAntropometri = 'show';
        $sidebarSubBBL = 'active';
        $bbl = BBL::all();
        return view('antropometri.bbl', compact('title', 'sidebarAntropometri', 'collapseAntropometri', 'sidebarSubBBL', 'bbl'));
    }

    public function import_excel_bbl(Request $request) 
    {
        try {
            

            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);

            BBL::truncate();
     
            $file = $request->file('file');
     
            Excel::import(new BBLImport, $file);

        } catch (\Illuminate\Database\QueryException $e) {

            session()->flash('gagal', 'Gagal mengimport data, Perhatikan format yang diupload');

            return redirect('/antropometri_bbl');
        }
        
        session()->flash('sukses', 'Berhasil Mengimport Data');

        return redirect('/antropometri_bbl');
    }

    public function antropometri_pbl()
    {
        $title = 'Antropometri';
        $sidebarAntropometri = 'active';
        $collapseAntropometri = 'show';
        $sidebarSubPBL = 'active';
        $pbl = PBL::all();
        return view('antropometri.pbl', compact('title', 'sidebarAntropometri', 'collapseAntropometri', 'sidebarSubPBL', 'pbl'));
    }

    public function import_excel_pbl(Request $request) 
    {
        try {
            

            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);
            
            PBL::truncate();
     
            $file = $request->file('file');
     
            Excel::import(new PBLImport, $file);

        } catch (\Illuminate\Database\QueryException $e) {

            session()->flash('gagal', 'Gagal mengimport data, Perhatikan format yang diupload');

            return redirect('/antropometri_pbl');
        }
        
        session()->flash('sukses', 'Berhasil Mengimport Data');

        return redirect('/antropometri_pbl');
    }

    public function antropometri_bbp()
    {
        $title = 'Antropometri';
        $sidebarAntropometri = 'active';
        $collapseAntropometri = 'show';
        $sidebarSubBBP = 'active';
        $bbp = BBP::all();
        return view('antropometri.bbp', compact('title', 'sidebarAntropometri', 'collapseAntropometri', 'sidebarSubBBP', 'bbp'));
    }

    public function import_excel_bbp(Request $request) 
    {
        try {
            

            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);
            
            BBP::truncate();
     
            $file = $request->file('file');
     
            Excel::import(new BBPImport, $file);

        } catch (\Illuminate\Database\QueryException $e) {

            session()->flash('gagal', 'Gagal mengimport data, Perhatikan format yang diupload');

            return redirect('/antropometri_bbp');
        }
        
        session()->flash('sukses', 'Berhasil Mengimport Data');

        return redirect('/antropometri_bbp');
    }


     public function antropometri_pbp()
    {
        $title = 'Antropometri';
        $sidebarAntropometri = 'active';
        $collapseAntropometri = 'show';
        $sidebarSubPBP = 'active';
        $pbp = PBP::all();
        return view('antropometri.pbp', compact('title', 'sidebarAntropometri', 'collapseAntropometri', 'sidebarSubPBP', 'pbp'));
    }

    public function import_excel_pbp(Request $request) 
    {
        try {
            

            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);
            
            PBP::truncate();
     
            $file = $request->file('file');
     
            Excel::import(new PBPImport, $file);

        } catch (\Illuminate\Database\QueryException $e) {

            session()->flash('gagal', 'Gagal mengimport data, Perhatikan format yang diupload');

            return redirect('/antropometri_pbp');
        }
        
        session()->flash('sukses', 'Berhasil Mengimport Data');

        return redirect('/antropometri_pbp');
    }

    public function antropometri_detail_bb($umur, $jk)
    {
        switch ($jk) {
            case 1:
                return BBL::select('min3','min2','min1','median','plus1','plus2','plus3')->where('umur', $umur)->first();
                break;
            case 2:
                return BBP::select('min3','min2','min1','median','plus1','plus2','plus3')->where('umur', $umur)->first();
                break;
            default:
                # code...
                break;
        }
    }

    public function antropometri_detail_pb($umur, $jk)
    {
        switch ($jk) {
            case 1:
                return PBL::select('min3','min2','min1','median','plus1','plus2','plus3')->where('umur', $umur)->first();
                break;
            case 2:
                return PBP::select('min3','min2','min1','median','plus1','plus2','plus3')->where('umur', $umur)->first();
                break;
            default:
                # code...
                break;
        }
    }

}
