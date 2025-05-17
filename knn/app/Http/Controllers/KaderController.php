<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Kader;
use App\Models\Users;
use App\Models\Posyandu;
use Illuminate\Support\Facades\Auth;

class KaderController extends Controller
{

    public function index()
    {
        $title = 'Data Kader';
        $sidebarPasien = 'active';
        $collapsePasien = 'show';
        $sidebarSubKader = 'active';
        $list_posyandu = Posyandu::all();
        $kader = DB::select('select *, kader.id as kader_id, kader.created_at as created_at from users join kader on users.id = kader.users_id join list_posyandu on kader.posyandu_id = list_posyandu.id where kader.is_active = 1 and users.status = 2');
        $username = Users::select('username')->get();
        $nik = Kader::select('nik')->get();
        $arrayNik = array();
        foreach ($nik as $key => $value) {
            array_push($arrayNik, $value->nik);
        }
        $nik = $arrayNik;

        $arrayUsername = array();

        foreach ($username as $key => $value) {
            array_push($arrayUsername, $value->username);
        }



        $username = $arrayUsername;
        return view('kader.index', compact('title', 'sidebarPasien', 'collapsePasien', 'sidebarSubKader', 'kader', 'list_posyandu', 'nik', 'username'));
    }

    public function store(Request $request)
    {

        try {
            $userData = [
                'username' => $request->regisUsername,
                'status' => 2,
                'name' => $request->nama,
                'email' => $request->email,
                'email_verified_at' => NULL,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->regisPassword)
            ];
            $user = Users::create($userData);
        } catch (Exception $e) {

            return $e;
        }

        try {
            $kaderData = [
                'nik' => $request->nik,
                'posyandu_id' => intval($request->posyandu_id),
                'users_id' => intval($user->id),
                'is_active' => 0,
            ];

            Kader::create($kaderData);
        } catch (Exception $e) {

            return $e;
        }
        session()->flash('registrasiSuccess', 'Anda telah berhasil registrasi, silahkan tunggu akun anda di verifikasi admin!');
        return redirect('/');
    }

    public function storeAdmin(Request $request)
    {

        try {
            $userData = [
                'username' => $request->regisUsername,
                'status' => 2,
                'name' => $request->nama,
                'email' => $request->email,
                'email_verified_at' => NULL,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->regisPassword)
            ];
            $user = Users::create($userData);
        } catch (Exception $e) {

            return $e;
        }

        try {
            $kaderData = [
                'nik' => $request->nik,
                'posyandu_id' => intval($request->posyandu_id),
                'users_id' => intval($user->id),
                'is_active' => 1,
            ];

            Kader::create($kaderData);
        } catch (Exception $e) {

            return $e;
        }

        return "success";
    }


    public function acceptKader()
    {
        $title = 'Terima Kader';
        $sidebarPasien = 'active';
        $collapsePasien = 'show';
        $sidebarSubAccKader = 'active';
        $list_posyandu = Posyandu::all();
        $kader = DB::select('select *, kader.id as kader_id from users join kader on users.id = kader.users_id join list_posyandu on kader.posyandu_id = list_posyandu.id where kader.is_active = 0 and users.status = 2');
        return view('kader.accept', compact('title', 'sidebarPasien', 'collapsePasien', 'sidebarSubAccKader', 'kader', 'list_posyandu'));
    }

    public function acceptKaderConfirm(Request $request)
    {
        try {

            Kader::find($request->id)->update(['is_active' => 1]);
        } catch (\Illuminate\Database\QueryException $e) {
            return $e;
        }

        return 'success';
    }

    public function acceptKaderDestroy(Request $request)
    {
        try {

            $kader = Kader::find($request->id);
            Kader::find($request->id)->delete();
            Users::find($kader->users_id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return 'Data memiliki relasi dengan data lain!';
        }

        return 'success';
    }

    public function detail($id)
    {
        $kader = DB::select(DB::raw('select *, kader.id as kader_id, list_posyandu.nama as posyandu from users join kader on users.id = kader.users_id join list_posyandu on kader.posyandu_id = list_posyandu.id where kader.id = ' . $id));
        return $kader;
    }

    public function update(Request $request, $id)
    {;
        if ($request->regisPasswordEdit == null || $request->regisPasswordEdit == '') {
            $userData = [
                'username' => $request->regisUsernameEdit,
                'status' => 2,
                'name' => $request->namaEdit,
                'email' => $request->emailEdit,
                'email_verified_at' => NULL,
                'no_tlp' => $request->no_tlpEdit,
                'alamat' => $request->alamatEdit,
            ];
        } else {
            $userData = [
                'username' => $request->regisUsernameEdit,
                'status' => 2,
                'name' => $request->namaEdit,
                'email' => $request->emailEdit,
                'email_verified_at' => NULL,
                'no_tlp' => $request->no_tlpEdit,
                'alamat' => $request->alamatEdit,
                'password' => Hash::make($request->regisPasswordEdit)
            ];
        }



        $users_id = Kader::select('users_id')->where('id', $id)->first();

        // return $userData;
        try {

            $user = Users::find($users_id->users_id)->update(array_filter($userData));
        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        try {
            $kaderData = [
                'nik' => $request->nikEdit,
                'posyandu_id' => intval($request->posyandu_idEdit),
                // 'users_id' => intval($id),
                // 'is_active' => 1,
            ];

            Kader::find($id)->update($kaderData);
        } catch (Exception $e) {

            return $e;
        }

        return 'success';
    }

    public function getAllKader()
    {
        return Kader::all();
    }
}
