<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Relasi_Bayi;
use App\Models\Relasi_Bumil;
use App\User;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $title = 'login';
        $account = 'active';
        $user = DB::select(DB::raw('Select * from users'));
        if (session()->has('kader')) {
            $user = DB::select(DB::raw('Select * from users where name = ' . session()->get('kader')->posyandu_id));
        }

        $username = Users::select('username')->get();
        $arrayUsername = array();

        foreach ($username as $key => $value) {
            array_push($arrayUsername, $value->username);
        }
        $username = $arrayUsername;
        return view('account.index', compact('title', 'user', 'account', 'username'));
    }

    public function edit(Request $request, $id)
    {
        try {
            if ($request->verifPassword == NULL) {
                Users::where('id', $id)->update(['username' => $request->username]);
            } else {
                Users::where('id', $id)->update(['username' => $request->username, 'password' => Hash::make($request->verifPassword)]);
            }
        } catch (\Throwable $th) {
            return $th;
        }

        return 'success';
    }

    public function store(Request $request)
    {
        if (isset($request->user_ibu)) {
            if (session()->has('kader')) {
                $lp = session()->get('kader')->posyandu_id;
            } else {
                $lp = NULL;
            }
            $userData = [
                'username' => $request->username_ibu,
                'status' => 3,
                'name' => $lp,
                'email' => NULL,
                'email_verified_at' => NULL,
                'no_tlp' => NULL,
                'alamat' => NULL,
                'password' => Hash::make($request->password_ibu)
            ];

            try {

                $user = Users::create($userData);
                // return $user;
                if (isset($request->list_ibu)) {

                    foreach ($request->list_ibu as $key => $value) {

                        Relasi_Bumil::create(['users_id' => $user->id, 'bumils_id' => $value]);
                    }
                }

                if (isset($request->list_bayi)) {

                    foreach ($request->list_bayi as $key => $value) {

                        Relasi_Bayi::create(['users_id' => $user->id, 'bayi_id' => $value]);
                    }
                }
            } catch (\Throwable $th) {
                return $th;
            }


            return 'success';
        }
    }
    public function getData($id)
    {
        $ibu = Relasi_Bumil::where('users_id', $id)->join('bumils', 'bumils.id', 'relasi_bumil.bumils_id')->get();
        $bayi = Relasi_Bayi::where('users_id', $id)->join('bayi', 'bayi.id', 'relasi_bayi.bayi_id')->get();
        return [$ibu, $bayi];
    }


    public function updateIbu(Request $request)
    {
        Relasi_Bumil::where('users_id', $request->id_ibu)->delete();
        Relasi_Bayi::where('users_id', $request->id_ibu)->delete();

        if ($request->password_ibu == '') {
            $userData = [
                'username' => $request->username_ibu
            ];
        } else {
            $userData = [
                'username' => $request->username_ibu,
                'password' => Hash::make($request->password_ibu)
            ];
        }

        try {

            Users::find($request->id_ibu)->update($userData);
            $user =  Users::find($request->id_ibu);
            if (isset($request->list_ibu)) {

                foreach ($request->list_ibu as $key => $value) {

                    Relasi_Bumil::create(['users_id' => $user->id, 'bumils_id' => $value]);
                }
            }

            if (isset($request->list_bayi)) {

                foreach ($request->list_bayi as $key => $value) {

                    Relasi_Bayi::create(['users_id' => $user->id, 'bayi_id' => $value]);
                }
            }
        } catch (\Throwable $th) {
            return $th;
        }


        return 'success';
    }
    public function delete($id)
    {
        try {
            Relasi_Bumil::where('users_id', $id)->delete();
            Relasi_Bayi::where('users_id', $id)->delete();
            Users::find($id)->delete();
        } catch (\Throwable $th) {
            return 'data memiliki relasi dengan data lain!';
        }

        return 'success';
    }


    public function add_admin(Request $request)
    {
        $userData = [
            'username' => $request->usernameAdmin,
            'status' => 3,
            'name' => '',
            'email' => NULL,
            'email_verified_at' => NULL,
            'no_tlp' => NULL,
            'alamat' => NULL,
            'password' => Hash::make($request->passwordAdmin)
        ];

        try {
            Users::create($userData);
        } catch (\Throwable $th) {
            return $th;
        }

        return 'success';
    }
}
