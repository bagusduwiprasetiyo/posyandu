<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <style>
        @media print {
            body {
                font-family: 'Times New Roman', Times, serif;
            }

            th {
                table-layout: fixed;
                font-size: 6pt;
            }



            /* table {
                font-size: 2pt;
                text-align: center;
                width: fit-content;
            } */
        }
    </style>
</head>

<body>
    <div id="print">
        <center>
            <h3>DATA REGISTASI BAYI</h3>
        </center>
        <br>
        <?php

        use App\Models\Bayi;
        use App\Models\Detail_Bayi_Imun;
        use App\Models\Detail_Bayi_Obat;
        use App\Models\Detail_Bayi_Timbang;

        $nama_posyandu = DB::table('list_posyandu')->where('id', $id_posyandu)->first();
        ?>

        <p style="font-size: 9pt;">Nama Posyandu : {{$id_posyandu == 0? 'Semua Posyandu': $nama_posyandu->nama}}</p>
        <!-- <p style="font-size: 9pt;">Tahun : {{$tahun}}</p> -->
        <br>
        <table style="font-size: 8pt; text-align: center;" border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr>
                    <th style="font-weight: bold;" rowspan="3">No</th>
                    <th style="font-weight: bold;" rowspan="3">Nama Bayi</th>
                    <th style="font-weight: bold;" rowspan="3">Tanggal Lahir</th>
                    <th style="font-weight: bold;" rowspan="3" class="rotate">BB/PB</th>
                    <th style="font-weight: bold;" rowspan="3">Nama Orang Tua</th>
                    <th style="font-weight: bold;" rowspan="3" class="rotate">L/P</th>
                    <th style="font-weight: bold; text-align: center;" colspan="12">Hasil Penimbangan</th>
                    <th style="font-weight: bold;" colspan="5">Pemberian</th>
                    <th style="font-weight: bold;" colspan="9">Pelayanan Imunisasi</th>
                    <th style="font-weight: bold;" rowspan="3">Campak</th>
                    <th style="font-weight: bold;" rowspan="3">Meninggal</th>
                    <th style="font-weight: bold;" rowspan="3">Keterangan</th>


                </tr>
                <tr>

                    <th style="font-weight: bold;" colspan="12">
                        <center>Bulan</center>
                    </th>
                    <th style="font-weight: bold;" colspan="2">sirup FE
                    </th>
                    <th style="font-weight: bold;" colspan="2">Vit A</th>
                    <th style="font-weight: bold;" rowspan="2">Oralit BLN</th>
                    <th style="font-weight: bold;" rowspan="2">HBO</th>
                    <th style="font-weight: bold;" rowspan="2">BCG</th>
                    <th style="font-weight: bold;" colspan="3">DPT-HB</th>
                    <th style="font-weight: bold;" colspan="4">Polio</th>
                </tr>
                <tr>
                    <?php $nama_bulan = [
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
                    ]; ?>
                    <?php foreach ($nama_bulan as $bln) {
                        echo '<th style="font-weight: bold;">' . $bln . '</th>';
                    }
                    ?>

                    <th style="font-weight: bold;">1 Bln</th>
                    <th style="font-weight: bold;">2 Bln</th>
                    <th style="font-weight: bold;">1 Bln</th>
                    <th style="font-weight: bold;">2 Bln</th>
                    <th style="font-weight: bold;">1</th>
                    <th style="font-weight: bold;">2</th>
                    <th style="font-weight: bold;">3</th>
                    <th style="font-weight: bold;">1</th>
                    <th style="font-weight: bold;">2</th>
                    <th style="font-weight: bold;">3</th>
                    <th style="font-weight: bold;">4</th>

                </tr>
                <tr>
                    @for($i = 0; $i < 35; $i++) <td style="text-align: center;">{{$i + 1}}</td>
                        @endfor
                </tr>
            </thead>
            <tbody>

                @foreach($bayi as $key => $by)
                <tr>
                    <td rowspan="5">{{$key + 1}}</td>
                    <td rowspan="5">{{$by->nama}}</td>
                    <td rowspan="5">{{$by->tanggal_lahir}}</td>
                    <td rowspan="5">{{$by->bb_pb}}</td>
                    <td rowspan="5">Ibu {{$by->nama_ibu}}, Ayah {{$by->nama_ayah}}</td>
                    <td rowspan="5">{{$by->l_p == 1 ? 'L' : 'P'}}</td>
                    <?php
                    $detail_bayi = Detail_Bayi_Timbang::where('bayi_id', $by->id)->orderBy('bulan_ke', 'asc')->get();
                    $obat = Detail_Bayi_Obat::where('bayi_id', $by->id)->first();
                    $sirup_fe = [];
                    $vit_a = [];
                    $oralit = [];
                    if (isset($obat->id)) {
                        $sirup_fe = json_decode($obat->sirup_fe);
                        $vit_a = json_decode($obat->vit_a);
                        $oralit = json_decode($obat->oralit);
                    }

                    //imunisasi
                    $imunisasi = Detail_Bayi_Imun::where('bayi_id', $by->id)->first();
                    $hbo = [];
                    $bcg = [];
                    $dpt_hb = [];
                    $polio = [];
                    if (isset($imunisasi->id)) {
                        $hbo = json_decode($imunisasi->hbo);
                        $bcg = json_decode($imunisasi->bcg);
                        $dpt_hb = json_decode($imunisasi->dpt_hb);
                        $polio = json_decode($imunisasi->polio);
                    }

                    ?>

                    <?php
                    $arr = array_fill(0, 60, 'foo');
                    $arr_chunk = array_chunk($arr, 12);
                    $loop_timbang = 0;
                    foreach ($arr_chunk as $i => $ac) {
                        //looping data perbulan sebanyak 60 dibagi per12
                        foreach ($ac as $ai => $ac_inside) {
                            if (isset($detail_bayi[$loop_timbang]->id)) {
                                $sd_bb_status = '';
                                $sd_pb_status = '';

                                $arr_numeric = [
                                    '-3' => 1,
                                    '-2' => 2,
                                    '-1' => 3,
                                    'median' => 4,
                                    '+1' => 5,
                                    '+2' => 6,
                                    '+3' => 7,
                                ];

                                //berat dan status penimbangan sekarang
                                //berat badan
                                $bb = $detail_bayi[$loop_timbang]->berat_badan;
                                $sd_bb_status = $arr_numeric[$detail_bayi[$loop_timbang]->sd_bb];
                                $status_bb = '';
                                //tinggi badan
                                $pb = $detail_bayi[$loop_timbang]->tinggi_badan;
                                $sd_pb_status = $arr_numeric[$detail_bayi[$loop_timbang]->sd_pb];
                                $status_pb = '';
                                //jika ada data timbang sebelumnya
                                if (isset($detail_bayi[$loop_timbang - 1]->id)) {
                                    //berat badan
                                    $bb_sebelumnya = $detail_bayi[$loop_timbang - 1]->berat_badan;
                                    $sd_bb_sebelumnya = $arr_numeric[$detail_bayi[$loop_timbang - 1]->sd_bb];

                                    //jika berat badan naik
                                    if ($bb > $bb_sebelumnya) {
                                        //jika standar deviasinya menurun
                                        if ($sd_bb_status < $sd_bb_sebelumnya) {
                                            $status_bb = 'T1';
                                        } else {
                                            $status_bb = 'N';
                                        }
                                    }
                                    //jika berat badan sama
                                    if ($bb == $bb_sebelumnya) {
                                        $status_bb = 'T2';
                                    }
                                    //jika berat badan menurun
                                    if ($bb < $bb_sebelumnya) {
                                        $status_bb = 'T3';
                                    }


                                    //tinggi badan
                                    $pb_sebelumnya = $detail_bayi[$loop_timbang - 1]->tinggi_badan;
                                    $sd_pb_sebelumnya = $arr_numeric[$detail_bayi[$loop_timbang - 1]->sd_pb];

                                    //jika tinggi badan naik
                                    if ($pb > $pb_sebelumnya) {
                                        //jika standar deviasinya menurun
                                        if ($sd_pb_status < $sd_pb_sebelumnya) {
                                            $status_pb = 'T1';
                                        } else {
                                            $status_pb = 'N';
                                        }
                                    }
                                    //jika tinggi badan sama
                                    if ($pb == $pb_sebelumnya) {
                                        $status_pb = 'T2';
                                    }
                                    //jika tinggi badan menurun
                                    if ($pb < $pb_sebelumnya) {
                                        $status_pb = 'T3';
                                    }
                                }

                                $sd_bb = 'green';
                                $sd_pb = 'green';
                                if ($detail_bayi[$loop_timbang]->sd_bb == '-3') {
                                    $sd_bb = 'red';
                                }
                                if ($detail_bayi[$loop_timbang]->sd_pb == '-3') {
                                    $sd_pb = 'red';
                                }

                                echo '<td><span style="color:' . $sd_bb . '; font-weight:bold;">' . $detail_bayi[$loop_timbang]->berat_badan . 'kg</span>/<span style="color:' . $sd_pb . '; font-weight:bold;">' . $detail_bayi[$loop_timbang]->tinggi_badan . 'cm</span><br/>' . $status_bb . '/' . $status_pb . '</td>';
                            } else {
                                echo '<td></td>';
                            }
                            $loop_timbang += 1;
                        }
                        //jika firstline maka tambahkan column yang lain 
                        //bayi obat
                        //sirup fe
                        if (isset($sirup_fe[$i]->bulan_ke_1)) {
                            echo '<td>' . $sirup_fe[$i]->bulan_ke_1 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($sirup_fe[$i]->bulan_ke_2)) {
                            echo '<td>' . $sirup_fe[$i]->bulan_ke_2 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        //vit_a
                        if (isset($vit_a[$i]->bulan_ke_1)) {
                            echo '<td>' . $vit_a[$i]->bulan_ke_1 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($vit_a[$i]->bulan_ke_2)) {
                            echo '<td>' . $vit_a[$i]->bulan_ke_2 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        //oralit
                        if (isset($oralit[$i]->tanggal)) {
                            echo '<td>' . $oralit[$i]->tanggal . '</td>';
                        } else {
                            echo '<td></td>';
                        }

                        //imunisasi
                        //hbo
                        if (isset($hbo[$i]->tanggal)) {
                            echo '<td>' . $hbo[$i]->tanggal . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        //bcg
                        if (isset($bcg[$i]->tanggal)) {
                            echo '<td>' . $bcg[$i]->tanggal . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        //dpt_hb
                        if (isset($dpt_hb[$i]->bulan_ke_1)) {
                            echo '<td>' . $dpt_hb[$i]->bulan_ke_1 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($dpt_hb[$i]->bulan_ke_2)) {
                            echo '<td>' . $dpt_hb[$i]->bulan_ke_2 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($dpt_hb[$i]->bulan_ke_3)) {
                            echo '<td>' . $dpt_hb[$i]->bulan_ke_3 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        //polio
                        if (isset($polio[$i]->bulan_ke_1)) {
                            echo '<td>' . $polio[$i]->bulan_ke_1 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($polio[$i]->bulan_ke_2)) {
                            echo '<td>' . $polio[$i]->bulan_ke_2 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($polio[$i]->bulan_ke_4)) {
                            echo '<td>' . $polio[$i]->bulan_ke_4 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($polio[$i]->bulan_ke_3)) {
                            echo '<td>' . $polio[$i]->bulan_ke_3 . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if ($i == 0) {
                            echo '<td rowspan="5">' . $by->campak . '</td>';
                            echo '<td rowspan="5">' . $by->meninggal . '</td>';
                            echo '<td rowspan="5">' . $by->keterangan . '</td>';
                        }
                        //jika datanya sudah 5 row, jangan tambahkan tr
                        if ($i != (count($arr_chunk) - 1)) {
                            echo '</tr><tr>';
                        }
                    }
                    ?>

                </tr>
                <tr>
                    <th colspan="6" rowspan="2"></th>
                    <th colspan="12">Bulan</th>
                    <th colspan="17" rowspan="2"></th>
                </tr>
                <tr>
                    <?php foreach ($nama_bulan as $bln) {
                        echo '<th style="font-weight: bold;">' . $bln . '</th>';
                    }
                    ?>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
    window.print()
</script>