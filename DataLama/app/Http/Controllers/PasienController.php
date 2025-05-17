<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Pasien;
use App\Models\Users;
use App\Models\Kader;
use Auth;

class PasienController extends Controller
{

    public function index()
    {
        $title = 'Pasien';
        $sidebarPasien = 'active';
        $collapsePasien = 'show';
        $sidebarSubPasien = 'active';
        if (auth()->user()->status == 1) {
            $pasiens = Pasien::select('*', 'list_posyandu.nama as posyandu', 'pasiens.nama as nama', 'pasiens.id as id', 'list_posyandu.id as posyandu_id')->join('list_posyandu', 'pasiens.posyandu_id', 'list_posyandu.id')->orderBy('pasiens.id', 'DESC')->get();
        }
        if (auth()->user()->status == 2) {
            $kader = Kader::where('users_id', auth()->user()->id)->first();
            $pasiens = Pasien::select('*', 'list_posyandu.nama as posyandu', 'pasiens.nama as nama', 'pasiens.id as id', 'list_posyandu.id as posyandu_id')->join('list_posyandu', 'pasiens.posyandu_id', 'list_posyandu.id')->where('list_posyandu.id', $kader->posyandu_id)->orderBy('pasiens.id', 'DESC')->get();
        }
        return view('pasien.index', compact('title', 'sidebarPasien', 'collapsePasien', 'sidebarSubPasien', 'pasiens'));
    }

    public function create(Request $request)
    {
        $title = 'Pasien';
        $sidebarPasien = 'active';
        $collapsePasien = 'show';
        $sidebarSubPasien = 'active';
        $list_posyandu = DB::table('list_posyandu')->select('*')->get();
        $nik = Pasien::select('nik')->get();
        $arrPasien = array();

        foreach ($nik as $key => $value) {
            array_push($arrPasien, $value->nik);
        }

        $nik = $arrPasien;

        if ($request->id) {

            $pasien = Pasien::find($request->id);

            return view('pasien.create', compact('title', 'sidebarPasien', 'collapsePasien', 'pasien', 'list_posyandu', 'sidebarSubPasien', 'nik'));
        }

        return view('pasien.create', compact('title', 'sidebarPasien', 'collapsePasien', 'list_posyandu', 'sidebarSubPasien', 'nik'));
    }

    public function store(Request $request)
    {

        try {
            $userData = [
                'username' => $request->nik,
                'status' => 3,
                'name' => NULL,
                'email' => NULL,
                'email_verified_at' => NULL,
                'no_tlp' => NULL,
                'alamat' => NULL,
                'password' => Hash::make($request->nik)
            ];

            // $users = Users::create($userData);
            $pasien = Pasien::create($request->all());
            // Pasien::find($pasien->id)->update(['users_id' => $users->id]);
            // return $request->users_id;

        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return 'success';
    }

    public function detail($id)
    {
        $title = 'Pasien';
        $sidebarPasien = 'active';
        $collapsePasien = 'show';
        $sidebarSubPasien = 'active';

        $pasiendata = Pasien::where('id', $id)->first();

        return view('pasien.detail', compact('pasiendata', 'title', 'sidebarPasien', 'collapsePasien', 'sidebarSubPasien'));
    }

    public function update(Request $request, $id)
    {
        $userData = [
            'username' => $request->nik,
            'status' => 3,
            'name' => NULL,
            'email' => NULL,
            'email_verified_at' => NULL,
            'no_tlp' => NULL,
            'alamat' => NULL,
            'password' => Hash::make($request->nik)
        ];
        try {
            // $pasien = Pasien::select('users_id')->where('id', $id)->first();
            // Users::find($pasien->users_id)->update($userData);
            Pasien::find($id)->update($request->all());
        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return 'success';
    }

    public function destroy($id)
    {
        try {

            $pasien = Pasien::find($id);
            // Users::find($pasien->users_id)->delete();
            Pasien::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $error) {
            return 'data memiliki relasi dengan data bumil/bayi!';
        }

        return 'success';
    }
}
