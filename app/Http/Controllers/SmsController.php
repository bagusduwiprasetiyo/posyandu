<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Bumil;
use App\Models\Kontak;
use App\Models\SMS;
use App\models\SMSHistory;
use App\Models\Users;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;

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
        if (Session::has('kader')) {

            $sms = SMS::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {
            $sms = SMS::all();
        }
        return view(
            'sms.kirim_sms.index',
            [
                'title' => $title,
                'sidebarSms' => $sidebarSms,
                'collapseSms' => $collapseSms,
                'sidebarSubSms' => $sidebarSubSms,
                'sms' => $sms
            ]
        );
    }


    public function create_kirim()
    {
        $title = 'SMS Gateway';
        $sidebarSms = 'active';
        $sidebarSubSms = 'active';
        $collapseSms = 'show';


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
                'sidebarSms' => $sidebarSms,
                'sidebarSubSms' => $sidebarSubSms,
                'collapseSms' => $collapseSms,
                'posyandu' => $posyandu,
                'kontak' => $kontak
            ]
        );
    }


    public function store_kirim(Request $request)
    {
        if (isset($request->sekali_kirim) && $request->sekali_kirim == 'sekali_kirim') {
            $frekuensi = 'sekali_kirim';
        } else {
            $frekuensi = 'bulanan';
        }

        if ($request->posyandu == 'all') {
            $request->posyandu = 0;
        }

        $penerima = array();
        foreach ($request->kontak as $key => $value) {
            array_push($penerima, $value);
        }

        $data = [
            'pengirim' => Auth::user()->id,
            'status' => 1,
            'frekuensi' => $frekuensi,
            'penerima' => json_encode($penerima),
            'waktu' =>  $request->waktu,
            'posyandu_id' =>  $request->posyandu,
            'isi' => $request->pesan
        ];

        try {
            SMS::create($data);
            return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
        } catch (QueryException $ex) {
            return ['status' => 'error', 'message' => 'terjadi error, periksa kembali masukan anda'];
        }
    }

    public function edit_kirim($id)
    {
        $id = Crypt::decrypt($id);
        $title = 'SMS Gateway';
        $sidebarSms = 'active';
        $sidebarSubSms = 'active';
        $collapseSms = 'show';

        if (Session::has('kader')) {
            $posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
            $kontak = Kontak::where('posyandu_id', session()->get('kader')->posyandu_id)->get();
        } else {
            $posyandu = DB::select('select * from list_posyandu');
            $kontak = Kontak::all();
        }

        $sms = SMS::find($id);
        $sms->penerima = json_decode($sms->penerima);

        return view(
            'sms.kirim_sms.edit',
            [
                'title' => $title,
                'sidebarSms' => $sidebarSms,
                'sidebarSubSms' => $sidebarSubSms,
                'collapseSms' => $collapseSms,
                'posyandu' => $posyandu,
                'kontak' => $kontak,
                'sms' => $sms
            ]
        );
    }

    public function update_kirim(Request $request)
    {
        if (isset($request->sekali_kirim) && $request->sekali_kirim == 'sekali_kirim') {
            $frekuensi = 'sekali_kirim';
        } else {
            $frekuensi = 'bulanan';
        }

        if ($request->posyandu == 'all') {
            $request->posyandu = 0;
        }

        $penerima = array();
        foreach ($request->kontak as $key => $value) {
            array_push($penerima, $value);
        }

        $data = [
            'pengirim' => Auth::user()->id,
            'status' => 1,
            'frekuensi' => $frekuensi,
            'penerima' => json_encode($penerima),
            'waktu' =>  $request->waktu,
            'posyandu_id' =>  $request->posyandu,
            'isi' => $request->pesan
        ];

        try {
            SMS::find($request->id)->update($data);
            return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
        } catch (QueryException $ex) {
            return ['status' => 'error', 'message' => 'terjadi error, periksa kembali masukan anda'];
        }
    }

    public function delete_kirim($id)
    {
        try {
            SMS::find($id)->delete();
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menghapus data'];
    }

    public function change_status($id)
    {
        try {
            $sms = SMS::find($id);
            if ($sms->status == 1) {
                $sms->update([
                    'status' => 0
                ]);
            } else {
                $sms->update([
                    'status' => 1
                ]);
            }
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil mengganti status'];
    }

    public function gateway()
    {
        $client = new Client;
        // return $client->get('https://api.publicapis.org/entries')->getBody();
        $sms = SMS::where('waktu', '=', date('Y-m-d'));
        // jika ada sms yang harus dikirim hari ini
        if ($sms->count() > 0) {
            // foreach semua sms
            foreach ($sms->get() as $key => $value) {
                // jika status sms aktif
                if ($value->status == 1) {
                    $penerima = json_decode($value->penerima);
                    // kirim ke semua penerima
                    foreach ($penerima as $v) {
                        // ambil no hp
                        $nomor = Kontak::where('id', $v)->first();
                        if (isset($nomor->no_hp)) {
                            // kirim menggunakan api
                            $client->get("https://websms.co.id/api/smsgateway-vip?token=845cab4dfbc0efe5f527855bcf2eb28f&to=" . $nomor->no_hp . "&msg=" . $value->isi)->getBody();
                            // buat sebuah history
                            SMSHistory::create([
                                'sms_id' => $value->id,
                                'penerima' => $v,
                                'waktu' => date('Y-m-d'),
                            ]);
                        }
                    }
                    // jika sekali kirim, maka status akan dimatikan
                    if ($value->frekuensi == 'sekali_kirin') {
                        SMS::where('id', $value->id)->update(['status', 0]);
                    }
                }
            }
        }
    }
}
