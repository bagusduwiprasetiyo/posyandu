<html>

<head>
    <title>Laporan Posyandu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 8pt;

        }

        .rotate {
            /* transform: rotate(-180deg); */
            /* writing-mode: tb-rl; */
        }
    </style>
    <center>
        <h1>LAPORAN POSYANDU</h1>
    </center>
    @if(in_array(1, $jenis))
    <center>
        <h3>LAPORAN IBU HAMIL POSYANDU</h3>
    </center>
    <table class="table table-bordered table-sm" border="2" cellspacing="0">
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
                <th style="font-weight: bold;" rowspan=" 1" colspan="12">
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
                <th style="font-weight: bold;" rowspan="2">Tanggal
                </th>
                <th style="font-weight: bold;" colspan="2">Ditolong oleh</th>
                <th style="font-weight: bold;" colspan="4">Hidup</th>
                <th style="font-weight: bold;" rowspan="2">Meninggal</th>
            </tr>

            <tr>
                <th style="font-weight: bold;">Tanggal</th>
                <th style="font-weight: bold;">Umur Kelahiran</th>

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
                <!-- <th style="font-weight: bold;">1</th>
                <th style="font-weight: bold;">2</th>
                <th style="font-weight: bold;">3</th>
                <th style="font-weight: bold;">4</th>
                <th style="font-weight: bold;">5</th>
                <th style="font-weight: bold;">6</th>
                <th style="font-weight: bold;">7</th>
                <th style="font-weight: bold;">8</th>
                <th style="font-weight: bold;">9</th>
                <th style="font-weight: bold;">10</th>
                <th style="font-weight: bold;">11</th>
                <th style="font-weight: bold;">12</th> -->

                <th style="font-weight: bold;">Nakes</th>
                <th style="font-weight: bold;">Dukun</th>
                @php
                $sym = '< 2000 gr'; @endphp <th style="font-weight: bold;">
                    {{$sym}}</th>
                    <th style="font-weight: bold;">2000-2500 gr
                    </th>
                    <th style="font-weight: bold;">Normal</th>
                    <th style="font-weight: bold;"> >4000 gr</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @for($i = 0; $i < 40; $i++) <td style="text-align: center;">{{$i + 1}}</td>
                    @endfor
            </tr>
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
                @if((float) $bumil->lila > 23.5)
                <td style="text-align: center;">{{$bumil->lila}} cm <div style="background-color: red; border-radius: 50%; height: 5px; width: 5px; display: inline-block;"></div>
                </td>
                @else
                <td style="text-align: center;">{{$bumil->lila}} cm <div style="background-color: green; border-radius: 50%; height: 5px; width: 5px; display: inline-block;"></div>

                    @endif

                    <!-- tablet tt -->
                    @php
                    $tablet_tt = DB::select(DB::raw("select * from detail_bumils_tablet_tambah_darah where bumils_id = ".$bumil->id));
                    @endphp
                    @if(count($tablet_tt) == 0)
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($tablet_tt) == 1)
                @foreach($tablet_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($tablet_tt) == 2)
                @foreach($tablet_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                <td style="text-align: center;"></td>
                @endif
                @if(count($tablet_tt) == 3)
                @foreach($tablet_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                @endif

                <!-- imunisasi tt -->
                @php
                $imun_tt = DB::select(DB::raw("select * from detail_bumils_imunisasi_tt where bumils_id = ".$bumil->id));
                @endphp
                @if(count($imun_tt) == 0)
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($imun_tt) == 1)
                @foreach($imun_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($imun_tt) == 2)
                @foreach($imun_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($imun_tt) == 3)
                @foreach($imun_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($imun_tt) == 4)
                @foreach($imun_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                <td style="text-align: center;"></td>
                @endif
                @if(count($imun_tt) == 5)
                @foreach($imun_tt as $key => $v)
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                <td style="text-align: center;">{{$v->tanggal}}</td>
                @endforeach
                @endif
                @if($bumil->kapsul_yodium != '')
                <td style="text-align: center; width: 5px;">
                    <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div>
                </td>

                @else
                <td style="text-align: center; width: 5px;"></td>
                @endif


                @php
                $timbang = DB::select(DB::raw("select * from detail_bumils_hasil_penimbangan where bumils_id = ".$bumil->id));
                @endphp
                @if(count($timbang) == 0)
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($timbang) == 1)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($timbang) == 2)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($timbang) == 3)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($timbang) == 4)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if(count($timbang) == 5)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif


                @if(count($timbang) == 6)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif


                @if(count($timbang) == 7)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif

                @if(count($timbang) == 8)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>

                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif


                @if(count($timbang) == 9)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif

                @if(count($timbang) == 10)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif

                @if(count($timbang) == 11)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                <td style="text-align: center;"></td>
                @endif

                @if(count($timbang) == 12)
                @foreach($timbang as $key => $v)
                <td style="text-align: center;">
                    <div>
                        {{$v->berat_badan}} kg
                        <br>
                        {{$v->tekanan_darah}} mmHg
                    </div>
                </td>
                @endforeach
                @endif

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
                <td style="text-align: center;">
                    <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div>
                </td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if($bumil->bayi == 2)
                <td style="text-align: center;"></td>
                <td style="text-align: center;">
                    <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div>
                </td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                @endif
                @if($bumil->bayi == 3)
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;">
                    <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div>
                </td>
                <td style="text-align: center;"></td>
                @endif
                @if($bumil->bayi == 4)
                <td style="text-align: center;">
                </td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <div style="font-family: DejaVu Sans, sans-serif; font-weight: 14dg">✔</div>
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
    @endif

    @if(in_array(1, $jenis) && in_array(2, $jenis))
    <div style="page-break-before:always;"> </div>
    @endif
    @if(in_array(2, $jenis))
    <center>
        <h3>Laporan Bayi Posyandu</h3>
    </center>
    <table class="table table-bordered table-sm" border="2" cellspacing="0" cellpadding="2">




        @php $i=1 @endphp
        @foreach($bayi as $k => $b)
        <?php
        $jml = 60;

        $dt = DB::select(DB::raw("select * from detail_bayi_timbang where bayi_id = " . $b->id));
        $dt_bayi = array();

        $statustmb = array();
        $arrBulanKe = array();
        foreach ($dt as $key => $d) {
            array_push($arrBulanKe, $d->bulan_ke);
        }
        // dd($arrBulanKe);
        $vNow = array();
        $vNow2 = array();
        foreach ($dt as $key => $d) {

            $first_m_label = $dt[0]->bulan;
            $first_m = $dt[0]->bulan;


            array_push($dt_bayi, $d);


            if ($d->sd_bb == '-3') {
                $sd_bb = 7;
            }
            if ($d->sd_bb == '-2') {
                $sd_bb = 6;
            }
            if ($d->sd_bb == '-1') {
                $sd_bb = 5;
            }
            if ($d->sd_bb == 'median') {
                $sd_bb = 4;
            }
            if ($d->sd_bb == '+1') {
                $sd_bb = 3;
            }
            if ($d->sd_bb == '+2') {
                $sd_bb = 2;
            }
            if ($d->sd_bb == '+3') {
                $sd_bb = 1;
            }

            if ($key == 0) {
                $vNow = ['bb' => $d->berat_badan, 'sd_bb' => $sd_bb];
            } else {
                $bln = (int) $d->bulan_ke;
                $bln = $bln - 1;

                if (in_array($bln, $arrBulanKe)) {
                    if ($d->berat_badan > $vNow['bb']) {
                        if ($vNow['sd_bb'] < $sd_bb) {
                            $statustmb = array_merge($statustmb, ['dt_bb_' . $d->id => 'T1']);
                        } else {
                            $statustmb = array_merge($statustmb, ['dt_bb_' . $d->id => 'N']);
                        }
                    } elseif ($d->berat_badan == $vNow['bb']) {
                        $statustmb = array_merge($statustmb, ['dt_bb_' . $d->id => 'T2']);
                    } elseif ($d->berat_badan < $vNow['bb']) {
                        $statustmb = array_merge($statustmb, ['dt_bb_' . $d->id => 'T3']);
                    } else {
                        return 'beh';
                    }
                } else {
                    $statustmb = array_merge($statustmb, ['dt_bb_' . $d->id => 'O']);
                    // return Bayi::where('id', $d->bayi_id)->get();
                }
                $vNow = ['bb' => $d->berat_badan, 'sd_bb' => $sd_bb];
            }

            if ($d->sd_pb == '-3') {
                $sd_pb = 7;
            }
            if ($d->sd_pb == '-2') {
                $sd_pb = 6;
            }
            if ($d->sd_pb == '-1') {
                $sd_pb = 5;
            }
            if ($d->sd_pb == 'median') {
                $sd_pb = 4;
            }
            if ($d->sd_pb == '+1') {
                $sd_pb = 3;
            }
            if ($d->sd_pb == '+2') {
                $sd_pb = 2;
            }
            if ($d->sd_pb == '+3') {
                $sd_pb = 1;
            }
            if ($key == 0) {
                $vNow2 = ['pb' => $d->tinggi_badan, 'sd_pb' => $sd_pb];
                // return $vNow2;
            } else {
                $bln = (int) $d->bulan_ke;
                $bln = $bln - 1;
                if (in_array($bln, $arrBulanKe)) {
                    if ($d->tinggi_badan > $vNow2['pb']) {

                        if ($vNow2['sd_pb'] < $sd_pb) { // return [$sd_pb, $vNow2['sd_pb']]; // return Bayi::where('id', $d->bayi_id)->get();
                            $statustmb = array_merge($statustmb, ['dt_pb_' . $d->id => 'T1']);
                        } else {
                            $statustmb = array_merge($statustmb, ['dt_pb_' . $d->id => 'N']);
                        }
                    } elseif ($d->tinggi_badan == $vNow2['pb']) {
                        $statustmb = array_merge($statustmb, ['dt_pb_' . $d->id => 'T2']);
                    } elseif ($d->tinggi_badan < $vNow2['pb']) {
                        $statustmb = array_merge($statustmb, ['dt_pb_' . $d->id => 'T3']);
                    } else {
                        return 'beh';
                    }
                } else {
                    $statustmb = array_merge($statustmb, ['dt_pb_' . $d->id => 'O']);
                    // return Bayi::where('id', $d->bayi_id)->get();
                }
                $vNow2 = ['pb' => $d->tinggi_badan, 'sd_pb' => $sd_pb];
            }


            $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            foreach ($nama_bulan as $key => $bl) {
                if ($first_m == $bl) {
                    $first_m = '0' . ($key + 1);
                }
            }
        }
        ?>
        @if($k == 0)
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
            @for($i = 0; $i < 12; $i++) @if($i==0) <td style="font-weight: bold;">
                </td>

                @else
                @php
                $bln_now = $i;

                if($bln_now > 12)
                {
                $bln_now = $bln_now - 12;
                }
                $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                foreach($nama_bulan as $key => $bl){
                if($bln_now == ($key + 1)){
                $bln_now = $bl;
                }
                }
                @endphp

                <td style="font-weight: bold;">{{$bln_now}}</td>
                @endif
                @endfor
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

        @endif
        @if($k != 0)
        <tr>
            <th style="font-weight: bold;" rowspan="2"></th>
            <th style="font-weight: bold;" rowspan="2"></th>
            <th style="font-weight: bold;" rowspan="2"></th>
            <th style="font-weight: bold;" rowspan="2" class="rotate"></th>
            <th style="font-weight: bold;" rowspan="2"></th>
            <th style="font-weight: bold;" rowspan="2" class="rotate"></th>
            <th style="font-weight: bold; text-align: center;" colspan="12" rowspan="1">Bulan</th>
            @for($i = 0; $i < 17; $i++) <td rowspan="2">
                </td>
                @endfor


        </tr>

        <tr>
            @for($i = 0; $i < 12; $i++) @if($i==0) <td style="font-weight: bold;">
                </td>

                @else
                @php
                $bln_now = $i;

                if($bln_now > 12)
                {
                $bln_now = $bln_now - 12;
                }
                foreach($nama_bulan as $key => $bl){
                if($bln_now == ($key + 1)){
                $bln_now = $bl;
                }
                }
                @endphp

                <td style="font-weight: bold;">{{$bln_now}}</td>
                @endif
                @endfor


        </tr>


        @endif
        <tr>

            <td style="text-align: center;" rowspan="5">{{$k + 1}}</td>
            <td style="text-align: center;" rowspan="5">{{$b->nama}}</td>
            <td style="text-align: center;" rowspan="5">{{$b->tgl_lahir}}</td>
            <td style="text-align: center;" rowspan="5">{{$b->bb_pb}}</td>
            <td style="text-align: center;" rowspan="5">Ibu {{$b->nama_ibu}}, Ayah {{$b->nama_ayah}}</td>
            <td style="text-align: center;" rowspan="5">{{$b->l_p == 1 ? 'L' : 'P'}}</td>








            @php
            $dt_obat = DB::select(DB::raw(" select * from detail_bayi_obat where bayi_id=".$b->id));
            if (isset($dt_obat[0]->sirup_fe)) {
            $sirup_fe_arr = json_decode($dt_obat[0]->sirup_fe, true);
            $sirup_fe = array();
            foreach($sirup_fe_arr as $s){
            $sirup_fe = array_merge($sirup_fe, ['thn_'.$s['tahun_ke'] => $s]);
            }
            } else {
            $sirup_fe = [];
            }



            if (isset($dt_obat[0]->vit_a)) {
            $vit_a_arr = json_decode($dt_obat[0]->vit_a, true);
            $vit_a = array();
            foreach($vit_a_arr as $s){
            $vit_a = array_merge($vit_a, ['thn_'.$s['tahun_ke'] => $s]);
            }
            } else {
            $vit_a = [];
            }


            if (isset($dt_obat[0]->oralit)) {
            $oralit_arr = json_decode($dt_obat[0]->oralit, true);
            $oralit = array();
            foreach($oralit_arr as $s){
            $oralit = array_merge($oralit, ['thn_'.$s['tahun_ke'] => $s]);
            }
            } else {
            $oralit = [];
            }


            $dt_imun = DB::select(DB::raw(" select * from detail_bayi_imun where bayi_id=".$b->id));

            if (isset($dt_imun[0]->hbo)) {
            $hbo_arr = json_decode($dt_imun[0]->hbo, true);
            $hbo = array();
            foreach($hbo_arr as $s){
            $hbo = array_merge($hbo, ['thn_'.$s['tahun_ke'] => $s]);
            }
            } else {
            $hbo = [];
            }
            if (isset($dt_imun[0]->bcg)) {
            $bcg_arr = json_decode($dt_imun[0]->bcg, true);
            $bcg = array();
            foreach($bcg_arr as $s){
            $bcg = array_merge($bcg, ['thn_'.$s['tahun_ke'] => $s]);
            }
            } else {
            $bcg = [];
            }

            if (isset($dt_imun[0]->dpt_hb)) {
            $dpthb_arr = json_decode($dt_imun[0]->dpt_hb, true);
            $dpthb = array();
            foreach($dpthb_arr as $s){
            $dpthb = array_merge($dpthb, ['thn_'.$s['tahun_ke'] => $s]);
            }
            } else {
            $dpthb = [];
            }



            if (isset($dt_imun[0]->polio)) {
            $polio_arr = json_decode($dt_imun[0]->polio, true);
            $polio = array();
            foreach($polio_arr as $s){
            $polio = array_merge($polio, ['thn_'.$s['tahun_ke'] => $s]);
            }
            } else {
            $polio = [];
            }


            @endphp








            @for($i = 0; $i < 60; $i++) @if(isset($dt_bayi[$i]))<td style="font-weight: bold; height: 30px;">
                @if($dt_bayi[$i]->sd_bb == '-3')
                <span style="color: red;">{{$dt_bayi[$i]->berat_badan}}kg</span>
                @else
                <span style="color: green;">{{$dt_bayi[$i]->berat_badan}}kg</span>
                @endif

                /

                @if($dt_bayi[$i]->sd_pb == '-3')
                <span style="color: red;">{{$dt_bayi[$i]->tinggi_badan}}cm</span>
                @else
                <span style="color: green;">{{$dt_bayi[$i]->tinggi_badan}}cm</span>
                @endif
                <br> {{isset($statustmb['dt_bb_'.$dt_bayi[$i]->id]) ? '| ' . $statustmb['dt_bb_'.$dt_bayi[$i]->id]  : ''}}{{isset($statustmb['dt_pb_'.$dt_bayi[$i]->id]) ? '/' .$statustmb['dt_pb_'.$dt_bayi[$i]->id]  : ''}}

                </td>@else <td style=" font-weight: bold; height: 30px;">
                </td> @endif
                @if($i == 11)

                <td>{{array_key_exists('thn_1', $sirup_fe) ? $sirup_fe['thn_1']['bulan_ke_1'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $sirup_fe) ? $sirup_fe['thn_1']['bulan_ke_2'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $vit_a) ? $vit_a['thn_1']['bulan_ke_1'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $vit_a) ? $vit_a['thn_1']['bulan_ke_2'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $oralit) ? $oralit['thn_1']['tanggal'] : ''}}</td>

                <!-- imun -->
                <td>{{array_key_exists('thn_1', $hbo) ? $hbo['thn_1']['tanggal'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $bcg) ? $bcg['thn_1']['tanggal'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $dpthb) ? $dpthb['thn_1']['bulan_ke_1'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $dpthb) ? $dpthb['thn_1']['bulan_ke_2'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $dpthb) ? $dpthb['thn_1']['bulan_ke_3'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $polio) ? $polio['thn_1']['bulan_ke_1'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $polio) ? $polio['thn_1']['bulan_ke_2'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $polio) ? $polio['thn_1']['bulan_ke_3'] : ''}}</td>
                <td>{{array_key_exists('thn_1', $polio) ? $polio['thn_1']['bulan_ke_4'] : ''}}</td>
                <td>{{$b->campak}}</td>
                <td>{{$b->meninggal}}</td>
                <td>{{$b->keterangan}}</td>






        </tr>
        <tr>
            @endif
            @if($i == 23)

            <td>{{array_key_exists('thn_2', $sirup_fe) ? $sirup_fe['thn_2']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $sirup_fe) ? $sirup_fe['thn_2']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $vit_a) ? $vit_a['thn_2']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $vit_a) ? $vit_a['thn_2']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $oralit) ? $oralit['thn_2']['tanggal'] : ''}}</td>

            <!-- imun -->
            <td>{{array_key_exists('thn_2', $hbo) ? $hbo['thn_2']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $bcg) ? $bcg['thn_2']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $dpthb) ? $dpthb['thn_2']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $dpthb) ? $dpthb['thn_2']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $dpthb) ? $dpthb['thn_2']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $polio) ? $polio['thn_2']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $polio) ? $polio['thn_2']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $polio) ? $polio['thn_2']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_2', $polio) ? $polio['thn_2']['bulan_ke_4'] : ''}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            @endif
            @if($i == 35)
            <td>{{array_key_exists('thn_3', $sirup_fe) ? $sirup_fe['thn_3']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $sirup_fe) ? $sirup_fe['thn_3']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $vit_a) ? $vit_a['thn_3']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $vit_a) ? $vit_a['thn_3']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $oralit) ? $oralit['thn_3']['tanggal'] : ''}}</td>

            <!-- imun -->
            <td>{{array_key_exists('thn_3', $hbo) ? $hbo['thn_3']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $bcg) ? $bcg['thn_3']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $dpthb) ? $dpthb['thn_3']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $dpthb) ? $dpthb['thn_3']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $dpthb) ? $dpthb['thn_3']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $polio) ? $polio['thn_3']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $polio) ? $polio['thn_3']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $polio) ? $polio['thn_3']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_3', $polio) ? $polio['thn_3']['bulan_ke_4'] : ''}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            @endif
            @if($i == 47)
            <td>{{array_key_exists('thn_4', $sirup_fe) ? $sirup_fe['thn_4']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $sirup_fe) ? $sirup_fe['thn_4']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $vit_a) ? $vit_a['thn_4']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $vit_a) ? $vit_a['thn_4']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $oralit) ? $oralit['thn_4']['tanggal'] : ''}}</td>

            <!-- imun -->
            <td>{{array_key_exists('thn_4', $hbo) ? $hbo['thn_4']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $bcg) ? $bcg['thn_4']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $dpthb) ? $dpthb['thn_4']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $dpthb) ? $dpthb['thn_4']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $dpthb) ? $dpthb['thn_4']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $polio) ? $polio['thn_4']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $polio) ? $polio['thn_4']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $polio) ? $polio['thn_4']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_4', $polio) ? $polio['thn_4']['bulan_ke_4'] : ''}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            @endif
            @if($i == 59)
            <td>{{array_key_exists('thn_5', $sirup_fe) ? $sirup_fe['thn_5']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $sirup_fe) ? $sirup_fe['thn_5']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $vit_a) ? $vit_a['thn_5']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $vit_a) ? $vit_a['thn_5']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $oralit) ? $oralit['thn_5']['tanggal'] : ''}}</td>

            <!-- imun -->
            <td>{{array_key_exists('thn_5', $hbo) ? $hbo['thn_5']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $bcg) ? $bcg['thn_5']['tanggal'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $dpthb) ? $dpthb['thn_5']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $dpthb) ? $dpthb['thn_5']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $dpthb) ? $dpthb['thn_5']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $polio) ? $polio['thn_5']['bulan_ke_1'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $polio) ? $polio['thn_5']['bulan_ke_2'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $polio) ? $polio['thn_5']['bulan_ke_3'] : ''}}</td>
            <td>{{array_key_exists('thn_5', $polio) ? $polio['thn_5']['bulan_ke_4'] : ''}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        @endif
        @endfor



        @endforeach
    </table>
    @endif


</body>

</html>