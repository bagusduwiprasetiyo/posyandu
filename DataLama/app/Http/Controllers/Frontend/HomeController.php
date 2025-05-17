<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Pengantin;
use App\Models\Bumil;
use App\Models\Users;
use App\Models\Kader;

class HomeController extends Controller
{
    public function index()
    {
    	$title = 'Beranda';
        $bumils = Bumil::paginate(10);
        $pengantins = Pengantin::paginate(10);
        $list_posyandu = DB::table('list_posyandu')->select('*')->get();
        $kader = Kader::with('user')->get();
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

        return view('frontend.home', compact('title', 'bumils', 'pengantins', 'list_posyandu', 'kader', 'username', 'nik'));
    }
}
