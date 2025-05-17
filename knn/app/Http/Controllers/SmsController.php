<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Bumil;
use App\Models\Kontak;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kontak()
    {
        $title = 'SMS Gateway';
        $sidebarSms = 'active';
        $sidebarSubKontak = 'active';
        $collapseSms = 'show';
        $kontak = Kontak::all();

        return view(
            'sms.kontak.index',
            [
                'title' => $title,
                'sidebarSms' => $sidebarSms,
                'collapseSms' => $collapseSms,
                'sidebarSubKontak' => $sidebarSubKontak,
                'kontak' => $kontak
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_kontak()
    {
        $title = 'SMS Gateway';
        $sms = 'active';

        if (Session::has('kader')) {
            $posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
            $data['bumil'] = Bumil::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {
            $posyandu = DB::select('select * from list_posyandu');
            $data['bumil'] = Bumil::all();
        }

        return view(
            'sms.kontak.create',
            [
                'title' => $title,
                'sms' => $sms,
                'posyandu' => $posyandu,
                'data' => $data
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_kontak(Request $request)
    {
        if (!isset($request->nama_bumil)) {
            $request->nama_bumil = null;
        }

        if ($request->nama_bumil == null) {
            $request->nama_bumil = Bumil::select('nama_ibu')->where('id', $request->bumil)->first()->nama_ibu;
        }

        try {
            Kontak::create([
                'bumil_id' => $request->bumil,
                'posyandu_id' => $request->posyandu,
                'nama' => $request->nama_bumil,
                'no_hp' => $request->no_hp,
            ]);

            return redirect(url('sms/kontak'))->with(['status' => 'success', 'message' => 'Berhasil menyimpan data']);
        } catch (QueryException $ex) {
            return redirect(url()->previous())->with(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }

    public function edit_kontak($id)
    {
        $id = Crypt::decrypt($id);
        $title = 'SMS Gateway';
        $sms = 'active';

        if (Session::has('kader')) {
            $posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
            $data['bumil'] = Bumil::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {
            $posyandu = DB::select('select * from list_posyandu');
            $data['bumil'] = Bumil::all();
        }

        $kontak = Kontak::find($id);

        return view(
            'sms.kontak.edit',
            [
                'title' => $title,
                'sms' => $sms,
                'posyandu' => $posyandu,
                'data' => $data,
                'kontak' => $kontak
            ]
        );
    }


    public function update_kontak(Request $request)
    {
        if (!isset($request->nama_bumil)) {
            $request->nama_bumil = null;
        }

        if ($request->nama_bumil == null) {
            $request->nama_bumil = Bumil::select('nama_ibu')->where('id', $request->bumil)->first()->nama_ibu;
        }

        try {
            Kontak::where('id', $request->id)->update([
                'bumil_id' => $request->bumil,
                'posyandu_id' => $request->posyandu,
                'nama' => $request->nama_bumil,
                'no_hp' => $request->no_hp,
            ]);

            return redirect(url('sms/kontak'))->with(['status' => 'success', 'message' => 'Berhasil menyimpan data']);
        } catch (QueryException $ex) {
            return redirect(url()->previous())->with(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }


    public function delete_kontak($id)
    {
        try {
            Kontak::find($id)->delete();
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menghapus data'];
    }




    // SEND SMS ===========================================
    public function kirim_sms()
    {
        $title = 'SMS Gateway';
        $sidebarSms = 'active';
        $sidebarSubSms = 'active';
        $collapseSms = 'show';

        return view(
            'sms.kirim_sms.index',
            [
                'title' => $title,
                'sidebarSms' => $sidebarSms,
                'collapseSms' => $collapseSms,
                'sidebarSubSms' => $sidebarSubSms,

            ]
        );
    }


    public function create_kirim()
    {
        $title = 'SMS Gateway';
        $sms = 'active';

        if (Session::has('kader')) {
            $posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
            $kontak = Kontak::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {
            $posyandu = DB::select('select * from list_posyandu');
            $kontak = Kontak::all();
        }



        return view(
            'sms.kirim_sms.create',
            [
                'title' => $title,
                'sms' => $sms,
                'posyandu' => $posyandu,
                'kontak' => $kontak
            ]
        );
    }


    public function store_kirim(Request $request)
    {
        return $request;
    }


    public function testersms()
    {
        Kontak::create([
            'bumil_id' => null,
            'posyandu_id' => null,
            'nama' => 'test 123',
            'no_hp' => null,
        ]);
    }
}
