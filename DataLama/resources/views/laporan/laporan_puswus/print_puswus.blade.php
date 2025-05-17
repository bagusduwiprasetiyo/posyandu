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
            <h3>REGISTER PUSWUS DALAM WILAYAH KERJA POSYANDU <br /> JANUARI S/D DESEMBER {{$tahun}}</h3>

        </center>
        <br>
        <?php



        $nama_posyandu = DB::table('list_posyandu')->where('id', $id_posyandu)->first();
        ?>

        <p style="font-size: 9pt;">Nama Posyandu : {{$id_posyandu == 0? 'Semua Posyandu': $nama_posyandu->nama}}</p>
        <!-- <p style="font-size: 9pt;">Tahun : {{$tahun}}</p> -->
        <br>
        <table style="font-size: 8pt; text-align: center;" border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="3">NO</th>
                    <th rowspan="3">NAMA WUS</th>
                    <th rowspan="3">UMUR</th>
                    <th rowspan="3">NAMA SUAMI</th>
                    <th rowspan="3">TAHAPAN KS</th>
                    <th rowspan="3">KLP DASA WISMA</th>
                    <th colspan="2">JUMLAH ANAK</th>
                    <th rowspan="3">PENGUKURAN LILA < 25,5 CM</th> <th colspan="6">PEMBERIAN</th>
                    <th colspan="3">KELUARGA BERENCANA</th>
                    <th rowspan="3" style="width: 10%;">KETERANGAN</th>
                </tr>
                <tr>
                    <th rowspan="2">YANG HIDUP</th>
                    <th rowspan="2">YANG MENINGGAL</th>
                    <th rowspan="2">KAPSUL YODIUM BULANAN</th>
                    <th colspan="5">IMUNISASI TT</th>
                    <th rowspan="2">JENIS ALKON YANG DIPAKAI</th>
                    <th colspan="2">PERGANTIAN</th>
                </tr>
                <tr>
                    <th>T1</th>
                    <th>T2</th>
                    <th>T3</th>
                    <th>T4</th>
                    <th>T5</th>
                    <th>TGL/BLN</th>
                    <th>JENIS KONTRASEPSI</th>
                </tr>

            </thead>
            <tbody>
                @foreach($laporan as $key => $lp)
                <tr>
                    <td style="">{{$key + 1}}</td>
                    <td style="">{{$lp->nama_wuspus}}</td>
                    <td style="">{{$lp->tgl_lahir_wuspus}}</td>
                    <td style="">{{$lp->nama_suami}} {{$lp->tgl_lahir_suami}}</td>
                    <td style="">{{$lp->tahapan_ks}}</td>
                    <td style="">{{$lp->klp_dasa_wisma}}</td>
                    <td style="">{{$lp->jml_anak_hidup}}</td>
                    <td style="">{{$lp->jml_anak_meninggal}}</td>
                    <td style="">{{$lp->ukuran_lila}}</td>
                    <td style="">

                        @if(isset($lp->imunisasi->kapsul_yodium))

                        @foreach($lp->imunisasi->kapsul_yodium as $ky)
                        {{$ky[1]}}<br>
                        @endforeach

                        @endif

                    </td>
                    <td style="">
                        @if(isset($lp->key_imunisasi[0]))
                        <?php
                        $var = $lp->key_imunisasi[0];
                        ?>
                        {{$lp->imunisasi->imunisasi_tt->$var[1]}}
                        @endif
                    </td>
                    <td style="">
                        @if(isset($lp->key_imunisasi[1]))
                        <?php
                        $var = $lp->key_imunisasi[1];
                        ?>
                        {{$lp->imunisasi->imunisasi_tt->$var[1]}}
                        @endif
                    </td>
                    <td style="">
                        @if(isset($lp->key_imunisasi[2]))
                        <?php
                        $var = $lp->key_imunisasi[2];
                        ?>
                        {{$lp->imunisasi->imunisasi_tt->$var[1]}}
                        @endif
                    </td>
                    <td style="">
                        @if(isset($lp->key_imunisasi[3]))
                        <?php
                        $var = $lp->key_imunisasi[3];
                        ?>
                        {{$lp->imunisasi->imunisasi_tt->$var[1]}}
                        @endif
                    </td>
                    <td style="">
                        @if(isset($lp->key_imunisasi[4]))
                        <?php
                        $var = $lp->key_imunisasi[4];
                        ?>
                        {{$lp->imunisasi->imunisasi_tt->$var[1]}}
                        @endif
                    </td>
                    <td style="">

                        @if(isset($lp->kb->alkon))

                        @foreach($lp->kb->alkon as $ky)
                        {{$ky[0]}}<br>
                        @endforeach

                        @endif

                    </td>

                    <td style="">
                        @if(isset($lp->kb->pergantian_alkon))

                        @foreach($lp->kb->pergantian_alkon as $ky)
                        {{$ky[1]}}<br>
                        @endforeach

                        @endif
                    </td>
                    <td style="">
                        @if(isset($lp->kb->pergantian_alkon))

                        @foreach($lp->kb->pergantian_alkon as $ky)
                        {{$ky[0]}}<br>
                        @endforeach

                        @endif
                    </td>

                    <td style="height: 50px; font-size: 7pt; max-height: 50px;">
                        {{$lp->keterangan}}
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
    window.print()
</script>