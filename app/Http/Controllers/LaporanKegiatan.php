<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Puswus;
use App\Models\Bumil;
use App\Models\Detail_Bayi_Imun;
use App\Models\Detail_Bayi_Obat;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Detail_Bumil_TD;
use App\Models\Detail_Bumil_Timbang;
use App\Models\Detail_Bumil_TT;
use App\Models\Laporan;
use PDF;
use DateTime;
use Illuminate\Support\Facades\DB;

class LaporanKegiatan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_posyandu, $tahun)
    {

        $title = 'Laporan Kegiatan Posyandu';
        $sidebarLaporan = 'active';
        $collapseLaporan = 'show';
        $sidebarkegiatanposyandu = 'active';

        if ($id_posyandu == 0) {
            $tahun_bumil = DB::select(DB::raw("SELECT YEAR(tanggal) as tahun FROM bumils GROUP BY tahun desc"));
        } else {
            $tahun_bumil = DB::select(DB::raw("SELECT YEAR(tanggal) as tahun FROM bumils where posyandu_id = " . $id_posyandu . " GROUP BY tahun desc"));
        }
        // return $tahun_bumil;


        /*
        ambil semua data tahun dan bulan dari bumil dan simpan ke dalam array
        lakukan looping dengan memasukkan data sesuai dengan tanggal dan bulan,
        demi tujuannya yaitu mengelompokkan data bumil sesuai dengan tahun dan bulannya.

        => untuk data bumil diambil dari function bumil

        */
        $nama_bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];




        $laporan = $this->get_data($id_posyandu, $tahun);

        // return $all_tahun;
        // return Bumil::select('tanggal')->oldest()->first();
        // return Bumil::all();
        // return Bumil::select('tanggal')->get();
        // return $tahun_bumil[0]->tgl;
        return view(
            'laporan.hasil_kegiatan',
            [
                'title' => $title,
                'sidebarLaporan' => $sidebarLaporan,
                'collapseLaporan' => $collapseLaporan,
                'sidebarkegiatanposyandu' => $sidebarkegiatanposyandu,
                'laporan' => [
                    'tahun' => $tahun_bumil
                ],
                'data_laporan' => $laporan,
                'nama_bulan' => $nama_bulan,
                'tahun' => $tahun,
                'id_posyandu' => $id_posyandu
            ]
        );
    }

    public function get_data($id_posyandu, $tahun)
    {
        $month = [];
        for ($i = 1; $i <= 12; $i++) {
            array_push($month, date('Y-m', strtotime($tahun . '-' . $i)));
        }

        $data = [];

        if ($id_posyandu == 0) {
            $bumil = Bumil::whereYear('tanggal', '<=', $tahun)->orderBy('tanggal', 'ASC')->get();
            $bumil_timbang = Detail_Bumil_Timbang::whereYear('tanggal', $tahun)->get();
            $bumil_td = Detail_Bumil_TD::whereYear('tanggal', $tahun)->get();
            $bumil_tt = Detail_Bumil_TT::whereYear('tanggal', $tahun)->get();
            $puswus = Puswus::get();

            $bayi = Bayi::whereYear('tanggal_lahir', $tahun)->orderBy('tanggal_lahir', 'ASC')->get();
            $bayi_timbang = Detail_Bayi_Timbang::select('detail_bayi_timbang.*', 'bayi.l_p')->join('bayi', 'detail_bayi_timbang.bayi_id', 'bayi.id')->whereYear('tanggal', $tahun)->orderBy('tanggal', 'ASC')->get();

            $bayi_vit = Detail_Bayi_Obat::select('detail_bayi_obat.*', 'bayi.l_p')->join('bayi', 'detail_bayi_obat.bayi_id', 'bayi.id')->where('vit_a', '!=', '[]')->get();
            $pmt = Detail_Bayi_Obat::select('detail_bayi_obat.*', 'bayi.l_p')->join('bayi', 'detail_bayi_obat.bayi_id', 'bayi.id')->where('pmt', '!=', '[]')->get();
            $bayi_imun = Detail_Bayi_Imun::select('detail_bayi_imun.*', 'bayi.l_p')->join('bayi', 'detail_bayi_imun.bayi_id', 'bayi.id')->get();
        } else {
            // return $id_posyandu;
            $bumil = Bumil::whereYear('tanggal', '<=', $tahun)->where('bumils.posyandu_id', $id_posyandu)->orderBy('tanggal', 'ASC')->get();
            $bumil_timbang = Detail_Bumil_Timbang::select('detail_bumils_hasil_penimbangan.*', 'bumils.posyandu_id')->join('bumils', 'detail_bumils_hasil_penimbangan.bumils_id', 'bumils.id')->whereYear('detail_bumils_hasil_penimbangan.tanggal', $tahun)->where('bumils.posyandu_id', $id_posyandu)->get();
            $bumil_td = Detail_Bumil_TD::select('detail_bumils_tablet_tambah_darah.*', 'bumils.posyandu_id')->join('bumils', 'detail_bumils_tablet_tambah_darah.bumils_id', 'bumils.id')->whereYear('detail_bumils_tablet_tambah_darah.tanggal', $tahun)->where('bumils.posyandu_id', $id_posyandu)->get();
            $bumil_tt = Detail_Bumil_TT::select('detail_bumils_imunisasi_tt.*', 'bumils.posyandu_id')->join('bumils', 'detail_bumils_imunisasi_tt.bumils_id', 'bumils.id')->whereYear('detail_bumils_imunisasi_tt.tanggal', $tahun)->where('bumils.posyandu_id', $id_posyandu)->get();
            $puswus = Puswus::where('posyandu_id', $id_posyandu)->get();

            $bayi = Bayi::whereYear('tanggal_lahir', $tahun)->where('bayi.posyandu_id', $id_posyandu)->orderBy('tanggal_lahir', 'ASC')->get();
            $bayi_timbang = Detail_Bayi_Timbang::select('detail_bayi_timbang.*', 'bayi.l_p')->join('bayi', 'detail_bayi_timbang.bayi_id', 'bayi.id')->whereYear('tanggal', $tahun)->where('bayi.posyandu_id', $id_posyandu)->orderBy('tanggal', 'ASC')->get();

            $bayi_vit = Detail_Bayi_Obat::select('detail_bayi_obat.*', 'bayi.l_p')->join('bayi', 'detail_bayi_obat.bayi_id', 'bayi.id')->where('vit_a', '!=', '[]')->where('bayi.posyandu_id', $id_posyandu)->get();
            $pmt = Detail_Bayi_Obat::select('detail_bayi_obat.*', 'bayi.l_p')->join('bayi', 'detail_bayi_obat.bayi_id', 'bayi.id')->where('pmt', '!=', '[]')->where('bayi.posyandu_id', $id_posyandu)->get();
            $bayi_imun = Detail_Bayi_Imun::select('detail_bayi_imun.*', 'bayi.l_p')->join('bayi', 'detail_bayi_imun.bayi_id', 'bayi.id')->where('bayi.posyandu_id', $id_posyandu)->get();
        }
        // return $bumil_timbang;
        //untuk data buil

        //untuk data alkon

        //untuk data bayi

        foreach ($bayi_timbang as $key => $bt) {
            $dt = Detail_Bayi_Timbang::whereDate('tanggal', '<', $bt->tanggal)->where('bayi_id', $bt->bayi_id)->orderBy('tanggal', 'ASC')->first();
            if (isset($dt->id)) {
                if ($bt->berat_badan > $dt->berat_badan) {

                    $bayi_timbang[$key]->naik = $bt->berat_badan - $dt->berat_badan;
                }
            }
        }

        //memasukkan data
        foreach ($month as $keymth => $mth) {
            // data preparation
            $pre_data = [
                'bulan' => '',
                'jml_bumil' => 0,
                'bumil_timbang' => 0,
                'bumil_td' => 0,
                'bumil_menyusui' => 0,
                'bumil_tt_1' => 0,
                'bumil_tt_2' => 0,
                'alkon' => [
                    'Kondom' => 0,
                    'Pil' => 0,
                    'Implant' => 0,
                    'MOP' => 0,
                    'MOW' => 0,
                    'UID' => 0,
                    'Suntik' => 0,
                    'Lain-lain' => 0
                ],
                'bayi_s' => [
                    'l' => 0,
                    'p' => 0
                ],
                'bayi_k' => [
                    'l' => 0,
                    'p' => 0
                ],
                'bayi_timbang' => [
                    'l' => 0,
                    'p' => 0
                ],
                'bayi_naik' => [
                    'l' => 0,
                    'p' => 0
                ],
                'bayi_vit_a' => [
                    'l' => 0,
                    'p' => 0
                ],
                'bayi_pmt' => [
                    'l' => 0,
                    'p' => 0
                ],
                'bayi_imun' => [
                    'hbo' => [
                        'l' => 0,
                        'p' => 0
                    ],
                    'bcg' => [
                        'l' => 0,
                        'p' => 0
                    ],
                    'dpt' => [
                        'i' => [
                            'l' => 0,
                            'p' => 0
                        ],
                        'ii' => [
                            'l' => 0,
                            'p' => 0
                        ],
                        'iii' => [
                            'l' => 0,
                            'p' => 0
                        ]
                    ],
                    'polio' => [
                        'i' => [
                            'l' => 0,
                            'p' => 0
                        ],
                        'ii' => [
                            'l' => 0,
                            'p' => 0
                        ],
                        'iii' => [
                            'l' => 0,
                            'p' => 0
                        ],
                        'iiii' => [
                            'l' => 0,
                            'p' => 0
                        ]
                    ],
                ],
                'campak' => 0,
                'diare' => [
                    'l' => 0,
                    'p' => 0
                ],
                'oralit' => [
                    'l' => 0,
                    'p' => 0
                ],
                'keterangan' => ''

            ];

            $pre_data['bulan'] = $mth;


            if (date('Y-m', strtotime($mth)) < date('Y-m')) {
                //jumlah ibu hamil dan menyusui
                foreach ($bumil as $bm) {
                    if (date('Y-m', strtotime($bm->tanggal)) <= date('Y-m', strtotime($mth))) {
                        if ($bm->tanggal_persalinan != '') {
                            if (date('Y-m', strtotime($mth)) < date('Y-m', strtotime($bm->tanggal_persalinan))) {
                                $pre_data['jml_bumil'] += 1;
                            }
                        } else {
                            $pre_data['jml_bumil'] += 1;
                        }

                        if ($bm->campak != '' && $bm->campak != null) {
                            if (date('Y-m', strtotime($bm->campak))  <= date('Y-m', strtotime($mth))) {
                                $pre_data['campak'] += 1;
                            }
                        }
                    }
                    //menyusui
                    if ($bm->menyusui != '' && $bm->menyusui != null) {
                        if (date('Y-m', strtotime($mth)) >= date('Y-m', strtotime($bm->menyusui))) {
                            if ($bm->berhenti_menyusui != '' && $bm->berhenti_menyusui != null) {
                                if (date('Y-m', strtotime($mth)) <= date('Y-m', strtotime($bm->berhenti_menyusui))) {

                                    $pre_data['bumil_menyusui'] += 1;
                                }
                            } else {
                                $pre_data['bumil_menyusui'] += 1;
                            }
                        }
                    }
                }
                //jumlah diperiksa
                foreach ($bumil_timbang as $timbang) {
                    if (date('Y-m', strtotime($timbang->tanggal)) == date('Y-m', strtotime($mth))) {
                        $pre_data['bumil_timbang'] += 1;
                    }
                }
                //tambah darah
                foreach ($bumil_td as $td) {
                    if (date('Y-m', strtotime($td->tanggal)) == date('Y-m', strtotime($mth))) {
                        $pre_data['bumil_td'] += 1;
                    }
                }
                //imunisasi tt
                foreach ($bumil_tt as $tt) {
                    if (date('Y-m', strtotime($tt->tanggal)) == date('Y-m', strtotime($mth))) {
                        if ($tt->status == '1') {
                            $pre_data['bumil_tt_1'] += 1;
                        }

                        if ($tt->status == '2') {
                            $pre_data['bumil_tt_2'] += 1;
                        }
                    }
                }
                //aseptor
                foreach ($puswus as $pw) {
                    $aseptor = (object) json_decode($pw->kb);

                    if (isset($aseptor->alkon)) {
                        foreach ($aseptor->alkon as $alkon) {
                            if (date('Y-m', strtotime($mth)) >= date('Y-m', strtotime($alkon[1]))) {
                                // return date('Y-m', strtotime($alkon[1]));
                                // return date('Y-m', strtotime($mth));
                                if ($alkon[2] != '' && $alkon[2] != null) {
                                    if (date('Y-m', strtotime($mth)) <= date('Y-m', strtotime($alkon[2]))) {
                                        $pre_data['alkon'][$alkon[0]] += 1;
                                    }
                                } else {
                                    if(isset($pre_data['alkon'][$alkon[0]])){
                                        $pre_data['alkon'][$alkon[0]] += 1;    
                                    }
                                    
                                }
                            }
                        }
                    }
                }
                //bayi
                foreach ($bayi as $ba) {
                    if ($ba->meninggal == '' || $ba->meninggal == null) {
                        if (date('Y-m', strtotime($ba->tanggal_lahir)) < date('Y-m', strtotime($ba->tanggal_lahir . ' +60month'))) {
                            if (date('Y-m', strtotime($mth))  >= date('Y-m', strtotime($ba->tanggal_lahir))) {
                                if ($ba->kms == 0) {
                                    if ($ba->l_p == '1') {
                                        $pre_data['bayi_s']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_s']['p'] += 1;
                                    }
                                } else {
                                    if ($ba->l_p == '1') {
                                        $pre_data['bayi_k']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_k']['p'] += 1;
                                    }
                                }
                            }
                        }
                    }

                    if (date('Y-m', strtotime($ba->campak)) == date('Y-m', strtotime($mth))) {
                        if ($ba->l_p == '1') {
                            $pre_data['campak']['l'] += 1;
                        } else {
                            $pre_data['campak']['p'] += 1;
                        }
                    }

                    $diare = json_decode($ba->diare);
                    if (count((array) $diare) > 0) {
                        foreach ($diare as $dr) {

                            if (date('Y-m', strtotime($mth)) == date('Y-m', strtotime($dr->tanggal))) {
                                if ($ba->l_p == '1') {
                                    $pre_data['diare']['l'] += 1;
                                } else {
                                    $pre_data['diare']['p'] += 1;
                                }
                            }
                            if (date('Y-m', strtotime($mth)) == date('Y-m', strtotime($dr->oralit))) {
                                if ($ba->l_p == '1') {
                                    $pre_data['oralit']['l'] += 1;
                                } else {
                                    $pre_data['oralit']['p'] += 1;
                                }
                            }
                        }
                    }
                }
                //bayi timbang
                foreach ($bayi_timbang as $timbang) {
                    if (date('Y-m', strtotime($timbang->tanggal)) == date('Y-m', strtotime($mth))) {
                        if ($timbang->l_p == '1') {
                            $pre_data['bayi_timbang']['l'] += 1;
                        } else {
                            $pre_data['bayi_timbang']['p'] += 1;
                        }

                        if (isset($timbang->naik)) {
                            if ($timbang->l_p == '1') {
                                $pre_data['bayi_naik']['l'] += 1;
                            } else {
                                $pre_data['bayi_naik']['p'] += 1;
                            }
                        }
                    }
                }
                //vit a
                foreach ($bayi_vit as $key => $bv) {
                    $vit = json_decode($bv->vit_a);

                    foreach ($vit as $vt) {
                        if (date('Y-m', strtotime($vt->bulan_ke_1)) == date('Y-m', strtotime($mth)) || date('Y-m', strtotime($vt->bulan_ke_2)) == date('Y-m', strtotime($mth))) {
                            if ($bv->l_p == '1') {
                                $pre_data['bayi_vit_a']['l'] += 1;
                            } else {
                                $pre_data['bayi_vit_a']['p'] += 1;
                            }
                        }
                    }
                }
                //pmt
                foreach ($pmt as $key => $pm) {

                    $pt = json_decode($pm->pmt);

                    foreach ($pt as $p) {
                        if (date('Y-m', strtotime($p)) == date('Y-m', strtotime($mth))) {
                            if ($pm->l_p == '1') {
                                $pre_data['bayi_pmt']['l'] += 1;
                            } else {
                                $pre_data['bayi_pmt']['p'] += 1;
                            }
                        }
                    }
                }
                //imunisasi
                foreach ($bayi_imun as $key => $im) {
                    $hbo = json_decode($im->hbo);

                    if (count($hbo) > 0) {
                        foreach ($hbo as $hb) {
                            if (date('Y-m', strtotime($hb->tanggal)) == date('Y-m', strtotime($mth))) {
                                if ($im->l_p == '1') {
                                    $pre_data['bayi_imun']['hbo']['l'] += 1;
                                } else {
                                    $pre_data['bayi_imun']['hbo']['p'] += 1;
                                }
                            }
                        }
                    }

                    $bcg = json_decode($im->bcg);

                    if (count($bcg) > 0) {
                        foreach ($bcg as $bg) {
                            if (date('Y-m', strtotime($bg->tanggal)) == date('Y-m', strtotime($mth))) {
                                if ($im->l_p == '1') {
                                    $pre_data['bayi_imun']['bcg']['l'] += 1;
                                } else {
                                    $pre_data['bayi_imun']['bcg']['p'] += 1;
                                }
                            }
                        }
                    }

                    $dpt = json_decode($im->dpt_hb);

                    if (count((array) $dpt) > 0) {
                        foreach ($dpt as $dt) {
                            if (isset($dt->bulan_ke_1)) {
                                if (date('Y-m', strtotime($dt->bulan_ke_1)) == date('Y-m', strtotime($mth))) {
                                    if ($im->l_p == '1') {
                                        $pre_data['bayi_imun']['dpt']['i']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_imun']['dpt']['i']['p'] += 1;
                                    }
                                }
                            }
                            if (isset($dt->bulan_ke_2)) {
                                if (date('Y-m', strtotime($dt->bulan_ke_2)) == date('Y-m', strtotime($mth))) {
                                    if ($im->l_p == '1') {
                                        $pre_data['bayi_imun']['dpt']['ii']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_imun']['dpt']['ii']['p'] += 1;
                                    }
                                }
                            }
                            if (isset($dt->bulan_ke_3)) {
                                if (date('Y-m', strtotime($dt->bulan_ke_3)) == date('Y-m', strtotime($mth))) {
                                    if ($im->l_p == '1') {
                                        $pre_data['bayi_imun']['dpt']['iii']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_imun']['dpt']['iii']['p'] += 1;
                                    }
                                }
                            }
                        }
                    }

                    $polio = json_decode($im->polio);

                    if (count((array) $polio) > 0) {
                        foreach ($polio as $dt) {
                            if (isset($dt->bulan_ke_1)) {
                                if (date('Y-m', strtotime($dt->bulan_ke_1)) == date('Y-m', strtotime($mth))) {
                                    if ($im->l_p == '1') {
                                        $pre_data['bayi_imun']['polio']['i']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_imun']['polio']['i']['p'] += 1;
                                    }
                                }
                            }
                            if (isset($dt->bulan_ke_2)) {
                                if (date('Y-m', strtotime($dt->bulan_ke_2)) == date('Y-m', strtotime($mth))) {
                                    if ($im->l_p == '1') {
                                        $pre_data['bayi_imun']['polio']['ii']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_imun']['polio']['ii']['p'] += 1;
                                    }
                                }
                            }
                            if (isset($dt->bulan_ke_3)) {
                                if (date('Y-m', strtotime($dt->bulan_ke_3)) == date('Y-m', strtotime($mth))) {
                                    if ($im->l_p == '1') {
                                        $pre_data['bayi_imun']['polio']['iii']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_imun']['polio']['iii']['p'] += 1;
                                    }
                                }
                            }
                            if (isset($dt->bulan_ke_4)) {
                                if (date('Y-m', strtotime($dt->bulan_ke_4)) == date('Y-m', strtotime($mth))) {
                                    if ($im->l_p == '1') {
                                        $pre_data['bayi_imun']['polio']['iiii']['l'] += 1;
                                    } else {
                                        $pre_data['bayi_imun']['polio']['iiii']['p'] += 1;
                                    }
                                }
                            }
                        }
                    }

                    $laporan = Laporan::whereDate('tanggal', date('Y-m-d', strtotime($mth)))->where('posyandu_id', $id_posyandu)->where('laporan', 'laporan_kegiatan')->first();
                    if (isset($laporan->id)) {
                        $pre_data['keterangan'] = $laporan->keterangan;
                    }
                }


                array_push($data, $pre_data);
            } else {
                array_push($data, $pre_data);
            }
        }

        return $data;
    }


    public function keterangan(Request $request)
    {
        foreach ($request->keterangan_laporan as $key => $data) {
            if ($data != '') {
                try {
                    $laporan = Laporan::whereDate('tanggal', date('Y-m-d', strtotime($key)))->where('posyandu_id', $request->posyandu);

                    if ($laporan->count() > 0) {
                        $laporan->delete();
                    }
                    Laporan::create([
                        'posyandu_id' => $request->posyandu,
                        'laporan' => 'laporan_kegiatan',
                        'tanggal' => date('Y-m-d', strtotime($key)),
                        'keterangan' => $data
                    ]);
                } catch (QueryException $err) {
                    return ['status' => 'error', 'message' => $err->getMessage()];
                }
            }
        }

        return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
    }

    public function print($id_posyandu, $tahun)
    {

        $nama_bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $data_laporan = $this->get_data($id_posyandu, $tahun);
        return view('laporan.print_hasil_kegiatan', [
            'data_laporan' => $data_laporan,
            'tahun' => $tahun,
            'nama_bulan' => $nama_bulan,
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,

        ]);
    }
}
