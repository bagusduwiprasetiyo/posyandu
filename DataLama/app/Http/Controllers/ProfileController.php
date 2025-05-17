<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kader;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Laporan';
        $profile = 'active';
        $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));

        if (session()->has('kader')) {
            $data = Kader::where('kader.id', session()->get('kader')->id)->join('users', 'kader.users_id', 'users.id')->first();
        } else {
            $data = Users::find(Auth::user()->id);
        }

        $username = Users::select('username')->get();
        $arrayUsername = array();

        foreach ($username as $key => $value) {
            array_push($arrayUsername, $value->username);
        }
        $username = $arrayUsername;

        return view('profile.index', compact('title', 'profile', 'list_posyandu', 'data', 'username'));
    }


    public function update(Request $request, $id)
    {
        try {
            if ($request->regisPassword != '' || $request->regisPassword != NULL) {
                $userData = [
                    'username' => $request->regisUsername,
                    'status' => $request->status,
                    'name' => $request->nama,
                    'email' => $request->email,
                    'email_verified_at' => NULL,
                    'no_tlp' => $request->no_tlp,
                    'alamat' => $request->alamat,
                    'password' => Hash::make($request->regisPassword)
                ];
            } else {
                $userData = [
                    'username' => $request->regisUsername,
                    'status' => $request->status,
                    'name' => $request->nama,
                    'email' => $request->email,
                    'email_verified_at' => NULL,
                    'no_tlp' => $request->no_tlp,
                    'alamat' => $request->alamat,
                ];
            }
            $user = Users::find($id)->update($userData);
        } catch (Exception $e) {

            return $e;
        }

        return 'success';
    }
}
