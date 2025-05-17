@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Laporan Bulanan Posyandu</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Laporan</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <!-- <a href="{{url('/puswus/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Pus/Wus
                        </a> -->
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: scroll;">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <?php
                            if (session()->has('kader')) {
                                $list_posyandu = DB::select(DB::raw("select * from list_posyandu where id = " . session()->get('kader')->posyandu_id));
                            } else {
                                $list_posyandu = DB::table('list_posyandu')->get();
                            }
                            ?>
                            <div class="form-row">
                                <div class="form-group col-sm-3">
                                    <h6 class="mt-3">Tampilkan Data Posyandu Dari : </h6>
                                    <select id="posyandu_id" name="posyandu_id" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true" required>
                                        @if($id_posyandu != 0)
                                        <option value="0">-- Semua Posyandu --</option>
                                        @foreach($list_posyandu as $lp)
                                        @if($id_posyandu == $lp->id)
                                        <option value="{{$lp->id}}" selected>{{$lp->nama}}</option>
                                        @else
                                        <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        <option value="0" selected>-- Semua Posyandu --</option>
                                        @foreach($list_posyandu as $lp)
                                        <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <h6 class="mt-3">Tampilkan Data Tahun dan Bulan : </h6>

                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" id="dateyear" class="form-control form-control-sm" style="background-color: #F3F3F3;" placeholder="Pilih Tahun" value="{{$tahun}}-{{$bulan}}">
                                </div>

                                <div class="offset-sm-9 mt-3">
                                    <button id="simpan" class="btn btn-sm btn-success"><i class="mdi mdi-file menu-icon"></i> Simpan</button>
                                    <button id="cetak" class="btn btn-sm btn-primary" style="float-right"><i class="mdi mdi-printer menu-icon"></i> Cetak Laporan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="" method="post" style="overflow-x: scroll; min-width: 900px;">
                        @csrf
                        <input type="hidden" name="bulan_tahun" value="{{$tahun}}-{{$bulan}}">
                        <input type="hidden" name="posyandu_id" value="{{$id_posyandu}}">
                        <div class="col-lg-12" style="border: 1px solid black; padding:5%; ">
                            <div class="row">

                                <div class="col-2">
                                    <img src="{{asset('assets/img/jember.png')}}" width="200" alt="Logo Kabupaten Jember">
                                </div>
                                <div class="col-10">
                                    <p style="text-align: center; font-size: 16pt; font-weight: bold;">
                                        PEMERINTAH KABUPATEN JEMBER<br />
                                        DINAS KESEHATAN
                                    </p>
                                    <p style="font-size: 20pt; text-align: center; font-weight: bolder;">
                                        UPT. PUSKESMAS ARJASA
                                    </p>
                                    <p style="text-align: center; font-size: 14pt;">
                                        JL. DIPONEGORO NO.115 CANDIJATI-KEC.ARJASA TELP (0331)541160<br />
                                        JEMBER
                                    </p>

                                </div>
                            </div>
                            <p style="text-align: right; font-size: 12pt;">
                                KODE POS: 68191
                            </p>
                            <hr style="border-top: 1px solid black;">
                            <p style="font-size: 14pt; text-align: center; font-weight: bolder;">
                                LAPORAN HASIL KEGIATAN PELAKSANAAN PELAYANAN POSYANDU
                            </p>

                            <table style="table-layout: fixed; width: 100%;">
                                <tr>
                                    <td style="width: 50%;">Posyandu : {{$nama_posyandu}}</td>
                                    <td style="width: 50%;">Desa/Kel : <input type="text" name="desa" value="{{isset($laporan['desa'])?$laporan['desa']:''}}"></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Tanggal : {{isset($laporan['tanggal'])?$laporan['tanggal']:date('d-m-Y')}}</td>
                                    <td style="width: 50%;">Puskesmas : <input type="text" name="puskesmas" value="{{isset($laporan['puskesmas'])?$laporan['puskesmas']:''}}"></td>
                                </tr>
                            </table>
                            <p style="font-size: 12pt; text-align: left;">
                                1. Hasil Kegiatan Posyandu Bulan Ini
                            </p>
                            <table style="width: 100%; font-size: 10pt; table-layout: fixed;" border="1" cellspacing="0" cellpadding="2">
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
                                    <td><b>PROG.GIZI</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><b>BLF Anak Balita</b></td>
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
                                        <input type="text" style="width: 100%; text-align: center;" name="target[dpt]" value="{{isset($laporan['target']['dpt'])?$laporan['target']['dpt']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[dpt]" value="{{isset($laporan['hasil']['dpt'])?$laporan['hasil']['dpt']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">1</td>
                                    <td>S</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[s]" value="{{isset($laporan['target']['s'])?$laporan['target']['s']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[s]" value="{{isset($laporan['hasil']['s'])?$laporan['hasil']['s']:''}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td><b>TT WUS</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">2</td>
                                    <td>K</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[k]" value="{{isset($laporan['target']['k'])?$laporan['target']['k']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[k]" value="{{isset($laporan['hasil']['k'])?$laporan['hasil']['k']:''}}">
                                    </td>
                                    <td style="text-align: center;">1</td>
                                    <td>Jml. WUS yang di TT 5</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[wus_tt]" value="{{isset($laporan['target']['wus_tt'])?$laporan['target']['wus_tt']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[wus_tt]" value="{{isset($laporan['hasil']['wus_tt'])?$laporan['hasil']['wus_tt']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">3</td>
                                    <td>D</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[d]" value="{{isset($laporan['target']['d'])?$laporan['target']['d']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[d]" value="{{isset($laporan['hasil']['d'])?$laporan['hasil']['d']:''}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td><b>Program KIA / KB</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">4</td>
                                    <td>N</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[n]" value="{{isset($laporan['target']['n'])?$laporan['target']['n']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[n]" value="{{isset($laporan['hasil']['n'])?$laporan['hasil']['n']:''}}">
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
                                        <input type="text" style="width: 100%; text-align: center;" name="target[ks]" value="{{isset($laporan['target']['ks'])?$laporan['target']['ks']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[ks]" value="{{isset($laporan['hasil']['ks'])?$laporan['hasil']['ks']:$laporan['hasil']['k'].'/'.$laporan['hasil']['s']}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td>- Bayi</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[ddtk_bayi]" value="{{isset($laporan['target']['ddtk_bayi'])?$laporan['target']['ddtk_bayi']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[ddtk_bayi]" value="{{isset($laporan['hasil']['ddtk_bayi'])?$laporan['hasil']['ddtk_bayi']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">6</td>
                                    <td>D/S</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[ds]" value="{{isset($laporan['target']['ds'])?$laporan['target']['ds']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[ds]" value="{{isset($laporan['hasil']['ds'])?$laporan['hasil']['ds']:$laporan['hasil']['d'].'/'.$laporan['hasil']['s']}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td>- Balita</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[ddtk_balita]" value="{{isset($laporan['target']['ddtk_balita'])?$laporan['target']['ddtk_balita']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[ddtk_balita]" value="{{isset($laporan['hasil']['ddtk_balita'])?$laporan['hasil']['ddtk_balita']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">7</td>
                                    <td>N/D</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[nd]" value="{{isset($laporan['target']['nd'])?$laporan['target']['nd']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[nd]" value="{{isset($laporan['hasil']['nd'])?$laporan['hasil']['nd']:$laporan['hasil']['n'].'/'.$laporan['hasil']['d']}}">
                                    </td>
                                    <td style="text-align: center;">2</td>
                                    <td>Pelayanan Bayi Paripurna/PR</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bayi_paripurna]" value="{{isset($laporan['target']['bayi_paripurna'])?$laporan['target']['bayi_paripurna']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bayi_paripurna]" value="{{isset($laporan['hasil']['bayi_paripurna'])?$laporan['hasil']['bayi_paripurna']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">8</td>
                                    <td>Jumlah T1</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[t1]" value="{{isset($laporan['target']['t1'])?$laporan['target']['t1']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[t1]" value="{{isset($laporan['hasil']['t1'])?$laporan['hasil']['t1']:''}}">
                                    </td>
                                    <td style="text-align: center;">3</td>
                                    <td>Pelayanan Balita Paripurna/PR</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[balita_paripurna]" value="{{isset($laporan['target']['balita_paripurna'])?$laporan['target']['balita_paripurna']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[balita_paripurna]" value="{{isset($laporan['hasil']['balita_paripurna'])?$laporan['hasil']['balita_paripurna']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">9</td>
                                    <td>Jumlah T2</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[t2]" value="{{isset($laporan['target']['t2'])?$laporan['target']['t2']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[t2]" value="{{isset($laporan['hasil']['t2'])?$laporan['hasil']['t2']:''}}">
                                    </td>
                                    <td style="text-align: center;">4</td>
                                    <td>Bumil yang diperiksa</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bumil_diperiksa]" value="{{isset($laporan['target']['bumil_diperiksa'])?$laporan['target']['bumil_diperiksa']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bumil_diperiksa]" value="{{isset($laporan['hasil']['bumil_diperiksa'])?$laporan['hasil']['bumil_diperiksa']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">10</td>
                                    <td>Jumlah T3</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[t3]" value="{{isset($laporan['target']['t3'])?$laporan['target']['t3']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[t3]" value="{{isset($laporan['hasil']['t3'])?$laporan['hasil']['t3']:''}}">
                                    </td>
                                    <td style="text-align: center;">5</td>
                                    <td>Bumil resiko tinggi (RT) yang hadir</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bumil_resiko_hadir]" value="{{isset($laporan['target']['bumil_resiko_hadir'])?$laporan['target']['bumil_resiko_hadir']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bumil_resiko_hadir]" value="{{isset($laporan['hasil']['bumil_resiko_hadir'])?$laporan['hasil']['bumil_resiko_hadir']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">11</td>
                                    <td>Jumlah 2T</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[2t]" value="{{isset($laporan['target']['2t'])?$laporan['target']['2t']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[2t]" value="{{isset($laporan['hasil']['2t'])?$laporan['hasil']['2t']:''}}">
                                    </td>
                                    <td style="text-align: center;">6</td>
                                    <td>Bumil resiko tinggi (RT) yang tidak hadir</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bumil_resiko_tidak_hadir]" value="{{isset($laporan['target']['bumil_resiko_tidak_hadir'])?$laporan['target']['bumil_resiko_tidak_hadir']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bumil_resiko_tidak_hadir]" value="{{isset($laporan['hasil']['bumil_resiko_tidak_hadir'])?$laporan['hasil']['bumil_resiko_tidak_hadir']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">12</td>
                                    <td>Jumlah BGM</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bgm]" value="{{isset($laporan['target']['bgm'])?$laporan['target']['bgm']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bgm]" value="{{isset($laporan['hasil']['bgm'])?$laporan['hasil']['bgm']:''}}">
                                    </td>
                                    <td style="text-align: center;">7</td>
                                    <td>Bumil KEK (LILA < 23,5 cm)</td> <td>
                                            <input type="text" style="width: 100%; text-align: center;" name="target[kek_lila]" value="{{isset($laporan['target']['kek_lila'])?$laporan['target']['kek_lila']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[kek_lila]" value="{{isset($laporan['hasil']['kek_lila'])?$laporan['hasil']['kek_lila']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">13</td>
                                    <td>Jumlah Anak Balita Gizi Buruk</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bgb]" value="{{isset($laporan['target']['bgb'])?$laporan['target']['bgb']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bgb]" value="{{isset($laporan['hasil']['bgb'])?$laporan['hasil']['bgb']:''}}">
                                    </td>
                                    <td style="text-align: center;">8</td>
                                    <td>Jumlah BUFAS Baru</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bufas]" value="{{isset($laporan['target']['bufas'])?$laporan['target']['bufas']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bufas]" value="{{isset($laporan['hasil']['bufas'])?$laporan['hasil']['bufas']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">14</td>
                                    <td>Jumlah Anak Balita Kurus</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[balita_kurus]" value="{{isset($laporan['target']['balita_kurus'])?$laporan['target']['balita_kurus']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[balita_kurus]" value="{{isset($laporan['hasil']['balita_kurus'])?$laporan['hasil']['balita_kurus']:''}}">
                                    </td>
                                    <td style="text-align: center;">9</td>
                                    <td>Jumlah BUFAS Kunjungan Ulang</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bufas_ulang]" value="{{isset($laporan['target']['bufas_ulang'])?$laporan['target']['bufas_ulang']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bufas_ulang]" value="{{isset($laporan['hasil']['bufas_ulang'])?$laporan['hasil']['bufas_ulang']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">15</td>
                                    <td>Jumlah Bayi Baru</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bayi_baru]" value="{{isset($laporan['target']['bayi_baru'])?$laporan['target']['bayi_baru']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bayi_baru]" value="{{isset($laporan['hasil']['bayi_baru'])?$laporan['hasil']['bayi_baru']:''}}">
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
                                        <input type="text" style="width: 100%; text-align: center;" name="target[tidak_hadir]" value="{{isset($laporan['target']['tidak_hadir'])?$laporan['target']['tidak_hadir']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[tidak_hadir]" value="{{isset($laporan['hasil']['tidak_hadir'])?$laporan['hasil']['tidak_hadir']:''}}">
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
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_baru][Pil]" value="{{isset($laporan['target']['aseptor_baru']['Pil'])?$laporan['target']['aseptor_baru']['Pil']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_baru][Pil]" value="{{isset($laporan['hasil']['aseptor_baru']['Pil'])?$laporan['hasil']['aseptor_baru']['Pil']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"></td>
                                    <td><b>PROG.IMUNISASI</b></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center;"></td>
                                    <td>b. Suntik</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_baru][Suntik]" value="{{isset($laporan['target']['aseptor_baru']['Suntik'])?$laporan['target']['aseptor_baru']['Suntik']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_baru][Suntik]" value="{{isset($laporan['hasil']['aseptor_baru']['Suntik'])?$laporan['hasil']['aseptor_baru']['Suntik']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"></td>
                                    <td><b>Imunisasi Dasar</b></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center;"></td>
                                    <td>c. Kondom</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_baru][Kondom]" value="{{isset($laporan['target']['aseptor_baru']['Kondom'])?$laporan['target']['aseptor_baru']['Kondom']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_baru][Kondom]" value="{{isset($laporan['hasil']['aseptor_baru']['Kondom'])?$laporan['hasil']['aseptor_baru']['Kondom']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">1</td>
                                    <td>BCG</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[bcg]" value="{{isset($laporan['target']['bcg'])?$laporan['target']['bcg']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[bcg]" value="{{isset($laporan['hasil']['bcg'])?$laporan['hasil']['bcg']:''}}">
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
                                        <input type="text" style="width: 100%; text-align: center;" name="target[polio1]" value="{{isset($laporan['target']['polio1'])?$laporan['target']['polio1']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[polio1]" value="{{isset($laporan['hasil']['polio1'])?$laporan['hasil']['polio1']:''}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td>a. UID</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_aktif][IUD]" value="{{isset($laporan['target']['aseptor_aktif']['IUD'])?$laporan['target']['aseptor_aktif']['IUD']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_aktif][IUD]" value="{{isset($laporan['hasil']['aseptor_aktif']['IUD'])?$laporan['hasil']['aseptor_aktif']['IUD']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">3</td>
                                    <td>DPT-HB 1/Polio 2</td>
                                    <td>

                                        <input type="text" style="width: 45%; text-align: center;" name="target[dpthb1]" value="{{isset($laporan['target']['dpthb1'])?$laporan['target']['dpthb1']:''}}">
                                        /
                                        <input type="text" style="float:right; width: 45%; text-align: center;" name="target[polio2]" value="{{isset($laporan['target']['polio2'])?$laporan['target']['polio2']:''}}">

                                    </td>
                                    <td>
                                        <input type="text" style="width: 45%; text-align: center;" name="hasil[dpthb1]" value="{{isset($laporan['hasil']['dpthb1'])?$laporan['hasil']['dpthb1']:''}}">
                                        /
                                        <input type="text" style="float:right; width: 45%; text-align: center;" name="hasil[polio2]" value="{{isset($laporan['hasil']['polio2'])?$laporan['hasil']['polio2']:''}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td>b. MOP</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_aktif][MOP]" value="{{isset($laporan['target']['aseptor_aktif']['MOP'])?$laporan['target']['aseptor_aktif']['MOP']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_aktif][MOP]" value="{{isset($laporan['hasil']['aseptor_aktif']['MOP'])?$laporan['hasil']['aseptor_aktif']['MOP']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">4</td>
                                    <td>DPT-HB 2/Polio 3</td>
                                    <td>

                                        <input type="text" style="width: 45%; text-align: center;" name="target[dpthb2]" value="{{isset($laporan['target']['dpthb2'])?$laporan['target']['dpthb2']:''}}">
                                        /
                                        <input type="text" style="float:right; width: 45%; text-align: center;" name="target[polio3]" value="{{isset($laporan['target']['polio3'])?$laporan['target']['polio3']:''}}">

                                    </td>
                                    <td>
                                        <input type="text" style="width: 45%; text-align: center;" name="hasil[dpthb2]" value="{{isset($laporan['hasil']['dpthb2'])?$laporan['hasil']['dpthb2']:''}}">
                                        /
                                        <input type="text" style="float:right; width: 45%; text-align: center;" name="hasil[polio3]" value="{{isset($laporan['hasil']['polio3'])?$laporan['hasil']['polio3']:''}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td>c. MOW</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_aktif][MOW]" value="{{isset($laporan['target']['aseptor_aktif']['MOW'])?$laporan['target']['aseptor_aktif']['MOW']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_aktif][MOW]" value="{{isset($laporan['hasil']['aseptor_aktif']['MOW'])?$laporan['hasil']['aseptor_aktif']['MOW']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">5</td>
                                    <td>DPT-HB 3/Polio 4</td>
                                    <td>

                                        <input type="text" style="width: 45%; text-align: center;" name="target[dpthb3]" value="{{isset($laporan['target']['dpthb3'])?$laporan['target']['dpthb3']:''}}">
                                        /
                                        <input type="text" style="float:right; width: 45%; text-align: center;" name="target[polio4]" value="{{isset($laporan['target']['polio4'])?$laporan['target']['polio4']:''}}">

                                    </td>
                                    <td>
                                        <input type="text" style="width: 45%; text-align: center;" name="hasil[dpthb3]" value="{{isset($laporan['hasil']['dpthb3'])?$laporan['hasil']['dpthb3']:''}}">
                                        /
                                        <input type="text" style="float:right; width: 45%; text-align: center;" name="hasil[polio4]" value="{{isset($laporan['hasil']['polio4'])?$laporan['hasil']['polio4']:''}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td>d. Implant</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_aktif][Implant]" value="{{isset($laporan['target']['aseptor_aktif']['Implant'])?$laporan['target']['aseptor_aktif']['Implant']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_aktif][Implant]" value="{{isset($laporan['hasil']['aseptor_aktif']['Implant'])?$laporan['hasil']['aseptor_aktif']['Implant']:''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">6</td>
                                    <td>Campak</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[campak]" value="{{isset($laporan['target']['campak'])?$laporan['target']['campak']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[campak]" value="{{isset($laporan['hasil']['campak'])?$laporan['hasil']['campak']:''}}">
                                    </td>
                                    <td style="text-align: center;"></td>
                                    <td>e. Suntik</td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_aktif][Suntik]" value="{{isset($laporan['target']['aseptor_aktif']['Suntik'])?$laporan['target']['aseptor_aktif']['Suntik']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_aktif][Suntik]" value="{{isset($laporan['hasil']['aseptor_aktif']['Suntik'])?$laporan['hasil']['aseptor_aktif']['Suntik']:''}}">
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
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_aktif][Pil]" value="{{isset($laporan['target']['aseptor_aktif']['Pil'])?$laporan['target']['aseptor_aktif']['Pil']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_aktif][Pil]" value="{{isset($laporan['hasil']['aseptor_aktif']['Pil'])?$laporan['hasil']['aseptor_aktif']['Pil']:''}}">
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
                                        <input type="text" style="width: 100%; text-align: center;" name="target[aseptor_aktif][Kondom]" value="{{isset($laporan['target']['aseptor_aktif']['Kondom'])?$laporan['target']['aseptor_aktif']['Kondom']:''}}">
                                    </td>
                                    <td>
                                        <input type="text" style="width: 100%; text-align: center;" name="hasil[aseptor_aktif][Kondom]" value="{{isset($laporan['hasil']['aseptor_aktif']['Kondom'])?$laporan['hasil']['aseptor_aktif']['Kondom']:''}}">
                                    </td>

                                </tr>
                            </table>
                            <br>
                            <div class="form-group">
                                <label for="">
                                    2. Permasalahan
                                </label>
                                <br>
                                <textarea name="permasalahan" id="permasalahan" cols="30" rows="5" style="width: 100%;">{{isset($laporan['permasalahan'])?$laporan['permasalahan']:''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    2. Rencana Tingkat Lanjut
                                </label>
                                <br>
                                <textarea name="rencana" id="rencana" cols="30" rows="5" style="width: 100%;">{{isset($laporan['rencana'])?$laporan['rencana']:''}}</textarea>
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

                            <textarea name="keterangan" style="width: 100%;" cols="30" rows="7">{{isset($laporan['keterangan'])?$laporan['keterangan']:''}}</textarea>
                        </div>
                    </form>

                    <br>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $('#simpan').on('click', function() {
        $.post("{{url('laporan_bulanan')}}", $('form').serialize(), function(data, textStatus, jqXHR) {
            notif(data.status, data.message, "{{URL::current()}}")
        }, "JSON");
    })

    $('#dateyear').datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months"
    })

    $('#dateyear').on('change', function() {
        date = new Date($(this).val());
        month = date.getMonth() + 1;
        year = date.getFullYear();

        window.location.href = "{{url('laporan_bulanan')}}" + '/' + $('#posyandu_id').val() + '/' + year + '/' + month;
    })

    $('#posyandu_id').on('change', function() {
        date = new Date($('#dateyear').val());
        month = date.getMonth() + 1;
        year = date.getFullYear();

        window.location.href = "{{url('laporan_bulanan')}}" + '/' + $(this).val() + '/' + year + '/' + month;
    })
    $('#cetak').on('click', function() {
        date = new Date($('#dateyear').val());
        month = date.getMonth() + 1;
        year = date.getFullYear();
        window.open("{{url('print/laporan_bulanan/')}}" + '/' + $('#posyandu_id').val() + '/' + year + '/' + month);
    })
</script>
@endpush
@push('css')
<style>
    .ui-datepicker-calendar {
        display: none;
    }

    .ui-datepicker-month {
        display: none;
    }

    .ui-datepicker-prev {
        display: none;
    }

    .ui-datepicker-next {
        display: none;
    }
</style>
@endpush