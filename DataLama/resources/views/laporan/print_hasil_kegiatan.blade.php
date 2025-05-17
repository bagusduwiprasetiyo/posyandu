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
            <h3>DATA HASIL KEGIATAN POSYANDU</h3>
        </center>
        <br>
        <?php
        $nama_posyandu = DB::table('list_posyandu')->where('id', $id_posyandu)->first();
        ?>

        <p style="font-size: 9pt;">Nama Posyandu : {{$id_posyandu == 0? 'Semua Posyandu': $nama_posyandu->nama}}</p>
        <p style="font-size: 9pt;">Tahun : {{$tahun}}</p>
        <br>
        <table style="font-size: 8pt; text-align: center; width: 100%; table-layout: fixed" border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr>
                    <th rowspan="3">NO</th>
                    <th rowspan="3" style="width: 50px;">BULAN</th>
                    <th rowspan="3">
                        <div style="transform: rotate(270deg); margin-top: 50px;">JML&#160IBU&#160HAMIL</div>
                    </th>
                    <th rowspan="3">
                        <div style="transform: rotate(270deg); height: 100%; margin-top: 50px">DIPERIKSA</div>
                    </th>
                    <th rowspan="3">
                        <div style="transform: rotate(270deg); height: 100%;">FE&#160TAB</div>
                    </th>
                    <th rowspan=" 3">
                        <div style="transform: rotate(270deg); height: 100%; margin-top: 70px">JML&#160IBU&#160MENYUSUI</div>
                    </th>
                    <th rowspan="2" colspan="2" style="width: 50px;">
                        IMUNISASI
                        <br>
                        TT IBU
                        <br>
                        HAMIL
                    </th>
                    <th colspan="8">
                        JML ASEPTOR KB
                    </th>
                    <th colspan="12">
                        PENIMBANGAN BALITA
                    </th>
                    <th colspan="10">
                        JUMLAH BAYI YANG DIIMUNISASI
                    </th>
                    <th colspan="4">
                        BAYI YANG
                        <br>
                        MENDERITA DIARE
                    </th>
                    <th rowspan="3" style="width: 40px;">
                        <div style="transform: rotate(270deg); height: 100%; padding: 0; margin-top: 50px;">
                            KETERANGAN
                        </div>
                    </th>
                </tr>
                <tr>

                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">KONDOM</div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">PIL</div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">IMPLANT</div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">MOP</div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">MOW</div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">UID</div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">SUNTIK</div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); margin-top: 50px;">LAIN-LAIN</div>
                    </th>
                    <th colspan="2">
                        JML
                        <br>
                        BALITA
                        <br>
                        (S)
                    </th>
                    <th colspan="2">
                        JML
                        <br>
                        BALITA
                        KMS (K)
                    </th>
                    <th colspan="2">
                        DI
                        TIMBANG
                        <br>
                        (D)
                    </th>
                    <th colspan="2">
                        JML YG
                        <br>
                        NAIK (N)
                    </th>
                    <th colspan="2">
                        JML DAPAT
                        <br>
                        VIT A
                    </th>
                    <th colspan="2">

                        JML DAPAT
                        <br>
                        PMT
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); height: 100%; padding: 0; margin: 0;">
                            HB0
                        </div>
                    </th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); height: 100%; padding: 0; margin: 0;">
                            BCG
                        </div>
                    </th>
                    <th colspan="3">DPT</th>
                    <th colspan="4">POLIO</th>
                    <th rowspan="2">
                        <div style="transform: rotate(270deg); height: 100%; padding: 0; margin: 0;">CAMPAK</div>
                    </th>
                    <th colspan="2">JUMLAH</th>
                    <th colspan="2">
                        DAPAT
                        <br>
                        ORALIT
                    </th>
                </tr>
                <tr>
                    <th>I</th>
                    <th>II</th>
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
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>I</th>
                    <th>II</th>
                    <th>III</th>
                    <th>IV</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_laporan as $key => $lp)
                <tr>
                    <td style="height: 10px;">{{$key + 1}}</td>
                    <td style="height: 10px;">{{$nama_bulan[$key]}}</td>
                    <td style="height: 10px;">{{$lp['jml_bumil']}}</td>
                    <td style="height: 10px;">{{$lp['bumil_timbang']}}</td>
                    <td style="height: 10px;">{{$lp['bumil_td']}}</td>
                    <td style="height: 10px;">{{$lp['bumil_menyusui']}}</td>
                    <td style="height: 10px;">{{$lp['bumil_tt_1']}}</td>
                    <td style="height: 10px;">{{$lp['bumil_tt_2']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['Kondom']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['Pil']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['Implant']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['MOP']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['MOW']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['UID']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['Suntik']}}</td>
                    <td style="height: 10px;">{{$lp['alkon']['Lain-lain']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_s']['l']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_s']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_k']['l']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_k']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_timbang']['l']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_timbang']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_naik']['l']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_naik']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_vit_a']['l']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_vit_a']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_pmt']['l']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_pmt']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_imun']['hbo']['l']}}/{{$lp['bayi_imun']['hbo']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_imun']['bcg']['l']}}/{{$lp['bayi_imun']['bcg']['p']}}</td>

                    <td style="height: 10px;">{{$lp['bayi_imun']['dpt']['i']['l']}}/{{$lp['bayi_imun']['dpt']['i']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_imun']['dpt']['ii']['l']}}/{{$lp['bayi_imun']['dpt']['ii']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_imun']['dpt']['iii']['l']}}/{{$lp['bayi_imun']['dpt']['iii']['p']}}</td>

                    <td style="height: 10px;">{{$lp['bayi_imun']['polio']['i']['l']}}/{{$lp['bayi_imun']['polio']['i']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_imun']['polio']['ii']['l']}}/{{$lp['bayi_imun']['polio']['ii']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_imun']['polio']['iii']['l']}}/{{$lp['bayi_imun']['polio']['iii']['p']}}</td>
                    <td style="height: 10px;">{{$lp['bayi_imun']['polio']['iiii']['l']}}/{{$lp['bayi_imun']['polio']['iiii']['p']}}</td>

                    <td style="height: 10px;">{{$lp['campak']}}</td>
                    <td style="height: 10px;">{{$lp['diare']['l']}}</td>
                    <td style="height: 10px;">{{$lp['diare']['p']}}</td>
                    <td style="height: 10px;">{{$lp['oralit']['l']}}</td>
                    <td style="height: 10px;">{{$lp['oralit']['p']}}</td>
                    <td style="height: 10px;" style="height: 50px; font-size: 7pt; max-height: 50px;">
                        {{$lp['keterangan']}}
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