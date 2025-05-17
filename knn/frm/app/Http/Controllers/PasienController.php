<?php

namespace App\Http\Controllers;

use App\Models\Kehamilan;
use App\Models\Kelahiran;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class PasienController extends Controller
{
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $data = Pasien::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                        <div class="btn-group btn-group-sm">
                            <a href="' . route('pasien.show', $data->id) . '" class="btn btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                            <a href="' . route('pasien.edit', $data->id) . '" class="btn btn-warning" title="Edit Data"><i class="fas fa-edit"></i></a>
                            <button onclick="delconf(\'' . route('hapus.pasien', $data->id) . '\')" class="btn btn-danger" title="Hapus Data"><i class=" fas fa-trash"></i></button>
                        </div>
                      ';
                })
                ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'orderable', 'title' => 'No', 'orderable' => false, 'searchable' => false],
            ['data' => 'rekam_medik', 'title' => 'Rekam Medik'],
            ['data' => 'nama_ibu', 'title' => 'Nama Pasien'],
            ['data' => 'nama_suami', 'title' => 'Nama Suami'],
            ['data' => 'golongan_darah', 'title' => 'Gol. Darah'],
            ['data' => 'alamat', 'title' => 'Alamat', 'orderable' => false, 'searchable' => false],
            ['data' => 'action', 'title' => '#', 'orderable' => false, 'searchable' => false]
        ])->parameters([
            'language' => [
                'url' => 'http://cdn.datatables.net/plug-ins/1.10.25/i18n/id.json'
            ]
        ]);
        $title = 'Data Pasien';
        return view('admin.pasien.index', compact('html', 'title'));
    }

    public function create()
    {
        $title = 'Tambah Pasien';
        return view('admin.pasien.create', compact('title'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        // TODO:buat validasi
        Pasien::create($request->all());
        Toastr::success('Data Berhasil Ditambahkan');
        return redirect()->route('pasien.index');
    }

    public function edit(Pasien $pasien)
    {
        $title = 'Update Pasien (' . $pasien->rekam_medik . '-' . $pasien->nama_ibu . ')';
        return view('admin.pasien.update', compact('pasien', 'title'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        // TODO:buat validasi
        $data = [
            "nama_ibu" => $request->nama_ibu,
            "nama_suami" => $request->nama_suami,
            "alamat" => $request->alamat,
            "golongan_darah" => $request->golongan_darah
        ];
        $pasien->update($data);
        Toastr::success('Data Berhasil Disimpan');
        return redirect()->route('pasien.index');
    }

    public function show(Pasien $pasien, $kehamilan = '')
    {
        $title = 'Data Kehamilan (' . $pasien->rekam_medik . ' - ' . $pasien->nama_ibu . ')';
        $hamil = Kehamilan::query();
        $data_hamil = '';
        $kspr = '';
        if ($kehamilan != '') {
            $kspr = Kunjungan::where('kehamilan_id', $kehamilan)->latest()->first();
            $data_hamil = $hamil->where('pasien_id', $pasien->id)->where('id', $kehamilan)->first();
        }
//        dd($data_hamil);
        $id_hamil = $hamil->pluck('id');
        $kunjungan = Kunjungan::query();
        $data_kunjungan = $kunjungan->where('pasien_id', $pasien->id)->whereIn('kehamilan_id', $id_hamil)->get();
        $data_kelahiran = Kelahiran::where('pasien_id', $pasien->id)->where('kehamilan_id', $id_hamil)->first();
        $data = Pasien::with('kehamilans', 'kunjungans')->withCount('kehamilans')->where('id', $pasien->id)->get();
        $kehamilan = Kehamilan::withCount('kunjungan', 'kelahiran')->with('kunjungan', 'kelahiran')->where('pasien_id', $pasien->id)->get();
//        dd($kehamilan);
        return view('admin.pasien.detail', compact('data', 'pasien', 'title', 'kehamilan', 'data_hamil', 'data_kunjungan', 'kspr', 'data_kelahiran'));
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        Toastr::success('Data Berhasil Dihapus');
        return redirect()->back();
    }
}
