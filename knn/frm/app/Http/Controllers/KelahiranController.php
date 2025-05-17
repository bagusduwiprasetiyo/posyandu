<?php

namespace App\Http\Controllers;

use App\Models\Kelahiran;
use App\Models\Pasien;
use Toastr;
use Illuminate\Http\Request;

class KelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kehamilan_id = \request()->kehamilan_id;
        $pasien = Pasien::where('id', request()->pasien_id)->first();
        $title = 'Data Kehamilan (' . $pasien->rekam_medik . ' - ' . $pasien->nama_ibu . ')';
        return view('admin.kelahiran.create', compact('pasien', 'title', 'kehamilan_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        Kelahiran::create($request->all());
        Toastr::success('Data Kelahiran Berhasil Disimpan');
        return redirect()->route('pasien.kunjungan', [$request->pasien_id, $request->kehamilan_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Kelahiran $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function show(Kelahiran $kelahiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Kelahiran $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelahiran $kelahiran)
    {
        // TODO:Edit untuk penambahan nifas
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Kelahiran $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelahiran $kelahiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Kelahiran $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelahiran $kelahiran)
    {
        //
    }
}
