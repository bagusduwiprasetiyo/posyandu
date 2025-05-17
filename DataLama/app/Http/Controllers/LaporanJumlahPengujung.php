<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use App\Models\Bumil;
use App\Models\Detail_Bayi_Timbang;
use App\Models\Laporan;
use App\Models\Puswus;
use Illuminate\Http\Request;

class LaporanJumlahPengujung extends Controller
{
    public function index($id_posyandu, $tahun)
    {
        $title = 'Laporan Jumlah Pengunjung Posyandu';
        $sidebarLaporan = 'active';
        $collapseLaporan = 'show';
        $sidebarjumlahpengunjung = 'active';

        $laporan = $this->jml($id_posyandu, $tahun);

        return view('laporan.jumlah_pengunjung.index', [
            'title' => $title,
            'sidebarLaporan' => $sidebarLaporan,
            'collapseLaporan' => $collapseLaporan,
            'sidebarjumlahpengunjung' => $sidebarjumlahpengunjung,
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,
            'laporan' => $laporan
        ]);
    }

    public function jml($id_posyandu, $tahun)
    {
        $month = [];
        for ($i = 1; $i <= 12; $i++) {
            array_push($month, date('Y-m', strtotime($tahun . '-' . $i)));
        }

        $data = array();

        foreach ($month as $key_mth => $mth) {
            $pre_data = array();
            $pre_data = array_merge($pre_data, ['bulan' => $mth]);
            if (date('Y-m', strtotime($mth)) < date('Y-m')) {
                if ($id_posyandu == 0) {
                    $year_ = date('Y', strtotime($mth));
                    $month_ = date('m', strtotime($mth));

                    //BALITA
                    $bayi_timbang = Detail_Bayi_Timbang::select('detail_bayi_timbang.*', 'bayi.l_p')->join('bayi', 'bayi.id', 'detail_bayi_timbang.bayi_id')->whereYear('detail_bayi_timbang.tanggal', $year_)->whereMonth('detail_bayi_timbang.tanggal', $month_)->get();

                    if (!array_key_exists('bayi', $pre_data)) {
                        $pre_data = array_merge($pre_data, [
                            'bayi_baru' => [
                                'l' => 0,
                                'p' => 0
                            ],
                            'bayi_lama' => [
                                'l' => 0,
                                'p' => 0
                            ],
                            'balita_baru' => [
                                'l' => 0,
                                'p' => 0
                            ],
                            'balita_lama' => [
                                'l' => 0,
                                'p' => 0
                            ],
                        ]);
                    }

                    if (count($bayi_timbang) > 0) {
                        foreach ($bayi_timbang as $bt) {
                            $penimbangan_lalu = Detail_Bayi_Timbang::whereDate('tanggal', '<', $bt->tanggal)->where('bayi_id', $bt->bayi_id)->count();
                            if ($bt->l_p == 1) {
                                $jk = 'l';
                            } else {
                                $jk = 'p';
                            }
                            //jika > 12 bulan, maka namanya balita, jika kurang maka namanya bayi
                            if ($penimbangan_lalu > 0) {
                                if ($bt->umur_bulan > 12) {
                                    $pre_data['balita_lama'][$jk] += 1;
                                } else {
                                    $pre_data['bayi_lama'][$jk] += 1;
                                }
                            } else {
                                if ($bt->umur_bulan > 12) {
                                    $pre_data['balita_baru'][$jk] += 1;
                                } else {
                                    $pre_data['bayi_baru'][$jk] += 1;
                                }
                            }
                        }
                    }



                    //PUSWUS
                    $puswus = Puswus::get();

                    foreach ($puswus as $pw) {
                        $selesai_wus = date('Y', strtotime($pw->tgl_lahir_wuspus . '+49 year'));
                        $selesai_pus = date('Y', strtotime($pw->tgl_lahir_suami . '+49 year'));

                        if (!array_key_exists('wus', $pre_data)) {
                            $pre_data = array_merge($pre_data, ['wus'  => 0]);
                        }

                        if (date('Y') < $selesai_wus) {
                            $pre_data['wus'] += 1;
                        }

                        if (!array_key_exists('pus', $pre_data)) {
                            $pre_data = array_merge($pre_data, ['pus'  => 0]);
                        }
                        if (date('Y') < $selesai_pus) {
                            if ($pw->tgl_lahir_suami != '' && $pw->tgl_lahir_suami != NULL) {
                                $pre_data['pus'] += 1;
                            }
                        }
                    }

                    //BUMIL

                    $bumil =  Bumil::whereYear('tanggal', '<=', $tahun)->get();

                    if (!array_key_exists('bumil', $pre_data)) {
                        $pre_data = array_merge($pre_data, ['bumil' => 0]);
                        $pre_data = array_merge($pre_data, ['menyusui' => 0]);
                    }

                    foreach ($bumil as $bm) {
                        // jml ibu hamil
                        if (date('Y-m', strtotime($bm->tanggal)) <= date('Y-m', strtotime($mth))) {
                            if ($bm->tanggal_persalinan != '') {
                                $persalinan = date('Y-m', strtotime($bm->tanggal_persalinan));
                                if (date('Y-m', strtotime($mth)) < $persalinan) {
                                    $pre_data['bumil'] += 1;
                                }
                            } else {
                                $pre_data['bumil'] += 1;
                            }
                        }

                        // jml menyusui
                        if ($bm->menyusui != '' && $bm->menyusui != null) {
                            if ($bm->berhenti_menyusui != '' && $bm->menyusui != null) {
                                $berhenti_menyusui = date('Y-m', strtotime($bm->berhenti_menyusui));
                                if (date('Y-m', strtotime($mth)) < $berhenti_menyusui) {
                                    $pre_data['menyusui'] += 1;
                                }
                            } else {
                                $pre_data['menyusui'] += 1;
                            }
                        }
                    }

                    // bayi dilahirkan
                    if (!array_key_exists('bayi_lahir', $pre_data)) {
                        $pre_data = array_merge($pre_data, ['bayi_lahir' => [
                            'l' => 0,
                            'p' => 0
                        ]]);
                    }
                    $bayi_dilahirkan = Bayi::whereYear('tanggal_lahir', $year_)->whereMonth('tanggal_lahir', $month_);
                    $pre_data['bayi_lahir']['l'] = $bayi_dilahirkan->where('l_p', 1)->count();
                    $pre_data['bayi_lahir']['p'] = $bayi_dilahirkan->where('l_p', 2)->count();

                    //bayi meninggal
                    if (!array_key_exists('bayi_meninggal', $pre_data)) {
                        $pre_data = array_merge($pre_data, ['bayi_meninggal' => [
                            'l' => 0,
                            'p' => 0
                        ]]);
                    }
                    $bayi_meninggal = Bayi::whereYear('meninggal', $year_)->whereMonth('meninggal', $month_);
                    $pre_data['bayi_meninggal']['l'] = $bayi_meninggal->where('l_p', 1)->count();
                    $pre_data['bayi_meninggal']['p'] = $bayi_meninggal->where('l_p', 2)->count();

                    //keterangan
                    $laporan = Laporan::whereYear('tanggal', $year_)->where('posyandu_id', $id_posyandu)->where('laporan', 'jumlah_pengunjung')->first();

                    if (isset($laporan->id)) {
                        $keterangan = (array) json_decode($laporan->keterangan);
                        //petugas

                        $pre_data['kader']['l'] = $keterangan['petugas']->kader->l;
                        $pre_data['kader']['p'] = $keterangan['petugas']->kader->p;
                        $pre_data['plkb']['l'] = $keterangan['petugas']->plkb->l;
                        $pre_data['plkb']['p'] = $keterangan['petugas']->plkb->p;
                        $pre_data['medis']['l'] = $keterangan['petugas']->medis->l;
                        $pre_data['medis']['p'] = $keterangan['petugas']->medis->p;


                        $pre_data['keterangan'] = $keterangan['keterangan_laporan'];
                    }
                } else {
                    // jika semua posyandu
                    $year_ = date('Y', strtotime($mth));
                    $month_ = date('m', strtotime($mth));

                    //BALITA
                    $bayi_timbang = Detail_Bayi_Timbang::select('detail_bayi_timbang.*', 'bayi.l_p')->join('bayi', 'bayi.id', 'detail_bayi_timbang.bayi_id')->whereYear('detail_bayi_timbang.tanggal', $year_)->whereMonth('detail_bayi_timbang.tanggal', $month_)->where('posyandu_id', $id_posyandu)->get();

                    if (!array_key_exists('bayi', $pre_data)) {
                        $pre_data = array_merge($pre_data, [
                            'bayi_baru' => [
                                'l' => 0,
                                'p' => 0
                            ],
                            'bayi_lama' => [
                                'l' => 0,
                                'p' => 0
                            ],
                            'balita_baru' => [
                                'l' => 0,
                                'p' => 0
                            ],
                            'balita_lama' => [
                                'l' => 0,
                                'p' => 0
                            ],
                        ]);
                    }

                    if (count($bayi_timbang) > 0) {
                        foreach ($bayi_timbang as $bt) {
                            $penimbangan_lalu = Detail_Bayi_Timbang::whereDate('tanggal', '<', $bt->tanggal)->where('bayi_id', $bt->bayi_id)->count();
                            if ($bt->l_p == 1) {
                                $jk = 'l';
                            } else {
                                $jk = 'p';
                            }
                            //jika > 12 bulan, maka namanya balita, jika kurang maka namanya bayi
                            if ($penimbangan_lalu > 0) {
                                if ($bt->umur_bulan > 12) {
                                    $pre_data['balita_lama'][$jk] += 1;
                                } else {
                                    $pre_data['bayi_lama'][$jk] += 1;
                                }
                            } else {
                                if ($bt->umur_bulan > 12) {
                                    $pre_data['balita_baru'][$jk] += 1;
                                } else {
                                    $pre_data['bayi_baru'][$jk] += 1;
                                }
                            }
                        }
                    }


                    //PUSWUS
                    $puswus = Puswus::where('posyandu_id', $id_posyandu)->get();

                    foreach ($puswus as $pw) {
                        $selesai_wus = date('Y', strtotime($pw->tgl_lahir_wuspus . '+49year'));
                        $selesai_pus = date('Y', strtotime($pw->tgl_lahir_suami . '+49year'));

                        if (!array_key_exists('wus', $pre_data)) {
                            $pre_data = array_merge($pre_data, ['wus'  => 0]);
                        }

                        if (date('Y') < $selesai_wus) {
                            $pre_data['wus'] += 1;
                        }

                        if (!array_key_exists('pus', $pre_data)) {
                            $pre_data = array_merge($pre_data, ['pus'  => 0]);
                        }
                        if (date('Y') < $selesai_pus) {
                            $pre_data['pus'] += 1;
                        }
                    }

                    $bumil =  Bumil::whereYear('tanggal', '<=', $tahun)->where('posyandu_id', $id_posyandu)->get();

                    if (!array_key_exists('bumil', $pre_data)) {
                        $pre_data = array_merge($pre_data, ['bumil' => 0]);
                        $pre_data = array_merge($pre_data, ['menyusui' => 0]);
                    }

                    foreach ($bumil as $bm) {
                        // jml ibu hamil
                        if (date('Y-m', strtotime($bm->tanggal)) <= date('Y-m', strtotime($mth))) {
                            if ($bm->tanggal_persalinan != '') {
                                $persalinan = date('Y-m', strtotime($bm->tanggal_persalinan));
                                if (date('Y-m', strtotime($mth)) < $persalinan) {
                                    $pre_data['bumil'] += 1;
                                }
                            } else {
                                $pre_data['bumil'] += 1;
                            }
                        }

                        // jml menyusui
                        if ($bm->menyusui != '' && $bm->menyusui != null) {
                            if ($bm->berhenti_menyusui != '' && $bm->menyusui != null) {
                                $berhenti_menyusui = date('Y-m', strtotime($bm->berhenti_menyusui));
                                if (date('Y-m', strtotime($mth)) < $berhenti_menyusui) {
                                    $pre_data['menyusui'] += 1;
                                }
                            } else {
                                $pre_data['menyusui'] += 1;
                            }
                        }
                    }

                    // bayi dilahirkan
                    if (!array_key_exists('bayi_lahir', $pre_data)) {
                        $pre_data = array_merge($pre_data, ['bayi_lahir' => [
                            'l' => 0,
                            'p' => 0
                        ]]);
                    }

                    $bayi_dilahirkan = Bayi::whereYear('tanggal_lahir', $year_)->whereMonth('tanggal_lahir', $month_)->where('posyandu_id', $id_posyandu);
                    $pre_data['bayi_lahir']['l'] = $bayi_dilahirkan->where('l_p', 1)->count();
                    $pre_data['bayi_lahir']['p'] = $bayi_dilahirkan->where('l_p', 2)->count();

                    //bayi meninggal
                    if (!array_key_exists('bayi_meninggal', $pre_data)) {
                        $pre_data = array_merge($pre_data, ['bayi_meninggal' => [
                            'l' => 0,
                            'p' => 0
                        ]]);
                    }
                    $bayi_meninggal = Bayi::whereYear('meninggal', $year_)->whereMonth('meninggal', $month_)->where('posyandu_id', $id_posyandu);
                    $pre_data['bayi_meninggal']['l'] = $bayi_meninggal->where('l_p', 1)->count();
                    $pre_data['bayi_meninggal']['p'] = $bayi_meninggal->where('l_p', 2)->count();

                    //keterangan
                    $laporan = Laporan::whereYear('tanggal', $year_)->where('posyandu_id', $id_posyandu)->where('laporan', 'jumlah_pengunjung')->first();

                    if (isset($laporan->id)) {
                        $keterangan = (array) json_decode($laporan->keterangan);
                        //petugas

                        $pre_data['kader']['l'] = $keterangan['petugas']->kader->l;
                        $pre_data['kader']['p'] = $keterangan['petugas']->kader->p;
                        $pre_data['plkb']['l'] = $keterangan['petugas']->plkb->l;
                        $pre_data['plkb']['p'] = $keterangan['petugas']->plkb->p;
                        $pre_data['medis']['l'] = $keterangan['petugas']->medis->l;
                        $pre_data['medis']['p'] = $keterangan['petugas']->medis->p;


                        $pre_data['keterangan'] = (array) $keterangan['keterangan_laporan'];
                    }
                }
            }

            array_push($data, $pre_data);
        }

        return $data;
    }

    public function keterangan(Request $request)
    {
        try {
            $year = date('Y', strtotime($request->tahun));
            // return Laporan::whereYear('tanggal', $year)->get();
            $laporan = Laporan::whereYear('tanggal', $year)->where('posyandu_id', $request->posyandu_id)->where('laporan', 'jumlah_pengunjung');

            if ($laporan->count() > 0) {
                $laporan->delete();
            }

            Laporan::create([
                'posyandu_id' => $request->posyandu_id,
                'laporan' => 'jumlah_pengunjung',
                'tanggal' => date('Y-m-d', strtotime($request->tahun)),
                'keterangan' => json_encode([
                    'petugas' => $request->petugas,
                    'keterangan_laporan' => $request->keterangan_laporan
                ])
            ]);
        } catch (QueryException $err) {
            return ['status' => 'error', 'message' => $err->getMessage()];
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
        $laporan = $this->jml($id_posyandu, $tahun);
        return view('laporan.jumlah_pengunjung.print', [
            'laporan' => $laporan,
            'tahun' => $tahun,
            'nama_bulan' => $nama_bulan,
            'id_posyandu' => $id_posyandu,
            'tahun' => $tahun,

        ]);
    }
}
