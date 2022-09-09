<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Posyandu;
use App\Models\Kader;
use Illuminate\Support\Facades\DB;
use App\Models\Puswus;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;

class PuswusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Puswus';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubPuswus = 'active';
        if (Session::has('kader')) {
            $puswus = Puswus::where('posyandu_id', Session::get('kader')->posyandu_id)->get();
        } else {
            $puswus = Puswus::all();
        }

        return view(
            'puswus.index',
            [
                'title' => $title,
                'sidebarPemeriksaan' => $sidebarPemeriksaan,
                'collapsePemeriksaan' => $collapsePemeriksaan,
                'sidebarSubPuswus' => $sidebarSubPuswus,
                'puswus' => $puswus
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Data Puswus';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubPuswus = 'active';

        if (Session::has('kader')) {
            // $posyandu = Kader::select('list_posyandu.*')->join('list_posyandu', 'kader.posyandu_id', 'list_posyandu.id')->groupBy('kader.posyandu_id')->get();
            $posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $posyandu = DB::select('select * from list_posyandu');
        }

        return view(
            'puswus.create',
            [
                'title' => $title,
                'sidebarPemeriksaan' => $sidebarPemeriksaan,
                'collapsePemeriksaan' => $collapsePemeriksaan,
                'sidebarSubPuswus' => $sidebarSubPuswus,
                'posyandu' => $posyandu,
                'jenis_alkon' => $this->jenis_alkon()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->imunisasi)) {
            $request->imunisasi = [];
        }
        if (!isset($request->kb)) {
            $request->kb = [];
        }

        $data = [
            "nama_wuspus" => $request->nama_wuspus,
            "tgl_lahir_wuspus" => $request->tgl_lahir_wuspus,
            "nama_suami" => $request->nama_suami,
            "tgl_lahir_suami" => $request->tgl_lahir_suami,
            "posyandu_id" => $request->posyandu_id,
            "tahapan_ks" => $request->tahapan_ks,
            "klp_dasa_wisma" => $request->klp_dasa_wisma,
            "jml_anak_hidup" => $request->jml_anak_hidup,
            "jml_anak_meninggal" => $request->jml_anak_meninggal,
            "ukuran_lila" => $request->ukuran_lila,
            "imunisasi" => json_encode($request->imunisasi),
            "kb" => json_encode($request->kb),
            "keterangan" => $request->keterangan
        ];

        try {
            Puswus::create($data);
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $title = 'Data Puswus';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubPuswus = 'active';
        $puswus = Puswus::find($id);
        $puswus->imunisasi = json_decode($puswus->imunisasi, true);
        $puswus->kb = json_decode($puswus->kb, true);
        // return $puswus->imunisasi;
        return view(
            'puswus.detail',
            [
                'title' => $title,
                'sidebarPemeriksaan' => $sidebarPemeriksaan,
                'collapsePemeriksaan' => $collapsePemeriksaan,
                'sidebarSubPuswus' => $sidebarSubPuswus,
                'puswus' => $puswus
            ]
        );
    }

    public function showall()
    {
        return Puswus::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $title = 'Data Puswus';
        $sidebarPemeriksaan = 'active';
        $collapsePemeriksaan = 'show';
        $sidebarSubPuswus = 'active';

        $puswus = Puswus::find($id);
        $puswus->imunisasi = json_decode($puswus->imunisasi, true);
        $puswus->kb = json_decode($puswus->kb, true);
        // return $puswus->kb;

        if (Session::has('kader')) {
            // $posyandu = Kader::select('list_posyandu.*')->join(
            //     'list_posyandu',
            //     'kader.posyandu_id',
            //     'list_posyandu.id'
            // )->groupBy('kader.posyandu_id')->get();
            $posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {
            $posyandu = DB::select('select * from list_posyandu');
        }

        return view(
            'puswus.edit',
            [
                'title' => $title,
                'sidebarPemeriksaan' => $sidebarPemeriksaan,
                'collapsePemeriksaan' => $collapsePemeriksaan,
                'sidebarSubPuswus' => $sidebarSubPuswus,
                'posyandu' => $posyandu,
                'jenis_alkon' => $this->jenis_alkon(),
                'puswus' => $puswus
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        if (!isset($request->imunisasi)) {
            $request->imunisasi = [];
        }
        if (!isset($request->kb)) {
            $request->kb = [];
        }

        $data = [
            "nama_wuspus" => $request->nama_wuspus,
            "tgl_lahir_wuspus" => $request->tgl_lahir_wuspus,
            "nama_suami" => $request->nama_suami,
            "tgl_lahir_suami" => $request->tgl_lahir_suami,
            "posyandu_id" => $request->posyandu_id,
            "tahapan_ks" => $request->tahapan_ks,
            "klp_dasa_wisma" => $request->klp_dasa_wisma,
            "jml_anak_hidup" => $request->jml_anak_hidup,
            "jml_anak_meninggal" => $request->jml_anak_meninggal,
            "ukuran_lila" => $request->ukuran_lila,
            "imunisasi" => json_encode($request->imunisasi),
            "kb" => json_encode($request->kb),
            "keterangan" => $request->keterangan
        ];

        try {
            Puswus::find($id)->update($data);
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
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
            Puswus::find($id)->delete();
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menghapus data'];
    }


    public function jenis_alkon()
    {
        return [
            'Kondom',
            'Pil',
            'Implant',
            'MOP',
            'MOW',
            'UID',
            'Suntik',
            'Lain-lain'
        ];
    }

    function imunisasi($arr)
    {
        return $arr;
    }
}
