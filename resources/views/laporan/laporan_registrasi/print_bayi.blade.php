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
        @php
        $namaBulan = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
        $teksTahun = ($tahun == 0) ? 'Semua Tahun' : $tahun;
        $teksBulan = '';
        if (isset($bulan_dari) && isset($bulan_sampai) && $bulan_dari != 0 && $bulan_sampai != 0) {
            $teksBulan = ' | Periode Bulan: ' . ($namaBulan[(int)$bulan_dari] ?? $bulan_dari) . ' s/d ' . ($namaBulan[(int)$bulan_sampai] ?? $bulan_sampai);
        }
        @endphp
        <p style="font-size: 9pt;">Tahun : {{$teksTahun}}{{$teksBulan}}</p>
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
                    <td style="text-align: center;">{{$key + 1}}</td>
                    <td style="text-align: center;">{{$by->nama}}</td>
                    <td style="text-align: center;">{{$by->tanggal_lahir}}</td>
                    <td style="text-align: center;">{{$by->bb_pb}}</td>
                    <td style="text-align: center;">Ibu {{$by->nama_ibu}}, Ayah {{$by->nama_ayah}}</td>
                    <td style="text-align: center;">{{$by->l_p == 1 ? 'L' : 'P'}}</td>
                    <?php
                    $detail_bayi = Detail_Bayi_Timbang::where('bayi_id', $by->id)->orderBy('bulan_ke', 'asc')->get();
                    $obat = Detail_Bayi_Obat::where('bayi_id', $by->id)->first();
                    $sirup_fe = [];
                    $vit_a = [];
                    $oralit = [];
                    if (isset($obat->id)) {
                        $sirup_fe = json_decode($obat->sirup_fe);
                        $vit_a    = json_decode($obat->vit_a);
                        $oralit   = json_decode($obat->oralit);
                    }

                    $imunisasi = Detail_Bayi_Imun::where('bayi_id', $by->id)->first();
                    $hbo = []; $bcg = []; $dpt_hb = []; $polio = [];
                    if (isset($imunisasi->id)) {
                        $hbo    = json_decode($imunisasi->hbo);
                        $bcg    = json_decode($imunisasi->bcg);
                        $dpt_hb = json_decode($imunisasi->dpt_hb);
                        $polio  = json_decode($imunisasi->polio);
                    }

                    // Index timbang per bulan kalender (1-12) dari kolom tanggal
                    $timbangPerBulan = [];
                    foreach ($detail_bayi as $dt) {
                        $bulanNum = (int) date('n', strtotime($dt->tanggal));
                        $timbangPerBulan[$bulanNum] = $dt;
                    }

                    $arr_numeric = ['-3'=>1,'-2'=>2,'-1'=>3,'median'=>4,'+1'=>5,'+2'=>6,'+3'=>7];
                    $prev_timbang = null;

                    for ($bulanNum = 1; $bulanNum <= 12; $bulanNum++) {
                        if (isset($timbangPerBulan[$bulanNum])) {
                            $t = $timbangPerBulan[$bulanNum];
                            $sd_bb_status = $arr_numeric[$t->sd_bb] ?? 4;
                            $sd_pb_status = $arr_numeric[$t->sd_pb] ?? 4;
                            $status_bb = ''; $status_pb = '';
                            if ($prev_timbang !== null) {
                                $bb = (float)$t->berat_badan; $bb_sblm = (float)$prev_timbang->berat_badan;
                                $sd_bb_sblm = $arr_numeric[$prev_timbang->sd_bb] ?? 4;
                                if ($bb > $bb_sblm) $status_bb = ($sd_bb_status < $sd_bb_sblm) ? 'T1' : 'N';
                                elseif ($bb == $bb_sblm) $status_bb = 'T2'; else $status_bb = 'T3';
                                $pb = (float)$t->tinggi_badan; $pb_sblm = (float)$prev_timbang->tinggi_badan;
                                $sd_pb_sblm = $arr_numeric[$prev_timbang->sd_pb] ?? 4;
                                if ($pb > $pb_sblm) $status_pb = ($sd_pb_status < $sd_pb_sblm) ? 'T1' : 'N';
                                elseif ($pb == $pb_sblm) $status_pb = 'T2'; else $status_pb = 'T3';
                            }
                            $col_bb = ($t->sd_bb == '-3') ? 'red' : 'green';
                            $col_pb = ($t->sd_pb == '-3') ? 'red' : 'green';
                            echo '<td><span style="color:' . $col_bb . '; font-weight:bold;">' . $t->berat_badan . 'kg</span>/<span style="color:' . $col_pb . '; font-weight:bold;">' . $t->tinggi_badan . 'cm</span><br/>' . $status_bb . '/' . $status_pb . '</td>';
                            $prev_timbang = $t;
                        } else {
                            echo '<td></td>';
                        }
                    }

                    $i = 0;
                    // Sirup FE
                    echo isset($sirup_fe[$i]->bulan_ke_1) ? '<td>' . $sirup_fe[$i]->bulan_ke_1 . '</td>' : '<td></td>';
                    echo isset($sirup_fe[$i]->bulan_ke_2) ? '<td>' . $sirup_fe[$i]->bulan_ke_2 . '</td>' : '<td></td>';
                    // Vit A
                    echo isset($vit_a[$i]->bulan_ke_1) ? '<td>' . $vit_a[$i]->bulan_ke_1 . '</td>' : '<td></td>';
                    echo isset($vit_a[$i]->bulan_ke_2) ? '<td>' . $vit_a[$i]->bulan_ke_2 . '</td>' : '<td></td>';
                    // Oralit
                    echo isset($oralit[$i]->tanggal) ? '<td>' . $oralit[$i]->tanggal . '</td>' : '<td></td>';
                    // HBO
                    echo isset($hbo[$i]->tanggal) ? '<td>' . $hbo[$i]->tanggal . '</td>' : '<td></td>';
                    // BCG
                    echo isset($bcg[$i]->tanggal) ? '<td>' . $bcg[$i]->tanggal . '</td>' : '<td></td>';
                    // DPT-HB
                    echo isset($dpt_hb[$i]->bulan_ke_1) ? '<td>' . $dpt_hb[$i]->bulan_ke_1 . '</td>' : '<td></td>';
                    echo isset($dpt_hb[$i]->bulan_ke_2) ? '<td>' . $dpt_hb[$i]->bulan_ke_2 . '</td>' : '<td></td>';
                    echo isset($dpt_hb[$i]->bulan_ke_3) ? '<td>' . $dpt_hb[$i]->bulan_ke_3 . '</td>' : '<td></td>';
                    // Polio
                    echo isset($polio[$i]->bulan_ke_1) ? '<td>' . $polio[$i]->bulan_ke_1 . '</td>' : '<td></td>';
                    echo isset($polio[$i]->bulan_ke_2) ? '<td>' . $polio[$i]->bulan_ke_2 . '</td>' : '<td></td>';
                    echo isset($polio[$i]->bulan_ke_3) ? '<td>' . $polio[$i]->bulan_ke_3 . '</td>' : '<td></td>';
                    echo isset($polio[$i]->bulan_ke_4) ? '<td>' . $polio[$i]->bulan_ke_4 . '</td>' : '<td></td>';
                    // Campak, Meninggal, Keterangan
                    echo '<td>' . ($by->campak ?? '') . '</td>';
                    echo '<td>' . ($by->meninggal ?? '') . '</td>';
                    echo '<td>' . ($by->keterangan ?? '') . '</td>';
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
</html>
