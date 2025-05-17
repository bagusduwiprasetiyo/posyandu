<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{

  public function postlogin(Request $request)
  {
    if (isset($request->api)) {

      if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        return response()->json(['status' => true, 'msg' => 'Berhasil Login']);
      }

      return response()->json(['status' => false, 'msg' => 'Username atau Password salah!']);
    }

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
      session()->put('login', true);
      return redirect('/dashboard');
    } else {
      session()->flash('loginFalse', 'Username atau Password salah!');
      return redirect('/');
    }
  }

  public function logout()
  {
    session()->flush();
    Auth::logout();
    session()->flash('loginFalse', 'Anda telah Keluar!');
    return redirect('/');
  }
}
