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
use App\Models\Relasi_Bayi;
use DB;
use Auth;

class KSPRController extends Controller
{
    public function index()
    {
        $title = 'Form KSPR';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $subkspr = 'active';

         if (session()->has('kader')) {
            $kspr = Bayi::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {
            $kspr = DB::table('kspr_screening as a')
            ->select('a.*')
            ->selectSub(function($query) {
                $query->from('kspr_screening_detail')
                    ->selectRaw('COALESCE(SUM(value), 0) + 2')
                    ->whereColumn('kspr_screening_detail.kspr_screening_id', 'a.id');
            }, 'total_value')
            ->get();
        }
        
        return view('kspr.index', compact('title', 'sidebarPemeriksaan', 'subkspr', 'collapsePemeriksaan', 'kspr'));
    
    }

    public function create()
    {
        $title = 'Form KSPR';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $subkspr = 'active';    
        
        if (session()->has('kader')) {
          $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }

        $kspr_master = DB::select(DB::raw(
            "select ksm.*, count(*) over (PARTITION BY kelompok) as total from kspr_screening_master ksm order by id"));

        $list_nama_bumils = DB::select(DB::raw("
            select * from bumils order by nama_ibu
        "));

        // return $kspr_master;

        return view('kspr.create', compact('title', 'sidebarPemeriksaan', 'subkspr', 'collapsePemeriksaan', 'list_posyandu', 'kspr_master', 'list_nama_bumils'));
    
    }

    public function store(Request $request)
    {

        try {

            if($request->bumil != ''){
                $bumil = json_decode($request->bumil);
                $bumil_id = $bumil->id;
            }else{
                $bumil_id = null;
            }


            $kspr = DB::table('kspr_screening')->insertGetId([
                'bumils_id'            => $bumil_id,
                'puswus_id'            => null,
                'nama'                 => $request->nama,
                'umur'                 => $request->umur,
                'pendidikan'           => $request->pendidikan,
                'hamil_ke'             => $request->hamil_ke,
                'alamat'               => $request->alamat,
                'kec_kab'              => $request->kec_kab,
                'pekerjaan'            => $request->pekerjaan,
                'haid_terlambat'       => $request->haid_terlambat,
                'perkiraan_persalinan' => $request->perkiraan_persalinan,
                'periksa_ke'           => $request->periksa_ke,
                'umur_kehamilan'       => $request->umur_kehamilan,
                'di'                   => $request->di,
                'created_at'           => date('Y-m-d H:i:s')
            ]);

              if(!isset($request->tribulan)){
                $request->tribulan = [];
            }


            foreach ($request->tribulan as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $tribulan = json_decode($value1);
                    DB::table('kspr_screening_detail')->insert([
                        'kspr_screening_id'       => $kspr,
                        'kspr_screening_master_id'=> $tribulan->id,
                        'value'                   => $tribulan->skor,
                        'tribulan'                => $key,
                    ]);

                }
            }

        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return redirect(url("kspr/edit/$kspr"));
    }

    public function edit($id)
    {
        $title = 'Form KSPR';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $subkspr = 'active';    
        
        if (session()->has('kader')) {
          $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }

        $kspr_master = DB::select(DB::raw(
            "select ksm.*, count(*) over (PARTITION BY kelompok) as total from kspr_screening_master ksm order by id"));

        $list_nama_bumils = DB::select(DB::raw("
            select * from bumils order by nama_ibu
        "));

        $kspr = DB::table('kspr_screening')->where('id', $id)->first();

        $kspr_dt = DB::table('kspr_screening_detail')->where('kspr_screening_id', $id)->get();
        
        $kspr_detail = [];
        foreach ($kspr_dt as $key => $value) {
            $kspr_detail[$value->tribulan][$value->kspr_screening_master_id][] = $value->value;
        }

        // return $kspr_master;

        return view('kspr.create', compact('title', 'sidebarPemeriksaan', 'subkspr', 'collapsePemeriksaan', 'list_posyandu', 'kspr_master', 'list_nama_bumils', 'kspr', 'kspr_detail'));
    
    }

    public function update($id, Request $request)
    {
        try {

            if($request->bumil != ''){
                $bumil = json_decode($request->bumil);
                $bumil_id = $bumil->id;
            }else{
                $bumil_id = null;
            }
            // return $request;
            if(isset($request->ppa)){
                $data = $request->all();

                 // Contoh akses per field
                $persalinan_tanggal = $request->input('persalinan_tanggal');
                $rujuk_dari         = $request->input('rujuk_dari');       // array (checkbox)
                $rujuk_ke           = $request->input('rujuk_ke');         // array (checkbox)
                $rujukan            = $request->input('rujukan');          // select / text
                $faktor_resiko      = $request->input('faktor_resiko');    // textarea
                $komplikasi         = $request->input('komplikasi');       // array
                $tempat             = $request->input('tempat');           // select / checkbox
                $penolong           = $request->input('penolong');         // select / checkbox
                $macam_persalinan   = $request->input('macam_persalinan'); // radio
                $ibu_status         = $request->input('ibu_status');       // radio
                $ibu_penyebab       = $request->input('ibu_penyebab');     // text
                $bayi_berat         = $request->input('bayi_berat');
                $bayi_kelamin       = $request->input('bayi_kelamin');     // radio
                $bayi_apgar         = $request->input('bayi_apgar');
                $bayi_mati_penyebab = $request->input('bayi_mati_penyebab');
                $bayi_kelainan      = $request->input('bayi_kelainan');
                $tempat_kematian    = $request->input('tempat_kematian');  // select / checkbox
                $keadaan_ibu        = $request->input('keadaan_ibu');      // radio
                $pemberian_asi      = $request->input('pemberian_asi');    // radio
                $keluarga           = $request->input('keluarga');         // radio
                $kategori_miskin    = $request->input('kategori_miskin');  // radio

                // Simpan ke database (contoh tabel 'persalinan')
                // Pastikan kamu sudah buat migration sesuai field yang dibutuhkan
                if($request->ppa == 0){
                    DB::table('kspr_final')->insert([
                        'persalinan_tanggal' => $persalinan_tanggal,
                        'rujuk_dari'         => is_array($rujuk_dari) ? implode(',', $rujuk_dari) : $rujuk_dari,
                        'rujuk_ke'           => is_array($rujuk_ke) ? implode(',', $rujuk_ke) : $rujuk_ke,
                        'rujukan'            => $rujukan,
                        'faktor_resiko'      => $faktor_resiko,
                        'komplikasi'         => is_array($komplikasi) ? implode(',', $komplikasi) : $komplikasi,
                        'tempat'             => $tempat,
                        'penolong'           => $penolong,
                        'macam_persalinan'   => $macam_persalinan,
                        'ibu_status'         => $ibu_status,
                        'ibu_penyebab'       => $ibu_penyebab,
                        'bayi_berat'         => $bayi_berat,
                        'bayi_kelamin'       => $bayi_kelamin,
                        'bayi_apgar'         => $bayi_apgar,
                        'bayi_mati_penyebab' => $bayi_mati_penyebab,
                        'bayi_kelainan'      => $bayi_kelainan,
                        'tempat_kematian'    => $tempat_kematian,
                        'keadaan_ibu'        => $keadaan_ibu,
                        'pemberian_asi'      => $pemberian_asi,
                        'keluarga'           => $keluarga,
                        'kategori_miskin'    => $kategori_miskin,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                        'kspr_screening_id'  => $id
                    ]);
                }else{
                    DB::table('kspr_final')->where('id', $request->ppa)->update([
                        'persalinan_tanggal' => $persalinan_tanggal,
                        'rujuk_dari'         => is_array($rujuk_dari) ? implode(',', $rujuk_dari) : $rujuk_dari,
                        'rujuk_ke'           => is_array($rujuk_ke) ? implode(',', $rujuk_ke) : $rujuk_ke,
                        'rujukan'            => $rujukan,
                        'faktor_resiko'      => $faktor_resiko,
                        'komplikasi'         => is_array($komplikasi) ? implode(',', $komplikasi) : $komplikasi,
                        'tempat'             => $tempat,
                        'penolong'           => $penolong,
                        'macam_persalinan'   => $macam_persalinan,
                        'ibu_status'         => $ibu_status,
                        'ibu_penyebab'       => $ibu_penyebab,
                        'bayi_berat'         => $bayi_berat,
                        'bayi_kelamin'       => $bayi_kelamin,
                        'bayi_apgar'         => $bayi_apgar,
                        'bayi_mati_penyebab' => $bayi_mati_penyebab,
                        'bayi_kelainan'      => $bayi_kelainan,
                        'tempat_kematian'    => $tempat_kematian,
                        'keadaan_ibu'        => $keadaan_ibu,
                        'pemberian_asi'      => $pemberian_asi,
                        'keluarga'           => $keluarga,
                        'kategori_miskin'    => $kategori_miskin,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                        'kspr_screening_id'  => $id
                    ]);
                }
                
                
            }

           $kspr = DB::table('kspr_screening')
            ->where('id', $id) // use your primary key column
            ->update([
                'bumils_id'            => $bumil_id,
                'puswus_id'            => null,
                'nama'                 => $request->nama,
                'umur'                 => $request->umur,
                'pendidikan'           => $request->pendidikan,
                'hamil_ke'             => $request->hamil_ke,
                'alamat'               => $request->alamat,
                'kec_kab'              => $request->kec_kab,
                'pekerjaan'            => $request->pekerjaan,
                'haid_terlambat'       => $request->haid_terlambat,
                'perkiraan_persalinan' => $request->perkiraan_persalinan,
                'periksa_ke'           => $request->periksa_ke,
                'umur_kehamilan'       => $request->umur_kehamilan,
                'di'                   => $request->di,
                'rdb'                   => $request->rdb,
                'rdr'                   => $request->rdr,
                'rtw'                   => $request->rtw,
                'updated_at'           => date('Y-m-d H:i:s')
            ]);

            DB::table('kspr_screening_detail')->where('kspr_screening_id', $id)->delete();

            if(!isset($request->tribulan)){
                $request->tribulan = [];
            }

            foreach ($request->tribulan as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $tribulan = json_decode($value1);
                    DB::table('kspr_screening_detail')->insert([
                        'kspr_screening_id'       => $id,
                        'kspr_screening_master_id'=> $tribulan->id,
                        'value'                   => $tribulan->skor,
                        'tribulan'                => $key,
                    ]);

                }
            }

        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return redirect(url("kspr/edit/$id"));
    }
    public function delete($id)
    {
        try {
            DB::table('kspr_screening_detail')->where('kspr_screening_id', $id)->delete();
            DB::table('kspr_screening')->where('id', $id)->delete();
            

        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return 'success';
    }

    public function ppa($id)
    {
        $title = 'Form KSPR';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $subkspr = 'active';    
        
        if (session()->has('kader')) {
          $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }

        $kspr_master = DB::select(DB::raw(
            "select ksm.*, count(*) over (PARTITION BY kelompok) as total from kspr_screening_master ksm order by id"));

        $list_nama_bumils = DB::select(DB::raw("
            select * from bumils order by nama_ibu
        "));

        $kspr = DB::table('kspr_screening')->where('id', $id)->first();

        $kspr_dt = DB::table('kspr_screening_detail as kd')
            ->join('kspr_screening_master as ks', 'kd.kspr_screening_master_id', '=', 'ks.id')
            ->where('kd.kspr_screening_id', $id)
            ->get();

        
        $kspr_detail = [];
        foreach ($kspr_dt as $key => $value) {
            $kspr_detail[$value->tribulan][$value->kspr_screening_master_id][] = $value->value;
        }

        $ppa = $kspr_dt;

        $kspr_final = DB::table('kspr_final')->where('kspr_screening_id', $id)->first();

        return view('kspr.create', compact('title', 'sidebarPemeriksaan', 'subkspr', 'collapsePemeriksaan', 'list_posyandu', 'kspr_master', 'list_nama_bumils', 'kspr', 'kspr_detail', 'ppa', 'kspr_final'));
    
    }
}
