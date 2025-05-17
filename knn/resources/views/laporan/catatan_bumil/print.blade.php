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
            <h3>
                CATATAN IBU HAMIL, KELAHIRAN, KEMATIAN BAYI, <br>
                DAN KEMATIAN IBU HAMIL, MELAHIRKAN/NIFAS
            </h3>
        </center>
        <br>
        <?php
        $nama_posyandu = DB::table('list_posyandu')->where('id', $id_posyandu)->first();
        ?>

        <p style="font-size: 9pt;">Nama Posyandu : {{$id_posyandu == 0? 'Semua Posyandu': $nama_posyandu->nama}}</p>
        <p style="font-size: 9pt;">Tahun : {{$tahun}}</p>
        <br>
        <table style="font-size: 10pt; text-align: center;" border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th colspan="2">NAMA</th>
                    <th rowspan="2">NAMA BAYI</th>
                    <th rowspan="2">TANGGAL LAHIR</th>
                    <th colspan="2">TANGGAL MENINGGAL</th>
                    <th rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th>IBU</th>
                    <th>BAPAK</th>
                    <th>BAYI</th>
                    <th>IBU</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $key => $lp)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$lp->nama_ibu}}</td>
                    <td>{{$lp->nama_suami}}</td>
                    <td>{{$lp->nama_bayi}}</td>
                    <td>{{$lp->tanggal_persalinan}}</td>
                    <td>{{$lp->bayi_meninggal}}</td>
                    <td>{{$lp->ibu_meninggal}}</td>
                    <td>
                        <?php
                        $id = $lp->id;
                        ?>{{isset($keterangan->$id)?$keterangan->$id:''}}
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