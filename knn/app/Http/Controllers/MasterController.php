<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posyandu;
use App\Models\Bumil;
use App\Models\Bayi;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Detail_Bumil_Timbang;
use Auth;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;

class MasterController extends Controller
{

    public function posyandu()
    {
        $title = 'Posyandu';
        $sidebarMaster = 'active';
        $collapseMaster = 'show';
        $sidebarSubPosyandu = 'active';
        $posyandu = Posyandu::all();
        return view('master.create_posyandu', compact('title', 'sidebarMaster', 'collapseMaster', 'sidebarSubPosyandu', 'posyandu'));
    }

    public function store(Request $request)
    {
        try {

            Posyandu::create($request->all());
        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return 'success';
    }


    public function update(Request $request, $id)
    {

        try {

            Posyandu::find($id)->update($request->all());
        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return 'success';
    }

    public function destroy($id)
    {
        try {

            Posyandu::destroy($id);
        } catch (\Illuminate\Database\QueryException $error) {
            return $error;
        }

        return 'success';
    }


    public function analisis()
    {
        $title = 'Analisis';
        $analisis = 'active';
        if (session()->has('kader')) {
            $list_posyandu = DB::select(DB::raw('select * from list_posyandu where id = ' . session()->get('kader')->posyandu_id));
        } else {

            $list_posyandu = DB::select(DB::raw('select * from list_posyandu'));
        }

        $jml_bumil = Bumil::all();
        $lila_lebih = array();
        $lila_kurang = array();
        $thallibu = array();

        foreach ($jml_bumil as $key => $value) {
            $tgladd = explode('-', $value->tanggal)[0];

            if (!in_array($tgladd, $thallibu)) {
                array_push($thallibu, $tgladd);
            }

            if (floatval($value->lila) > 23.5) {
                array_push($lila_lebih, $value->lila);
            } else {
                array_push($lila_kurang, $value->lila);
            }
        }


        $jml_bayi = Bayi::all();

        $thall = array();

        $bb_bayi = ['tipe_1' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_2' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_3' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_4' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];

        $pb_bayi = ['tipe_1' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_2' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_3' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_4' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];

        foreach ($jml_bayi as $key => $value) {
            $dt = Detail_Bayi_Timbang::where('bayi_id', $value->id)->get();

            foreach ($dt as $key => $value) {
                $thsplit = explode('-', $value->tanggal)[0];
                try {
                    $blnsplit = (int) explode('-', $value->tanggal)[1] - 1;
                } catch (\Throwable $th) {
                    return $value;
                }

                if (!in_array($thsplit, $thall)) {
                    array_push($thall, (int) $thsplit);
                }

                if ($value->status_bb == 'Berat badan sangat kurang (severely underweight)') {
                    $bb_bayi['tipe_4'][$blnsplit] = $bb_bayi['tipe_4'][$blnsplit] + 1;
                }
                if ($value->status_bb == 'Berat badan kurang (underweight)') {
                    $bb_bayi['tipe_3'][$blnsplit] = $bb_bayi['tipe_3'][$blnsplit] + 1;
                }
                if ($value->status_bb == 'Berat badan normal') {
                    $bb_bayi['tipe_2'][$blnsplit] = $bb_bayi['tipe_2'][$blnsplit] + 1;
                }
                if ($value->status_bb == 'Risiko berat badan lebih') {
                    $bb_bayi['tipe_1'][$blnsplit] = $bb_bayi['tipe_1'][$blnsplit] + 1;
                }

                //pb bayi


                if ($value->status_pb == 'Sangat pendek (severely stunted)') {
                    $pb_bayi['tipe_4'][$blnsplit] = $pb_bayi['tipe_4'][$blnsplit] + 1;
                }
                if ($value->status_pb == 'Pendek (stunted)') {
                    $pb_bayi['tipe_3'][$blnsplit] = $pb_bayi['tipe_3'][$blnsplit] + 1;
                }
                if ($value->status_pb == 'Normal') {
                    $pb_bayi['tipe_2'][$blnsplit] = $pb_bayi['tipe_2'][$blnsplit] + 1;
                }
                if ($value->status_pb == 'Tinggi') {
                    $pb_bayi['tipe_1'][$blnsplit] = $pb_bayi['tipe_1'][$blnsplit] + 1;
                }
            }
        }


        $data = ['jml_bumil' => count($jml_bumil), 'lila_lebih' => count($lila_lebih), 'lila_kurang' => count($lila_kurang), 'jml_bayi' => count($jml_bayi)];
        return view('master.analisis', compact('title', 'analisis', 'list_posyandu', 'data', 'thall', 'bb_bayi', 'pb_bayi', 'thallibu'));
    }


    public function analisisDetail($id)
    {
        if ($id == 0) {
            $jml_bumil = Bumil::all();
        } else {
            $jml_bumil = Bumil::where('posyandu_id', $id)->get();
        }
        $lila_lebih = array();
        $lila_kurang = array();
        foreach ($jml_bumil as $key => $value) {
            if (floatval($value->lila) > 23.5) {
                array_push($lila_lebih, $value->lila);
            } else {
                array_push($lila_kurang, $value->lila);
            }
        }


        if ($id == 0) {
            $jml_bayi = Bayi::all();
        } else {
            $jml_bayi = Bayi::where('posyandu_id', $id)->get();
        }

        $data = ['jml_bumil' => count($jml_bumil), 'lila_lebih' => count($lila_lebih), 'lila_kurang' => count($lila_kurang), 'posyandu' => DB::select(DB::raw('select nama from list_posyandu where id = ' . $id)), 'jml_bayi' => count($jml_bayi)];

        return $data;
    }

    public function analisis_bayi($tahun, $id)
    {
        if ($id == 0) {
            $jml_bayi = Bayi::all();
        } else {
            $jml_bayi = Bayi::where('posyandu_id', $id)->get();
        }

        $bb_bayi = ['tipe_1' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_2' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_3' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_4' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
        $pb_bayi = ['tipe_1' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_2' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_3' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 'tipe_4' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];

        foreach ($jml_bayi as $key => $value) {
            $dt = Detail_Bayi_Timbang::where('bayi_id', $value->id)->get();

            foreach ($dt as $key => $value) {
                $thsplit = explode('-', $value->tanggal)[0];
                $blnsplit = (int) explode('-', $value->tanggal)[1] - 1;
                if ($thsplit == $tahun) {
                    if ($value->status_bb == 'Berat badan sangat kurang (severely underweight)') {
                        $bb_bayi['tipe_4'][$blnsplit] = $bb_bayi['tipe_4'][$blnsplit] + 1;
                    }
                    if ($value->status_bb == 'Berat badan kurang (underweight)') {
                        $bb_bayi['tipe_3'][$blnsplit] = $bb_bayi['tipe_3'][$blnsplit] + 1;
                    }
                    if ($value->status_bb == 'Berat badan normal') {
                        $bb_bayi['tipe_2'][$blnsplit] = $bb_bayi['tipe_2'][$blnsplit] + 1;
                    }
                    if ($value->status_bb == 'Risiko berat badan lebih') {
                        $bb_bayi['tipe_1'][$blnsplit] = $bb_bayi['tipe_1'][$blnsplit] + 1;
                    }


                    //data pb

                    if ($value->status_pb == 'Sangat pendek (severely stunted)') {
                        $pb_bayi['tipe_4'][$blnsplit] = $pb_bayi['tipe_4'][$blnsplit] + 1;
                    }
                    if ($value->status_pb == 'Pendek (stunted)') {
                        $pb_bayi['tipe_3'][$blnsplit] = $pb_bayi['tipe_3'][$blnsplit] + 1;
                    }
                    if ($value->status_pb == 'Normal') {
                        $pb_bayi['tipe_2'][$blnsplit] = $pb_bayi['tipe_2'][$blnsplit] + 1;
                    }
                    if ($value->status_pb == 'Tinggi') {
                        $pb_bayi['tipe_1'][$blnsplit] = $pb_bayi['tipe_1'][$blnsplit] + 1;
                    }
                }
                if ($tahun == 0) {

                    if ($value->status_bb == 'Berat badan sangat kurang (severely underweight)') {
                        $bb_bayi['tipe_4'][$blnsplit] = $bb_bayi['tipe_4'][$blnsplit] + 1;
                    }
                    if ($value->status_bb == 'Berat badan kurang (underweight)') {
                        $bb_bayi['tipe_3'][$blnsplit] = $bb_bayi['tipe_3'][$blnsplit] + 1;
                    }
                    if ($value->status_bb == 'Berat badan normal') {
                        $bb_bayi['tipe_2'][$blnsplit] = $bb_bayi['tipe_2'][$blnsplit] + 1;
                    }
                    if ($value->status_bb == 'Risiko berat badan lebih') {
                        $bb_bayi['tipe_1'][$blnsplit] = $bb_bayi['tipe_1'][$blnsplit] + 1;
                    }


                    //data pb

                    if ($value->status_pb == 'Sangat pendek (severely stunted)') {
                        $pb_bayi['tipe_4'][$blnsplit] = $pb_bayi['tipe_4'][$blnsplit] + 1;
                    }
                    if ($value->status_pb == 'Pendek (stunted)') {
                        $pb_bayi['tipe_3'][$blnsplit] = $pb_bayi['tipe_3'][$blnsplit] + 1;
                    }
                    if ($value->status_pb == 'Normal') {
                        $pb_bayi['tipe_2'][$blnsplit] = $pb_bayi['tipe_2'][$blnsplit] + 1;
                    }
                    if ($value->status_pb == 'Tinggi') {
                        $pb_bayi['tipe_1'][$blnsplit] = $pb_bayi['tipe_1'][$blnsplit] + 1;
                    }
                }
            }
        }



        return [$bb_bayi, $pb_bayi];
    }


    public function analisis_ibu($tahun, $id)
    {
        // return $id;
        if ($id == 0) {
            $jml_bumil = Bumil::all();
        } else {
            $jml_bumil = Bumil::where('posyandu_id', $id)->get();
        }

        $lila_lebih = array();
        $lila_kurang = array();
        $newJmlbumil = 0;
        foreach ($jml_bumil as $key => $value) {
            if ($tahun == 0) {
                $newJmlbumil++;
                if (floatval($value->lila) > 23.5) {
                    array_push($lila_lebih, $value->lila);
                } else {
                    array_push($lila_kurang, $value->lila);
                }
            } else {
                if (explode('-', $value->tanggal)[0] == $tahun) {
                    $newJmlbumil++;
                    if (floatval($value->lila) > 23.5) {
                        array_push($lila_lebih, $value->lila);
                    } else {
                        array_push($lila_kurang, $value->lila);
                    }
                }
            }
        }

        $data = ['jml_bumil' => $newJmlbumil, 'lila_lebih' => count($lila_lebih), 'lila_kurang' => count($lila_kurang)];

        return $data;
    }
}
