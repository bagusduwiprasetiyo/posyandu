<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\BBL;
use App\Models\BBP;
use App\Models\Bumil;
use App\Models\Detail_Bayi_Imun;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Detail_Bumil_Timbang;
use App\Models\Laporan;
use App\Models\Puswus;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanBulanan extends Controller
{
    public function index($id_posyandu, $tahun, $bulan)
    {
        $title = 'Laporan Puswus Posyandu';
        $sidebarLaporan = 'active';
        $collapseLaporan = 'show';
        $sidebarlaporanbulanan = 'active';
        $laporan = Laporan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('laporan', 'bulanan')->where('posyandu_id', $id_posyandu)->first();
        if (!isset($laporan->id)) {
            if ($id_posyandu == 0) {
                $laporan = $this->jml($tahun, $bulan);
            } else {
                $laporan = $this->jml_2($id_posyandu, $tahun, $bulan);
            }
        } else {
            $laporan = (array) json_decode($laporan->keterangan, TRUE);
        }

        // return $laporan;

        $laporan['bayi_bulanan'] = $this->bayi_bulanan($id_posyandu, $tahun, $bulan);
        $laporan['bumil_bulanan'] = $this->bumil_bulanan($id_posyandu, $tahun, $bulan);

        $nama_posyandu = DB::table('list_posyandu')->where('id', $id_posyandu)->first();
        if (!isset($nama_posyandu->id)) {
            $nama_posyandu = 'Semua Posyandu';
        } else {
            $nama_posyandu = $nama_posyandu->nama;
        }

        return view('laporan.laporan_bulanan.index', [
            'title' => $title,
            'sidebarLaporan' => $sidebarLaporan,
            'collapseLaporan' => $collapseLaporan,
            'sidebarlaporanbulanan' => $sidebarlaporanbulanan,
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,
            'bulan' => date('m', strtotime($tahun . '-' . $bulan)),
            'laporan' => $laporan,
            'nama_posyandu' => $nama_posyandu
        ]);
    }

    public function jml($tahun, $bulan)
    {
        $data = array();
        // ambil tahun dan bulan
        $date = date('Y-m', strtotime($tahun . '-' . $bulan));

        // hitung jumlah bayi yang teregistrasi sampai bulan tersebut
        $data['hasil']['s'] = Bayi::where('tanggal_lahir', '<=', $date)->count();
        $data['hasil']['k'] = Bayi::where('tanggal_lahir', '<=', $date)->where('kms', 1)->count();
        // bayi yang ditimbang
        $timbang = Detail_Bayi_Timbang::whereMonth('tanggal', '=', $bulan)->whereYear('tanggal', '=', $tahun);
        // jumlah bayi yang ditimbang pada saat bulan itu
        $data['hasil']['d'] = $timbang->count();
        // jumlah bayi yang naik, turun tetap dan standar deviasinya
        $data['hasil']['n'] = 0;
        $data['hasil']['t1'] = 0;
        $data['hasil']['t2'] = 0;
        $data['hasil']['t3'] = 0;
        $data['hasil']['2t'] = 0;
        $data['hasil']['bgm'] = 0;
        $data['hasil']['bgb'] = 0;
        $data['hasil']['bayi_baru'] = 0;
        $data['hasil']['tidak_hadir'] = 0;
        $data['hasil']['bcg'] = 0;
        $data['hasil']['polio1'] = 0;
        $data['hasil']['polio2'] = 0;
        $data['hasil']['polio3'] = 0;
        $data['hasil']['polio4'] = 0;
        $data['hasil']['dpthb1'] = 0;
        $data['hasil']['dpthb2'] = 0;
        $data['hasil']['dpthb3'] = 0;
        $data['hasil']['campak'] = 0;
        foreach ($timbang->get() as $key => $value) {
            //ambil data bayi bulan sebelumnya
            $bulan_sebelumnya = Detail_Bayi_Timbang::where('bayi_id', $value->bayi_id)->where('tanggal', '<', $value->tanggal)->orderBy('tanggal', 'desc')->first();

            // deviasi bayi T1 T2 T3 
            if (isset($bulan_sebelumnya->id)) {
                $sd_bb_bulan_sekarang = $this->std($value->sd_bb);
                $sd_bb_bulan_sebelumnya = $this->std($bulan_sebelumnya->sd_bb);
                if ($value->berat_badan > $bulan_sebelumnya->berat_badan) {
                    if ($sd_bb_bulan_sekarang < $sd_bb_bulan_sebelumnya) {
                        $data['hasil']['t1']++;
                    } else {
                        $data['hasil']['n']++;
                    }
                }

                if ($value->berat_badan == $bulan_sebelumnya->berat_badan) {
                    $data['hasil']['t2']++;
                }

                if ($value->berat_badan < $bulan_sebelumnya->berat_badan) {
                    $data['hasil']['t3']++;
                }

                // 2T tidak naik dari 2 bulan penimbangan
                $dua_bulan_sebelumnya = Detail_Bayi_Timbang::where('bayi_id', $value->bayi_id)->where('tanggal', '<', $bulan_sebelumnya->tanggal)->orderBy('tanggal', 'desc')->first();
                if (isset($dua_bulan_sebelumnya->id)) {
                    if ($value->berat_badan <= $bulan_sebelumnya->berat_badan && $value->berat_badan <= $dua_bulan_sebelumnya->berat_badan) {
                        // untuk cek hilangkan komentar dibawah
                        // return  Detail_Bayi_Timbang::where('bayi_id', '102')->get();
                        $data['hasil']['2t']++;
                    }
                }
            }
            // hitung BGM (Bawah Garis Merah)
            if (isset($value->sd_bb) && $value->sd_bb == "-3") {
                $data['hasil']['bgm']++;
            }
            // ambil data bayi
            $bayi = Bayi::where('id', $value->bayi_id)->first();


            // hitung umur
            $month = date('m', strtotime($bayi->tanggal_lahir));
            $year = date('Y', strtotime($bayi->tanggal_lahir));
            $umur = (($tahun - $year) * 12) + ((int) $bulan - (int) $month);

            $antropometri = $this->antropometri_detail_bb($umur, $bayi->l_p);
            $gizi_buruk = $antropometri['min3'] - 0.5;

            if ($value->berat_badan <= $gizi_buruk) {
                $data['hasil']['bgb']++;
            }
        }

        // jumlah bayi baru
        $data['hasil']['bayi_baru'] = Bayi::whereMonth('tanggal_lahir', '=', $bulan)->whereYear('tanggal_lahir', '=', $tahun)->count();

        // bayi yang tidak hadir
        $bayi = Bayi::where('tanggal_lahir', '<=', $date)->get();
        foreach ($bayi as $key => $value) {
            $bayi_hadir = Detail_Bayi_Timbang::where('bayi_id', $value->id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->count();
            if ($bayi_hadir == 0) {
                $data['hasil']['tidak_hadir']++;
            }
        }

        // imunisasi
        $imunisasi = Detail_Bayi_Imun::all();
        foreach ($imunisasi as $key => $value) {
            // bcg
            $data_bcg = json_decode($value->bcg);
            foreach ($data_bcg as $bcg) {
                if (isset($bcg->tanggal)) {
                    if (date('Y-m', strtotime($bcg->tanggal)) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                        $data['hasil']['bcg']++;
                    }
                }
            }
            // polio
            $data_polio = json_decode($value->polio);
            foreach ($data_polio as $polio) {
                if (isset($polio->tahun_ke)) {
                    $bulan_polio = [$polio->bulan_ke_1, $polio->bulan_ke_2, $polio->bulan_ke_3, $polio->bulan_ke_4];
                    foreach ($bulan_polio as $k => $v) {
                        if ($v != '' && $v != null) {
                            if (date('Y-m', strtotime($v)) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                                if ($k == 0) {
                                    $data['hasil']['polio1']++;
                                }
                                if ($k == 1) {
                                    $data['hasil']['polio2']++;
                                }
                                if ($k == 2) {
                                    $data['hasil']['polio3']++;
                                }
                                if ($k == 3) {
                                    $data['hasil']['polio4']++;
                                }
                            }
                        }
                    }
                }
            }

            // dpthb
            $data_dpthb = json_decode($value->dpt_hb);
            foreach ($data_dpthb as $dpthb) {
                if (isset($dpthb->tahun_ke)) {
                    $bulan_dpthb = [$dpthb->bulan_ke_1, $dpthb->bulan_ke_2, $dpthb->bulan_ke_3];
                    foreach ($bulan_dpthb as $k => $v) {
                        if ($v != '' && $v != null) {
                            if (date('Y-m', strtotime($v)) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                                if ($k == 0) {
                                    $data['hasil']['dpthb1']++;
                                }
                                if ($k == 1) {
                                    $data['hasil']['dpthb2']++;
                                }
                                if ($k == 2) {
                                    $data['hasil']['dpthb3']++;
                                }
                            }
                        }
                    }
                }
            }
            $data['hasil']['campak'] = Bayi::whereMonth('campak', $bulan)->whereYear('campak', $tahun)->count();
        }

        // imunisasi TT Wus
        $data['hasil']['wus_tt'] = 0;
        $data_puswus = Puswus::where('imunisasi', '!=', '[]')->get();
        foreach ($data_puswus as $key => $value) {
            $puswus = json_decode($value->imunisasi);
            if (isset($puswus->imunisasi_tt)) {
                $jml = 0;
                foreach ($puswus->imunisasi_tt as $tt) {
                    // jika tanggal imunisasi tidak null
                    if ($tt[1] != null || $tt[1] != '') {
                        // jika tanggal kurang dari sama dengan tanggal yang diminta
                        if (date('Y-m', strtotime($tt[1])) <= date('Y-m', strtotime($tahun . '-' . $bulan))) {
                            $jml++;
                        }
                    }
                }
                if ($jml == 5) {
                    $data['hasil']['wus_tt']++;
                }
            }
        }

        // bumil yang diperiksa
        $data['target']['bumil_diperiksa'] = Bumil::where('tanggal', '<=', date('Y-m', strtotime($tahun . '-' . $bulan)))->count();
        $data['hasil']['bumil_diperiksa'] = Detail_Bumil_Timbang::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->count();

        //bumil KEK LILA < 23,5 cm
        $data['hasil']['kek_lila'] = Bumil::where('lila', '<', '23.5')->whereMonth('tanggal', $bulan)->whereYear('tanggal_persalinan', $tahun)->count();

        $data['hasil']['bufas'] = Bumil::whereMonth('tanggal_persalinan', $bulan)->whereYear('tanggal_persalinan', $tahun)->count();

        // aseptor KB
        $data['hasil']['aseptor_baru'] = [];
        $data['hasil']['aseptor_aktif'] = [];
        $kb = Puswus::where('kb', '!=', '[]')->get();
        
        foreach ($kb as $key => $value) {
            $data_kb = json_decode($value->kb);
            if(isset($data_kb->alkon)){
                foreach ($data_kb->alkon as $k => $v) {
                    if (!array_key_exists($v[0], $data['hasil']['aseptor_baru'])) {
                        $data['hasil']['aseptor_baru'] = array_merge($data['hasil']['aseptor_baru'], [$v[0] => 0]);
                    }
                    if (!array_key_exists($v[0], $data['hasil']['aseptor_aktif'])) {
                        $data['hasil']['aseptor_aktif'] = array_merge($data['hasil']['aseptor_aktif'], [$v[0] => 0]);
                    }
    
    
                    if (date('Y-m', strtotime($v[1])) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                        $data['hasil']['aseptor_baru'][$v[0]]++;
                    }
                    if ($v[2] != '' && $v[2] != null) {
                        if (date('Y-m', strtotime($tahun . '-' . $bulan)) > date('Y-m', strtotime($v[1])) && date('Y-m', strtotime($tahun . '-' . $bulan)) < date('Y-m', strtotime($v[2]))) {
                            $data['hasil']['aseptor_aktif'][$v[0]]++;
                        }
                    } else {
                        if (date('Y-m', strtotime($tahun . '-' . $bulan)) > date('Y-m', strtotime($v[1]))) {
                            $data['hasil']['aseptor_aktif'][$v[0]]++;
                        }
                    }
                }    
            }
            
        }


        return $data;
    }

    // jika ada id_posyandu
    public function jml_2($id_posyandu, $tahun, $bulan)
    {
        $data = array();
        // ambil tahun dan bulan
        $date = date('Y-m', strtotime($tahun . '-' . $bulan));

        // hitung jumlah bayi yang teregistrasi sampai bulan tersebut
        $data['hasil']['s'] = Bayi::where('tanggal_lahir', '<=', $date)->where('posyandu_id', $id_posyandu)->count();
        $data['hasil']['k'] = Bayi::where('tanggal_lahir', '<=', $date)->where('posyandu_id', $id_posyandu)->where('kms', 1)->count();
        // bayi yang ditimbang
        $timbang = Detail_Bayi_Timbang::select('detail_bayi_timbang.*', 'bayi.posyandu_id as posyandu_id')->join('bayi', 'bayi.id', 'detail_bayi_timbang.bayi_id')->where('bayi.posyandu_id', $id_posyandu)->whereMonth('tanggal', '=', $bulan)->whereYear('tanggal', '=', $tahun);
        // jumlah bayi yang ditimbang pada saat bulan itu
        $data['hasil']['d'] = $timbang->count();
        // jumlah bayi yang naik, turun tetap dan standar deviasinya
        $data['hasil']['n'] = 0;
        $data['hasil']['t1'] = 0;
        $data['hasil']['t2'] = 0;
        $data['hasil']['t3'] = 0;
        $data['hasil']['2t'] = 0;
        $data['hasil']['bgm'] = 0;
        $data['hasil']['bgb'] = 0;
        $data['hasil']['bayi_baru'] = 0;
        $data['hasil']['tidak_hadir'] = 0;
        $data['hasil']['bcg'] = 0;
        $data['hasil']['polio1'] = 0;
        $data['hasil']['polio2'] = 0;
        $data['hasil']['polio3'] = 0;
        $data['hasil']['polio4'] = 0;
        $data['hasil']['dpthb1'] = 0;
        $data['hasil']['dpthb2'] = 0;
        $data['hasil']['dpthb3'] = 0;
        $data['hasil']['campak'] = 0;
        foreach ($timbang->get() as $key => $value) {
            //ambil data bayi bulan sebelumnya
            $bulan_sebelumnya = Detail_Bayi_Timbang::where('bayi_id', $value->bayi_id)->where('tanggal', '<', $value->tanggal)->orderBy('tanggal', 'desc')->first();

            // deviasi bayi T1 T2 T3 
            if (isset($bulan_sebelumnya->id)) {
                $sd_bb_bulan_sekarang = $this->std($value->sd_bb);
                $sd_bb_bulan_sebelumnya = $this->std($bulan_sebelumnya->sd_bb);
                if ($value->berat_badan > $bulan_sebelumnya->berat_badan) {
                    if ($sd_bb_bulan_sekarang < $sd_bb_bulan_sebelumnya) {
                        $data['hasil']['t1']++;
                    } else {
                        $data['hasil']['n']++;
                    }
                }

                if ($value->berat_badan == $bulan_sebelumnya->berat_badan) {
                    $data['hasil']['t2']++;
                }

                if ($value->berat_badan < $bulan_sebelumnya->berat_badan) {
                    $data['hasil']['t3']++;
                }

                // 2T tidak naik dari 2 bulan penimbangan
                $dua_bulan_sebelumnya = Detail_Bayi_Timbang::where('bayi_id', $value->bayi_id)->where('tanggal', '<', $bulan_sebelumnya->tanggal)->orderBy('tanggal', 'desc')->first();
                if (isset($dua_bulan_sebelumnya->id)) {
                    if ($value->berat_badan <= $bulan_sebelumnya->berat_badan && $value->berat_badan <= $dua_bulan_sebelumnya->berat_badan) {
                        // untuk cek hilangkan komentar dibawah
                        // return  Detail_Bayi_Timbang::where('bayi_id', '102')->get();
                        $data['hasil']['2t']++;
                    }
                }
            }
            // hitung BGM (Bawah Garis Merah)
            if (isset($value->sd_bb) && $value->sd_bb == "-3") {
                $data['hasil']['bgm']++;
            }
            // ambil data bayi
            $bayi = Bayi::where('id', $value->bayi_id)->first();


            // hitung umur
            $month = date('m', strtotime($bayi->tanggal_lahir));
            $year = date('Y', strtotime($bayi->tanggal_lahir));
            $umur = (($tahun - $year) * 12) + ((int) $bulan - (int) $month);

            $antropometri = $this->antropometri_detail_bb($umur, $bayi->l_p);
            $gizi_buruk = $antropometri['min3'] - 0.5;

            if ($value->berat_badan <= $gizi_buruk) {
                $data['hasil']['bgb']++;
            }
        }

        // jumlah bayi baru
        $data['hasil']['bayi_baru'] = Bayi::whereMonth('tanggal_lahir', '=', $bulan)->whereYear('tanggal_lahir', '=', $tahun)->where('posyandu_id', $id_posyandu)->count();

        // bayi yang tidak hadir
        $bayi = Bayi::where('tanggal_lahir', '<=', $date)->where('posyandu_id', $id_posyandu)->get();
        foreach ($bayi as $key => $value) {
            $bayi_hadir = Detail_Bayi_Timbang::where('bayi_id', $value->id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->count();
            if ($bayi_hadir == 0) {
                $data['hasil']['tidak_hadir']++;
            }
        }

        // imunisasi
        $imunisasi = Detail_Bayi_Imun::select('detail_bayi_imun.*', 'bayi.posyandu_id')->join('bayi', 'bayi.id', 'detail_bayi_imun.bayi_id')->where('bayi.posyandu_id', $id_posyandu)->get();
        foreach ($imunisasi as $key => $value) {
            // bcg
            $data_bcg = json_decode($value->bcg);
            foreach ($data_bcg as $bcg) {
                if (isset($bcg->tanggal)) {
                    if (date('Y-m', strtotime($bcg->tanggal)) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                        $data['hasil']['bcg']++;
                    }
                }
            }
            // polio
            $data_polio = json_decode($value->polio);
            foreach ($data_polio as $polio) {
                if (isset($polio->tahun_ke)) {
                    $bulan_polio = [$polio->bulan_ke_1, $polio->bulan_ke_2, $polio->bulan_ke_3, $polio->bulan_ke_4];
                    foreach ($bulan_polio as $k => $v) {
                        if ($v != '' && $v != null) {
                            if (date('Y-m', strtotime($v)) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                                if ($k == 0) {
                                    $data['hasil']['polio1']++;
                                }
                                if ($k == 1) {
                                    $data['hasil']['polio2']++;
                                }
                                if ($k == 2) {
                                    $data['hasil']['polio3']++;
                                }
                                if ($k == 3) {
                                    $data['hasil']['polio4']++;
                                }
                            }
                        }
                    }
                }
            }

            // dpthb
            $data_dpthb = json_decode($value->dpt_hb);
            foreach ($data_dpthb as $dpthb) {
                if (isset($dpthb->tahun_ke)) {
                    $bulan_dpthb = [$dpthb->bulan_ke_1, $dpthb->bulan_ke_2, $dpthb->bulan_ke_3];
                    foreach ($bulan_dpthb as $k => $v) {
                        if ($v != '' && $v != null) {
                            if (date('Y-m', strtotime($v)) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                                if ($k == 0) {
                                    $data['hasil']['dpthb1']++;
                                }
                                if ($k == 1) {
                                    $data['hasil']['dpthb2']++;
                                }
                                if ($k == 2) {
                                    $data['hasil']['dpthb3']++;
                                }
                            }
                        }
                    }
                }
            }
            $data['hasil']['campak'] = Bayi::whereMonth('campak', $bulan)->whereYear('campak', $tahun)->where('posyandu_id', $id_posyandu)->count();
        }

        // imunisasi TT Wus
        $data['hasil']['wus_tt'] = 0;
        $data_puswus = Puswus::where('imunisasi', '!=', '[]')->where('posyandu_id', $id_posyandu)->get();
        foreach ($data_puswus as $key => $value) {
            $puswus = json_decode($value->imunisasi);
            if (isset($puswus->imunisasi_tt)) {
                $jml = 0;
                foreach ($puswus->imunisasi_tt as $tt) {
                    // jika tanggal imunisasi tidak null
                    if ($tt[1] != null || $tt[1] != '') {
                        // jika tanggal kurang dari sama dengan tanggal yang diminta
                        if (date('Y-m', strtotime($tt[1])) <= date('Y-m', strtotime($tahun . '-' . $bulan))) {
                            $jml++;
                        }
                    }
                }
                if ($jml == 5) {
                    $data['hasil']['wus_tt']++;
                }
            }
        }

        // bumil yang diperiksa
        $data['target']['bumil_diperiksa'] = Bumil::where('tanggal', '<=', date('Y-m', strtotime($tahun . '-' . $bulan)))->where('posyandu_id', $id_posyandu)->count();
        $data['hasil']['bumil_diperiksa'] = Detail_Bumil_Timbang::select('detail_bumils_hasil_penimbangan.*', 'bumils.posyandu_id')->join('bumils', 'detail_bumils_hasil_penimbangan.bumils_id', 'bumils.id')->whereMonth('detail_bumils_hasil_penimbangan.tanggal', $bulan)->whereYear('detail_bumils_hasil_penimbangan.tanggal', $tahun)->where('posyandu_id', $id_posyandu)->count();

        //bumil KEK LILA < 23,5 cm
        $data['hasil']['kek_lila'] = Bumil::where('lila', '<', '23.5')->where('posyandu_id', $id_posyandu)->whereMonth('tanggal', $bulan)->whereYear('tanggal_persalinan', $tahun)->count();

        $data['hasil']['bufas'] = Bumil::whereMonth('tanggal_persalinan', $bulan)->whereYear('tanggal_persalinan', $tahun)->where('posyandu_id', $id_posyandu)->count();

        // aseptor KB
        $data['hasil']['aseptor_baru'] = [];
        $data['hasil']['aseptor_aktif'] = [];
        $kb = Puswus::where('kb', '!=', '[]')->where('posyandu_id', $id_posyandu)->get();
        foreach ($kb as $key => $value) {
            $data_kb = json_decode($value->kb);
            foreach ($data_kb->alkon as $k => $v) {
                if (!array_key_exists($v[0], $data['hasil']['aseptor_baru'])) {
                    $data['hasil']['aseptor_baru'] = array_merge($data['hasil']['aseptor_baru'], [$v[0] => 0]);
                }
                if (!array_key_exists($v[0], $data['hasil']['aseptor_aktif'])) {
                    $data['hasil']['aseptor_aktif'] = array_merge($data['hasil']['aseptor_aktif'], [$v[0] => 0]);
                }


                if (date('Y-m', strtotime($v[1])) == date('Y-m', strtotime($tahun . '-' . $bulan))) {
                    $data['hasil']['aseptor_baru'][$v[0]]++;
                }
                if ($v[2] != '' && $v[2] != null) {
                    if (date('Y-m', strtotime($tahun . '-' . $bulan)) > date('Y-m', strtotime($v[1])) && date('Y-m', strtotime($tahun . '-' . $bulan)) < date('Y-m', strtotime($v[2]))) {
                        $data['hasil']['aseptor_aktif'][$v[0]]++;
                    }
                } else {
                    if (date('Y-m', strtotime($tahun . '-' . $bulan)) > date('Y-m', strtotime($v[1]))) {
                        $data['hasil']['aseptor_aktif'][$v[0]]++;
                    }
                }
            }
        }


        return $data;
    }

    public function std($sd_bb)
    {
        if ($sd_bb == '-3') {
            $sd_bb = 7;
        }
        if ($sd_bb == '-2') {
            $sd_bb = 6;
        }
        if ($sd_bb == '-1') {
            $sd_bb = 5;
        }
        if ($sd_bb == 'median') {
            $sd_bb = 4;
        }
        if ($sd_bb == '+1') {
            $sd_bb = 3;
        }
        if ($sd_bb == '+2') {
            $sd_bb = 2;
        }
        if ($sd_bb == '+3') {
            $sd_bb = 1;
        }
        return $sd_bb;
    }

    // antropometri
    public function antropometri_detail_bb($umur, $jk)
    {
        switch ($jk) {
            case 1:
                return BBL::select('min3', 'min2', 'min1', 'median', 'plus1', 'plus2', 'plus3')->where('umur', $umur)->first();
                break;
            case 2:
                return BBP::select('min3', 'min2', 'min1', 'median', 'plus1', 'plus2', 'plus3')->where('umur', $umur)->first();
                break;
            default:
                # code...
                break;
        }
    }

    // data bayi

    public function bayi_bulanan($id_posyandu, $tahun, $bulan)
    {
        $data = array();
        if ($id_posyandu == 0) {
            $timbang = Detail_Bayi_Timbang::select('detail_bayi_timbang.*', 'bayi.posyandu_id', 'bayi.nama', 'bayi.tanggal_lahir')->join('bayi', 'bayi.id', 'detail_bayi_timbang.bayi_id')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
        } else {
            $timbang = Detail_Bayi_Timbang::select('detail_bayi_timbang.*', 'bayi.posyandu_id', 'bayi.nama', 'bayi.tanggal_lahir')->join('bayi', 'bayi.id', 'detail_bayi_timbang.bayi_id')->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('posyandu_id', $id_posyandu)->get();
        }

        foreach ($timbang as $key => $value) {
            // hitung umur
            $month = date('m', strtotime($value->tanggal_lahir));
            $year = date('Y', strtotime($value->tanggal_lahir));
            $umur = (($tahun - $year) * 12) + ((int) $bulan - (int) $month);

            //ambil data bayi bulan sebelumnya
            $bulan_sebelumnya = Detail_Bayi_Timbang::where('bayi_id', $value->bayi_id)->where('tanggal', '<', $value->tanggal)->orderBy('tanggal', 'desc')->first();

            // deviasi bayi T1 T2 T3 
            if (isset($bulan_sebelumnya->id)) {
                $sd_bb_bulan_sekarang = $this->std($value->sd_bb);
                $sd_bb_bulan_sebelumnya = $this->std($bulan_sebelumnya->sd_bb);
                if ($value->berat_badan > $bulan_sebelumnya->berat_badan) {
                    if ($sd_bb_bulan_sekarang < $sd_bb_bulan_sebelumnya) {
                        $ntob = 'T1';
                    } else {
                        $ntob = 'N';
                    }
                }

                if ($value->berat_badan == $bulan_sebelumnya->berat_badan) {
                    $ntob = 'T2';
                }

                if ($value->berat_badan < $bulan_sebelumnya->berat_badan) {
                    $ntob = 'T3';
                }

                // // 2T tidak naik dari 2 bulan penimbangan
                // $dua_bulan_sebelumnya = Detail_Bayi_Timbang::where('bayi_id', $value->bayi_id)->where('tanggal', '<', $bulan_sebelumnya->tanggal)->orderBy('tanggal', 'desc')->first();
                // if (isset($dua_bulan_sebelumnya->id)) {
                //     if ($value->berat_badan <= $bulan_sebelumnya->berat_badan && $value->berat_badan <= $dua_bulan_sebelumnya->berat_badan) {
                //         // untuk cek hilangkan komentar dibawah
                //         // return  Detail_Bayi_Timbang::where('bayi_id', '102')->get();
                //         $ntob = '2t';
                //     }
                // }
            } else {
                $ntob = 'O';
            }

            $data[$value->id] = ['nama' => $value->nama, 'umur' => $umur, 'berat_badan' => $value->berat_badan, 'ntob' => $ntob];
        }

        return $data;
    }

    public function bumil_bulanan($id_posyandu, $tahun, $bulan)
    {
        if ($id_posyandu == 0) {
            $bumil = Detail_Bumil_Timbang::select('detail_bumils_hasil_penimbangan.*', 'bumils.posyandu_id', 'bumils.nama_ibu', 'bumils.umur')->join('bumils', 'bumils.id', 'detail_bumils_hasil_penimbangan.bumils_id')->whereMonth('detail_bumils_hasil_penimbangan.tanggal', $bulan)->whereYear('detail_bumils_hasil_penimbangan.tanggal', $tahun)->get();
        } else {
            $bumil = Detail_Bumil_Timbang::select('detail_bumils_hasil_penimbangan.*', 'bumils.posyandu_id', 'bumils.nama_ibu', 'bumils.umur')->join('bumils', 'bumils.id', 'detail_bumils_hasil_penimbangan.bumils_id')->whereMonth('detail_bumils_hasil_penimbangan.tanggal', $bulan)->whereYear('detail_bumils_hasil_penimbangan.tanggal', $tahun)->where('posyandu_id', $id_posyandu)->get();
        }
        return $bumil;
    }

    public function test()
    {
        return 'oke';
    }

    public function keterangan(Request $request)
    {
        // return $request;
        try {
            $bulan = date('m', strtotime($request->bulan_tahun));
            $tahun = date('Y', strtotime($request->bulan_tahun));
            $laporan = Laporan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('posyandu_id', $request->posyandu_id)->where('laporan', 'bulanan');

            if ($laporan->count() > 0) {
                $laporan->delete();
            }
            Laporan::create([
                'posyandu_id' => $request->posyandu_id,
                'laporan' => 'bulanan',
                'tanggal' => date('Y-m-d', strtotime($request->bulan_tahun)),
                'keterangan' => json_encode([
                    'desa' => $request->desa,
                    'hasil' => $request->hasil,
                    'keterangan' => $request->keterangan,
                    'permasalahan' => $request->permasalahan,
                    'puskesmas' => $request->puskesmas,
                    'rencana' => $request->rencana,
                    'target' => $request->target,
                ])
            ]);
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
        }

        return ['status' => 'success', 'message' => 'Berhasil menyimpan data'];
    }

    public function print($id_posyandu, $tahun, $bulan)
    {
        $laporan = Laporan::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('laporan', 'bulanan')->where('posyandu_id', $id_posyandu)->first();
        if (!isset($laporan->id)) {
            if ($id_posyandu == 0) {
                $laporan = $this->jml($tahun, $bulan);
            } else {
                $laporan = $this->jml_2($id_posyandu, $tahun, $bulan);
            }
        } else {
            $laporan = (array) json_decode($laporan->keterangan, TRUE);
        }

        // return $laporan;

        $laporan['bayi_bulanan'] = $this->bayi_bulanan($id_posyandu, $tahun, $bulan);
        $laporan['bumil_bulanan'] = $this->bumil_bulanan($id_posyandu, $tahun, $bulan);

        $nama_posyandu = DB::table('list_posyandu')->where('id', $id_posyandu)->first();
        if (!isset($nama_posyandu->id)) {
            $nama_posyandu = 'Semua Posyandu';
        } else {
            $nama_posyandu = $nama_posyandu->nama;
        }

        return view('laporan.laporan_bulanan.print', [
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,
            'bulan' => date('m', strtotime($tahun . '-' . $bulan)),
            'laporan' => $laporan,
            'nama_posyandu' => $nama_posyandu
        ]);
    }
}
