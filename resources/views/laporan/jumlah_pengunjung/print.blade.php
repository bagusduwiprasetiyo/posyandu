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
                table-layout: fixed
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
            <h3>JUMLAH PENGUNJUNG / JUMLAH PETUGAS POSYANDU<br />
                JUMLAH BAYI LAHIR / MENINGGAL
            </h3>
        </center>
        <br>
        <?php
        $nama_posyandu = DB::table('list_posyandu')->where('id', $id_posyandu)->first();
        ?>

        <p style="font-size: 9pt;">Nama Posyandu : {{$id_posyandu == 0? 'Semua Posyandu': $nama_posyandu->nama}}</p>
        <p style="font-size: 9pt;">Tahun : {{$tahun}}</p>
        <br>
        <table style="font-size: 8pt; text-align: center;; width: 100%; height: 100%;" border="1" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="5">NO</th>
                    <th rowspan="5">BULAN</th>
                    <th colspan="12">JUMLAH PENGUNJUNG</th>
                    <th colspan="6">JUMLAH PETUGAS YANG HADIR</th>
                    <th colspan="4">JUMLAH BAYI</th>
                    <th rowspan="5">KETERANGAN</th>
                </tr>
                <tr>
                    <th colspan="8">BALITA</th>
                    <th rowspan="4">WUS</th>
                    <th colspan="3">IBU</th>
                    <th colspan="2" rowspan="3">KADER</th>
                    <th colspan="2" rowspan="3">PLKB</th>
                    <th colspan="2" rowspan="3">MEDIS DAN PARAMEDIS</th>
                    <th colspan="2" rowspan="3">YANG LAHIR</th>
                    <th colspan="2" rowspan="3">YANG MENINGGAL</th>
                </tr>

                <tr>
                    <th colspan="4">0-12 BLN</th>
                    <th colspan="4">1-5 TH</th>
                    <th rowspan="3">PUS</th>
                    <th rowspan="3">HAMIL</th>
                    <th rowspan="3">MENYUSUI</th>

                </tr>
                <tr>
                    <th colspan="2">BARU</th>
                    <th colspan="2">LAMA</th>
                    <th colspan="2">BARU</th>
                    <th colspan="2">LAMA</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $key => $lp)
                <tr>
                    <td style="width: 15px; height: 20px;">{{$key + 1}}</td>
                    <td style="width: 15px; height: 20px;">{{$nama_bulan[$key]}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_baru'])?$lp['bayi_baru']['l']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_baru'])?$lp['bayi_baru']['p']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_lama'])?$lp['bayi_lama']['l']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_lama'])?$lp['bayi_lama']['p']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['balita_baru'])?$lp['balita_baru']['l']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['balita_baru'])?$lp['balita_baru']['p']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['balita_lama'])?$lp['balita_lama']['l']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['balita_lama'])?$lp['balita_lama']['p']:0}}</td>

                    <td style="width: 15px; height: 20px;">{{isset($lp['wus'])?$lp['wus']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['pus'])?$lp['pus']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bumil'])?$lp['bumil']:0}}</td>
                    <td style="width: 20px; height: 20px;">{{isset($lp['menyusui'])?$lp['menyusui']:0}}</td>
                    <td style="width: 50px; height: 20px;">
                        {{isset($lp['kader']['l'][$key])? $lp['kader']['l'][$key] : 0}}
                    </td>
                    <td style="width: 15px; height: 20px;">
                        {{isset($lp['kader']['p'][$key])? $lp['kader']['p'][$key] : 0}}
                    </td>
                    <td style="width: 15px; height: 20px;">
                        {{isset($lp['plkb']['l'][$key])? $lp['plkb']['l'][$key] : 0}}
                    </td>
                    <td style="width: 15px; height: 20px;">
                        {{isset($lp['plkb']['p'][$key])? $lp['plkb']['p'][$key] : 0}}
                    </td>
                    <td style="width: 15px; height: 20px;">
                        {{isset($lp['medis']['l'][$key])? $lp['medis']['l'][$key] : 0}}
                    </td>
                    <td style="width: 15px; height: 20px;">
                        {{isset($lp['medis']['p'][$key])? $lp['medis']['p'][$key] : 0}}
                    </td>

                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_lahir'])?$lp['bayi_lahir']['l']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_lahir'])?$lp['bayi_lahir']['p']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_meninggal'])?$lp['bayi_meninggal']['l']:0}}</td>
                    <td style="width: 15px; height: 20px;">{{isset($lp['bayi_meninggal'])?$lp['bayi_meninggal']['p']:0}}</td>
                    <?php
                    $ket = $nama_bulan[$key];
                    ?>
                    <td style="width: 30px; font-size: 7pt; max-height: 50px;">
                        {{isset($lp['keterangan']->$ket)?$lp['keterangan']->$ket:''}}
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