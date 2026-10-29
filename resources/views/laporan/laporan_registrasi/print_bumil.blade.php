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
            <h3>DATA REGISTASI IBU HAMIL</h3>
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
                    <th style="font-weight: bold;" rowspan="3">Nama Ibu dan Suami</th>
                    <th style="font-weight: bold;" rowspan="3">Umur</th>
                    <th style="font-weight: bold;" rowspan="3" class="rotate">KLP Dasa Wisma</th>
                    <th style="font-weight: bold;" rowspan="2" colspan="2">Pendaftaran</th>
                    <th style="font-weight: bold;" rowspan="3" class="rotate">Hamil-ke</th>
                    <th style="font-weight: bold;" rowspan="3" class="rotate">Lila</th>
                    <th style="font-weight: bold;" rowspan="2" colspan="3">Tablet Tambah Darah</th>
                    <th style="font-weight: bold;" rowspan="2" colspan="5">Imunisasi TT</th>
                    <th style="font-weight: bold;" rowspan="3" style="width: 5px;" class="rotate">Kapsul Yodium</th>
                    <th style="font-weight: bold;" rowspan="1" colspan="12">
                        <center>Hasil Penimbangan</center>
                    </th>
                    <th style="font-weight: bold;" rowspan="3">Resiko</th>
                    <th style="font-weight: bold;" rowspan="1" colspan="3">Persalinan</th>
                    <th style="font-weight: bold;" rowspan="1" colspan="5">Bayi</th>
                    <th style="font-weight: bold;" rowspan="3">Ibu Meninggal </th>
                    <th style="font-weight: bold;" rowspan="3">Keterangan</th>
                </tr>
                <tr>
                    <th style="font-weight: bold;" colspan="12">
                        <center>Bulan</center>
                    </th>
                    <th style="font-weight: bold;" rowspan="2">Tanggal</th>
                    <th style="font-weight: bold;" colspan="2">Ditolong oleh</th>
                    <th style="font-weight: bold;" colspan="4">Hidup</th>
                    <th style="font-weight: bold;" rowspan="2">Meninggal</th>
                </tr>

                <tr>
                    <th style="font-weight: bold;">Tanggal</th>
                    <th style="font-weight: bold;">Usia Kehamilan</th>

                    <th style="font-weight: bold;">1</th>
                    <th style="font-weight: bold;">2</th>
                    <th style="font-weight: bold;">3</th>
                    <th style="font-weight: bold;">1</th>
                    <th style="font-weight: bold;">2</th>
                    <th style="font-weight: bold;">3</th>
                    <th style="font-weight: bold;">4</th>
                    <th style="font-weight: bold;">5</th>
                    <th style="font-weight: bold;" class="rotate">Januari</th>
                    <th style="font-weight: bold;" class="rotate">Februari</th>
                    <th style="font-weight: bold;" class="rotate">Maret</th>
                    <th style="font-weight: bold;" class="rotate">April</th>
                    <th style="font-weight: bold;" class="rotate">Mei</th>
                    <th style="font-weight: bold;" class="rotate">Juni</th>
                    <th style="font-weight: bold;" class="rotate">Juli</th>
                    <th style="font-weight: bold;" class="rotate">Agustus</th>
                    <th style="font-weight: bold;" class="rotate">September</th>
                    <th style="font-weight: bold;" class="rotate">Oktober</th>
                    <th style="font-weight: bold;" class="rotate">November</th>
                    <th style="font-weight: bold;" class="rotate">Desember</th>

                    <th style="font-weight: bold;">Nakes</th>
                    <th style="font-weight: bold;">Dukun</th>
                    @php $sym = '< 2000 gr'; @endphp
                    <th style="font-weight: bold;">{{$sym}}</th>
                    <th style="font-weight: bold;">2000-2500 gr</th>
                    <th style="font-weight: bold;">Normal</th>
                    <th style="font-weight: bold;"> >4000 gr</th>
                </tr>
                <tr>
                    @for($i = 0; $i < 40; $i++) <td style="text-align: center;">{{$i + 1}}</td>
                        @endfor
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($bumils as $bumil)

                <tr>
                    <td style="text-align: center;">{{ $i++ }}</td>
                    <td style="text-align: center;">Ibu {{$bumil->nama_ibu}} dan {{$bumil->nama_suami}}</td>
                    <td style="text-align: center;">{{$bumil->umur}}</td>
                    <td style="text-align: center;">{{$bumil->klp_dasa_wisma}}</td>
                    <td style="text-align: center;">{{$bumil->tanggal}}</td>
                    <td style="text-align: center;">{{$bumil->umur_kelahiran}} mg</td>
                    <td style="text-align: center;">{{$bumil->hamil_ke}}</td>
                    @if((float) $bumil->lila < 23.5)
                    <td style="text-align: center;">{{$bumil->lila}} cm <div style="background-color: red; border-radius: 50%; height: 5px; width: 5px; display: inline-block;"></div>
                    </td>
                    @else
                    <td style="text-align: center;">{{$bumil->lila}} cm <div style="background-color: green; border-radius: 50%; height: 5px; width: 5px; display: inline-block;"></div>
                    @endif

                    <!-- tablet tt -->
                    @php
                    $tablet_tt = DB::select(DB::raw("select * from detail_bumils_tablet_tambah_darah where bumils_id = ".$bumil->id));
                    @endphp
                    @for($t = 0; $t < 3; $t++)
                    <td style="text-align: center;">{{ isset($tablet_tt[$t]) ? $tablet_tt[$t]->tanggal : '' }}</td>
                    @endfor

                    <!-- imunisasi tt -->
                    @php
                    $imun_tt = DB::select(DB::raw("select * from detail_bumils_imunisasi_tt where bumils_id = ".$bumil->id));
                    @endphp
                    @for($t = 0; $t < 5; $t++)
                    <td style="text-align: center;">{{ isset($imun_tt[$t]) ? $imun_tt[$t]->tanggal : '' }}</td>
                    @endfor

                    @if($bumil->kapsul_yodium != '')
                    <td style="text-align: center; width: 5px;">
                        <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div>
                    </td>
                    @else
                    <td style="text-align: center; width: 5px;"></td>
                    @endif

                    @php
                    $timbangRaw = DB::select(DB::raw("select * from detail_bumils_hasil_penimbangan where bumils_id = ".$bumil->id));
                    $timbangPerBulan = [];
                    foreach ($timbangRaw as $tw) {
                        $bulanT = (int) date('n', strtotime($tw->tanggal));
                        $timbangPerBulan[$bulanT] = $tw;
                    }
                    @endphp
                    @for($bulan = 1; $bulan <= 12; $bulan++)
                    @if(isset($timbangPerBulan[$bulan]))
                    <td style="text-align: center;">
                        <div>
                            {{$timbangPerBulan[$bulan]->berat_badan}} kg
                            <br>
                            {{$timbangPerBulan[$bulan]->tekanan_darah}} mmHg
                        </div>
                    </td>
                    @else
                    <td style="text-align: center;"></td>
                    @endif
                    @endfor

                    <td style="text-align: center;">{{$bumil->resiko}}</td>
                    <td style="text-align: center;">{{$bumil->tanggal_persalinan}}</td>
                    @if($bumil->persalinan != '')
                    @if($bumil->persalinan == 1)
                    <td style="text-align: center;">
                        <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg;">✔</div>
                    </td>
                    <td style="text-align: center;"></td>
                    @else
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;">
                        <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div>
                    </td>
                    @endif
                    @else
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    @endif

                    @if($bumil->bayi != '')
                    @if($bumil->bayi == 1)
                    <td style="text-align: center;"><div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    @endif
                    @if($bumil->bayi == 2)
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"><div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    @endif
                    @if($bumil->bayi == 3)
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"><div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div></td>
                    <td style="text-align: center;"></td>
                    @endif
                    @if($bumil->bayi == 4)
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"><div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div></td>
                    @endif
                    @else
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    @endif

                    <td style="text-align: center;">{{$bumil->bayi_meninggal}}</td>
                    <td style="text-align: center;">{{$bumil->ibu_meninggal}}</td>
                    <td style="text-align: center;">{{$bumil->keterangan}}</td>
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
