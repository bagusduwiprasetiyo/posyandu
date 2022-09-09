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

            p {
                margin: 1px;
            }
        }
    </style>
</head>

<body>
    <div class="col-lg-12" style="padding:5%; ">


        <img src="{{asset('assets/img/jember.png')}}" width="150" alt="Logo Kabupaten Jember" style="float: left;">


        <p style="text-align: center; font-size: 12pt; font-weight: bold;">
            PEMERINTAH KABUPATEN JEMBER<br />
            DINAS KESEHATAN
        </p>
        <p style="font-size: 16pt; text-align: center; font-weight: bolder;">
            UPT. PUSKESMAS ARJASA
        </p>
        <p style="text-align: center; font-size: 10pt;">
            JL. DIPONEGORO NO.115 CANDIJATI-KEC.ARJASA TELP (0331)541160<br />
            JEMBER
        </p>


        <p style="text-align: right; font-size: 10pt;">
            KODE POS: 68191
        </p>
        <hr style="border-top: 1px solid black;">
        <p style="font-size: 12pt; text-align: center; font-weight: bolder;">
            LAPORAN HASIL KEGIATAN PELAKSANAAN PELAYANAN POSYANDU
        </p>

        <table style="table-layout: fixed; width: 100%; font-size: 10pt;">
            <tr>
                <td style="width: 80%;">Posyandu : {{$nama_posyandu}}</td>
                <td style="width: 50%;">Desa/Kel : {{isset($laporan['desa'])?$laporan['desa']:''}}</td>
            </tr>
            <tr>
                <td style="width: 80%;">Tanggal : {{isset($laporan['tanggal'])?$laporan['tanggal']:date('d-m-Y')}}</td>
                <td style="width: 50%;">Puskesmas : {{isset($laporan['puskesmas'])?$laporan['puskesmas']:''}}</td>
            </tr>
        </table>
        <p style="font-size: 10pt; text-align: left;">
            1. Hasil Kegiatan Posyandu Bulan Ini
        </p>
        <table style="width: 100%; font-size: 8pt; table-layout: fixed;" border="1" cellspacing="0" cellpadding="2">
            <tr style="background-color: grey;text-align: center;">
                <td style="width: 30px;">No</td>
                <td>Uraian</td>
                <td>Target</td>
                <td>Hasil</td>
                <td style="width: 30px;">No</td>
                <td>Uraian</td>
                <td>Target</td>
                <td>Hasil</td>
            </tr>
            <tr>
                <td></td>
                <td><b style="font-size: 8pt;">PROG.GIZI</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b style="font-size: 8pt;">BLF Anak Balita</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">1</td>
                <td>DPT</td>
                <td>
                    {{isset($laporan['target']['dpt'])?$laporan['target']['dpt']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['dpt'])?$laporan['hasil']['dpt']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">1</td>
                <td>S</td>
                <td>
                    {{isset($laporan['target']['s'])?$laporan['target']['s']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['s'])?$laporan['hasil']['s']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td><b style="font-size: 8pt;">TT WUS</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center;">2</td>
                <td>K</td>
                <td>
                    {{isset($laporan['target']['k'])?$laporan['target']['k']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['k'])?$laporan['hasil']['k']:''}}
                </td>
                <td style="text-align: center;">1</td>
                <td>Jml. WUS yang di TT 5</td>
                <td>
                    {{isset($laporan['target']['wus_tt'])?$laporan['target']['wus_tt']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['wus_tt'])?$laporan['hasil']['wus_tt']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">3</td>
                <td>D</td>
                <td>
                    {{isset($laporan['target']['d'])?$laporan['target']['d']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['d'])?$laporan['hasil']['d']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td><b style="font-size: 8pt;">Program KIA / KB</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center;">4</td>
                <td>N</td>
                <td>
                    {{isset($laporan['target']['n'])?$laporan['target']['n']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['n'])?$laporan['hasil']['n']:''}}
                </td>
                <td style="text-align: center;">1</td>
                <td>Pelayanan DDTK</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center;">5</td>
                <td>K/S</td>
                <td>
                    {{isset($laporan['target']['ks'])?$laporan['target']['ks']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['ks'])?$laporan['hasil']['ks']:$laporan['hasil']['k'].'/'.$laporan['hasil']['s']}}
                </td>
                <td style="text-align: center;"></td>
                <td>- Bayi</td>
                <td>
                    {{isset($laporan['target']['ddtk_bayi'])?$laporan['target']['ddtk_bayi']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['ddtk_bayi'])?$laporan['hasil']['ddtk_bayi']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">6</td>
                <td>D/S</td>
                <td>
                    {{isset($laporan['target']['ds'])?$laporan['target']['ds']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['ds'])?$laporan['hasil']['ds']:$laporan['hasil']['d'].'/'.$laporan['hasil']['s']}}
                </td>
                <td style="text-align: center;"></td>
                <td>- Balita</td>
                <td>
                    {{isset($laporan['target']['ddtk_balita'])?$laporan['target']['ddtk_balita']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['ddtk_balita'])?$laporan['hasil']['ddtk_balita']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">7</td>
                <td>N/D</td>
                <td>
                    {{isset($laporan['target']['nd'])?$laporan['target']['nd']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['nd'])?$laporan['hasil']['nd']:$laporan['hasil']['n'].'/'.$laporan['hasil']['d']}}
                </td>
                <td style="text-align: center;">2</td>
                <td>Pelayanan Bayi Paripurna/PR</td>
                <td>
                    {{isset($laporan['target']['bayi_paripurna'])?$laporan['target']['bayi_paripurna']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bayi_paripurna'])?$laporan['hasil']['bayi_paripurna']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">8</td>
                <td>Jumlah T1</td>
                <td>
                    {{isset($laporan['target']['t1'])?$laporan['target']['t1']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['t1'])?$laporan['hasil']['t1']:''}}
                </td>
                <td style="text-align: center;">3</td>
                <td>Pelayanan Balita Paripurna/PR</td>
                <td>
                    {{isset($laporan['target']['balita_paripurna'])?$laporan['target']['balita_paripurna']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['balita_paripurna'])?$laporan['hasil']['balita_paripurna']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">9</td>
                <td>Jumlah T2</td>
                <td>
                    {{isset($laporan['target']['t2'])?$laporan['target']['t2']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['t2'])?$laporan['hasil']['t2']:''}}
                </td>
                <td style="text-align: center;">4</td>
                <td>Bumil yang diperiksa</td>
                <td>
                    {{isset($laporan['target']['bumil_diperiksa'])?$laporan['target']['bumil_diperiksa']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bumil_diperiksa'])?$laporan['hasil']['bumil_diperiksa']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">10</td>
                <td>Jumlah T3</td>
                <td>
                    {{isset($laporan['target']['t3'])?$laporan['target']['t3']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['t3'])?$laporan['hasil']['t3']:''}}
                </td>
                <td style="text-align: center;">5</td>
                <td>Bumil resiko tinggi (RT) yang hadir</td>
                <td>
                    {{isset($laporan['target']['bumil_resiko_hadir'])?$laporan['target']['bumil_resiko_hadir']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bumil_resiko_hadir'])?$laporan['hasil']['bumil_resiko_hadir']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">11</td>
                <td>Jumlah 2T</td>
                <td>
                    {{isset($laporan['target']['2t'])?$laporan['target']['2t']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['2t'])?$laporan['hasil']['2t']:''}}
                </td>
                <td style="text-align: center;">6</td>
                <td>Bumil resiko tinggi (RT) yang tidak hadir</td>
                <td>
                    {{isset($laporan['target']['bumil_resiko_tidak_hadir'])?$laporan['target']['bumil_resiko_tidak_hadir']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bumil_resiko_tidak_hadir'])?$laporan['hasil']['bumil_resiko_tidak_hadir']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">12</td>
                <td>Jumlah BGM</td>
                <td>
                    <{{isset($laporan['target']['bgm'])?$laporan['target']['bgm']:''}} </td> <td>
                        {{isset($laporan['hasil']['bgm'])?$laporan['hasil']['bgm']:''}}
                </td>
                <td style="text-align: center;">7</td>
                <td>Bumil KEK (LILA < 23,5 cm)</td> <td>
                        {{isset($laporan['target']['kek_lila'])?$laporan['target']['kek_lila']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['kek_lila'])?$laporan['hasil']['kek_lila']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">13</td>
                <td>Jumlah Anak Balita Gizi Buruk</td>
                <td>
                    {{isset($laporan['target']['bgb'])?$laporan['target']['bgb']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bgb'])?$laporan['hasil']['bgb']:''}}
                </td>
                <td style="text-align: center;">8</td>
                <td>Jumlah BUFAS Baru</td>
                <td>
                    {{isset($laporan['target']['bufas'])?$laporan['target']['bufas']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bufas'])?$laporan['hasil']['bufas']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">14</td>
                <td>Jumlah Anak Balita Kurus</td>
                <td>
                    {{isset($laporan['target']['balita_kurus'])?$laporan['target']['balita_kurus']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['balita_kurus'])?$laporan['hasil']['balita_kurus']:''}}
                </td>
                <td style="text-align: center;">9</td>
                <td>Jumlah BUFAS Kunjungan Ulang</td>
                <td>
                    {{isset($laporan['target']['bufas_ulang'])?$laporan['target']['bufas_ulang']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bufas_ulang'])?$laporan['hasil']['bufas_ulang']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">15</td>
                <td>Jumlah Bayi Baru</td>
                <td>
                    {{isset($laporan['target']['bayi_baru'])?$laporan['target']['bayi_baru']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bayi_baru'])?$laporan['hasil']['bayi_baru']:''}}
                </td>
                <td style="text-align: center;">10</td>
                <td>Hasil pelayanan KB</td>
                <td>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center;">16</td>
                <td>Jumlah Balita O</td>
                <td>
                    {{isset($laporan['target']['tidak_hadir'])?$laporan['target']['tidak_hadir']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['tidak_hadir'])?$laporan['hasil']['tidak_hadir']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td>- Akseptor Baru</td>
                <td>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td>a. Pil</td>
                <td>
                    {{isset($laporan['target']['aseptor_baru']['Pil'])?$laporan['target']['aseptor_baru']['Pil']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_baru']['Pil'])?$laporan['hasil']['aseptor_baru']['Pil']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"></td>
                <td><b style="font-size: 8pt;">PROG.IMUNISASI</b></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td>b. Suntik</td>
                <td>
                    {{isset($laporan['target']['aseptor_baru']['Suntik'])?$laporan['target']['aseptor_baru']['Suntik']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_baru']['Suntik'])?$laporan['hasil']['aseptor_baru']['Suntik']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"></td>
                <td><b style="font-size: 8pt;">Imunisasi Dasar</b></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td>c. Kondom</td>
                <td>
                    {{isset($laporan['target']['aseptor_baru']['Kondom'])?$laporan['target']['aseptor_baru']['Kondom']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_baru']['Kondom'])?$laporan['hasil']['aseptor_baru']['Kondom']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">1</td>
                <td>BCG</td>
                <td>
                    {{isset($laporan['target']['bcg'])?$laporan['target']['bcg']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['bcg'])?$laporan['hasil']['bcg']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td>- Akseptor Aktif</td>
                <td>
                </td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center;">2</td>
                <td>Polio 1</td>
                <td>
                    {{isset($laporan['target']['polio1'])?$laporan['target']['polio1']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['polio1'])?$laporan['hasil']['polio1']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td>a. UID</td>
                <td>
                    {{isset($laporan['target']['aseptor_aktif']['IUD'])?$laporan['target']['aseptor_aktif']['IUD']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_aktif']['IUD'])?$laporan['hasil']['aseptor_aktif']['IUD']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">3</td>
                <td>DPT-HB 1/Polio 2</td>
                <td>

                    {{isset($laporan['target']['dpthb1'])?$laporan['target']['dpthb1']:''}}
                    /
                    {{isset($laporan['target']['polio2'])?$laporan['target']['polio2']:''}}

                </td>
                <td>
                    {{isset($laporan['hasil']['dpthb1'])?$laporan['hasil']['dpthb1']:''}}
                    /
                    {{isset($laporan['hasil']['polio2'])?$laporan['hasil']['polio2']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td>b. MOP</td>
                <td>
                    {{isset($laporan['target']['aseptor_aktif']['MOP'])?$laporan['target']['aseptor_aktif']['MOP']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_aktif']['MOP'])?$laporan['hasil']['aseptor_aktif']['MOP']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">4</td>
                <td>DPT-HB 2/Polio 3</td>
                <td>

                    {{isset($laporan['target']['dpthb2'])?$laporan['target']['dpthb2']:''}}
                    /
                    <input type="text" style="float:right; width: 45%; text-align: center;" name="target[polio3]" value="{{isset($laporan['target']['polio3'])?$laporan['target']['polio3']:''}}">

                </td>
                <td>
                    {{isset($laporan['hasil']['dpthb2'])?$laporan['hasil']['dpthb2']:''}}
                    /
                    {{isset($laporan['hasil']['polio3'])?$laporan['hasil']['polio3']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td>c. MOW</td>
                <td>
                    {{isset($laporan['target']['aseptor_aktif']['MOW'])?$laporan['target']['aseptor_aktif']['MOW']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_aktif']['MOW'])?$laporan['hasil']['aseptor_aktif']['MOW']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">5</td>
                <td>DPT-HB 3/Polio 4</td>
                <td>

                    {{isset($laporan['target']['dpthb3'])?$laporan['target']['dpthb3']:''}}
                    /
                    {{isset($laporan['target']['polio4'])?$laporan['target']['polio4']:''}}

                </td>
                <td>
                    {{isset($laporan['hasil']['dpthb3'])?$laporan['hasil']['dpthb3']:''}}
                    /
                    {{isset($laporan['hasil']['polio4'])?$laporan['hasil']['polio4']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td>d. Implant</td>
                <td>
                    {{isset($laporan['target']['aseptor_aktif']['Implant'])?$laporan['target']['aseptor_aktif']['Implant']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_aktif']['Implant'])?$laporan['hasil']['aseptor_aktif']['Implant']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">6</td>
                <td>Campak</td>
                <td>
                    {{isset($laporan['target']['campak'])?$laporan['target']['campak']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['campak'])?$laporan['hasil']['campak']:''}}
                </td>
                <td style="text-align: center;"></td>
                <td>e. Suntik</td>
                <td>
                    {{isset($laporan['target']['aseptor_aktif']['Suntik'])?$laporan['target']['aseptor_aktif']['Suntik']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_aktif']['Suntik'])?$laporan['hasil']['aseptor_aktif']['Suntik']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td>f. Pil</td>
                <td>
                    {{isset($laporan['target']['aseptor_aktif']['Pil'])?$laporan['target']['aseptor_aktif']['Pil']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_aktif']['Pil'])?$laporan['hasil']['aseptor_aktif']['Pil']:''}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;"></td>
                <td>g. Kondom</td>
                <td>
                    {{isset($laporan['target']['aseptor_aktif']['Kondom'])?$laporan['target']['aseptor_aktif']['Kondom']:''}}
                </td>
                <td>
                    {{isset($laporan['hasil']['aseptor_aktif']['Kondom'])?$laporan['hasil']['aseptor_aktif']['Kondom']:''}}
                </td>

            </tr>
        </table>
        <br>
        <div class="form-group">
            <label for="">
                2. Permasalahan
            </label>
            <br>
            {{isset($laporan['permasalahan'])?$laporan['permasalahan']:''}}
        </div>
        <div class="form-group">
            <label for="">
                2. Rencana Tingkat Lanjut
            </label>
            <br>
            {{isset($laporan['rencana'])?$laporan['rencana']:''}}
        </div>
    </div>
    <br><br>
    <div class="col-lg-12" style="border: 1px solid black; padding:5%;">
        </b>
        <table>
            <tr>
                <td style="font-weight: bold; font-size: 11pt;">Posyandu</td>
                <td style="font-size: 11pt; width: 10px;">:</td>
                <td style="font-size: 11pt;">Posyandu</td>
            </tr>
            <tr>
                <td style="font-weight: bold; font-size: 11pt;">Nama Kader</td>
                <td style="font-size: 11pt; width: 10px;">:</td>
                <td style="font-size: 11pt;">{{Auth::user()->name}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; font-size: 11pt;">Desa</td>
                <td style="font-size: 11pt; width: 10px;">:</td>
                <td style="font-size: 11pt;">{{isset($laporan['desa'])?$laporan['desa']:''}}</td>
            </tr>
        </table>
        <br>
        <b style="font-size: 11pt;">DATA BULANAN BALITA</b>
        <table style="width: 100%; font-size: 10pt; table-layout: fixed;" border="1" cellspacing="0" cellpadding="3">
            <tr style="text-align: center;">
                <th style="width: 5%;">No</th>
                <th style="width: 40%;">Nama Balita</th>
                <th>Umur</th>
                <th>BB</th>
                <th>NTOB</th>
            </tr>
            <?php $i = 1; ?>
            @foreach($laporan['bayi_bulanan'] as $key => $value)
            <tr style="text-align: center;">
                <td>{{$i++}}</td>
                <td style="text-align: left;">{{$value['nama']}}</td>
                <td>{{$value['umur']}} Bulan</td>
                <td>{{$value['berat_badan']}} Kg</td>
                <td>{{$value['ntob']}}</td>
            </tr>
            @endforeach
        </table>
        <br>
        <b style="font-size: 11pt;">DATA BULANAN BUMIL</b>
        <table style="width: 100%; font-size: 10pt; table-layout: fixed;" border="1" cellspacing="0" cellpadding="3">
            <tr style="text-align: center;">
                <th style="width: 5%;">No</th>
                <th style="width: 40%;">Nama </th>
                <th>Umur</th>
                <th>BB</th>
            </tr>
            <?php $i = 1; ?>
            @foreach($laporan['bumil_bulanan'] as $key => $value)
            <tr style="text-align: center;">
                <td>{{$i++}}</td>
                <td style="text-align: left;">{{$value->nama_ibu}}</td>
                <td>{{$value['umur']}} Tahun</td>
                <td>{{$value['berat_badan']}} Kg</td>
            </tr>
            @endforeach
        </table>
        <br>
        <p>Jember, {{date('d-m-Y')}}</p>

        {{isset($laporan['keterangan'])?$laporan['keterangan']:''}}
    </div>



</body>
<script>
    window.print()
</script>