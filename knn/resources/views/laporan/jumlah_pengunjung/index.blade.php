@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Laporan Jumlah Pengunjung</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
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
                            <h6 class="mt-3">Tampilkan Data Tahun : </h6>

                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" id="dateyear" class="form-control form-control-sm" style="background-color: #F3F3F3;" placeholder="Pilih Tahun" value="{{$tahun}}">
                                </div>
                                <div class="offset-sm-10 mt-3">
                                    <button id="cetak" class="btn btn-primary"><i class="mdi mdi-printer menu-icon"></i> Cetak Laporan</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                    $nama_bulan = [
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
                    ];
                    ?>
                    <form action="#">
                        @csrf
                        <input type="hidden" name="tahun" value="{{$tahun}}">
                        <input type="hidden" name="posyandu_id" value="{{$id_posyandu}}">
                        <table style="font-size: 8pt; text-align: center;" border="1" cellpadding="8" cellspacing="0">
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
                                    <td style="">{{$key + 1}}</td>
                                    <td style="">{{$nama_bulan[$key]}}</td>
                                    <td style="">{{isset($lp['bayi_baru'])?$lp['bayi_baru']['l']:0}}</td>
                                    <td style="">{{isset($lp['bayi_baru'])?$lp['bayi_baru']['p']:0}}</td>
                                    <td style="">{{isset($lp['bayi_lama'])?$lp['bayi_lama']['l']:0}}</td>
                                    <td style="">{{isset($lp['bayi_lama'])?$lp['bayi_lama']['p']:0}}</td>
                                    <td style="">{{isset($lp['balita_baru'])?$lp['balita_baru']['l']:0}}</td>
                                    <td style="">{{isset($lp['balita_baru'])?$lp['balita_baru']['p']:0}}</td>
                                    <td style="">{{isset($lp['balita_lama'])?$lp['balita_lama']['l']:0}}</td>
                                    <td style="">{{isset($lp['balita_lama'])?$lp['balita_lama']['p']:0}}</td>

                                    <td style="">{{isset($lp['wus'])?$lp['wus']:0}}</td>
                                    <td style="">{{isset($lp['pus'])?$lp['pus']:0}}</td>
                                    <td style="">{{isset($lp['bumil'])?$lp['bumil']:0}}</td>
                                    <td style="">{{isset($lp['menyusui'])?$lp['menyusui']:0}}</td>
                                    <td style="">
                                        <input type=" number" name="petugas[kader][l][{{$key}}]" style="width: 40px;" min="0" max="100" value="{{isset($lp['kader']['l'][$key])? $lp['kader']['l'][$key] : 0}}">
                                    </td>
                                    <td style="">
                                        <input type=" number" name="petugas[kader][p][{{$key}}]" style="width: 40px;" min="0" max="100" value="{{isset($lp['kader']['p'][$key])? $lp['kader']['p'][$key] : 0}}">
                                    </td>
                                    <td style="">
                                        <input type=" number" name="petugas[plkb][l][{{$key}}]" style="width: 40px;" min="0" max="100" value="{{isset($lp['plkb']['l'][$key])? $lp['plkb']['l'][$key] : 0}}">
                                    </td>
                                    <td style="">
                                        <input type=" number" name="petugas[plkb][p][{{$key}}]" style="width: 40px;" min="0" max="100" value="{{isset($lp['plkb']['p'][$key])? $lp['plkb']['p'][$key] : 0}}">
                                    </td>
                                    <td style="">
                                        <input type=" number" name="petugas[medis][l][{{$key}}]" style="width: 40px;" min="0" max="100" value="{{isset($lp['medis']['l'][$key])? $lp['medis']['l'][$key] : 0}}">
                                    </td>
                                    <td style="">
                                        <input type=" number" name="petugas[medis][p][{{$key}}]" style="width: 40px;" min="0" max="100" value="{{isset($lp['medis']['p'][$key])? $lp['medis']['p'][$key] : 0}}">
                                    </td>

                                    <td style="">{{isset($lp['bayi_lahir'])?$lp['bayi_lahir']['l']:0}}</td>
                                    <td style="">{{isset($lp['bayi_lahir'])?$lp['bayi_lahir']['p']:0}}</td>
                                    <td style="">{{isset($lp['bayi_meninggal'])?$lp['bayi_meninggal']['l']:0}}</td>
                                    <td style="">{{isset($lp['bayi_meninggal'])?$lp['bayi_meninggal']['p']:0}}</td>
                                    <?php
                                    $ket = $nama_bulan[$key];
                                    ?>
                                    <td style="height: 50px; font-size: 7pt; max-height: 50px;">
                                        <textarea name="keterangan_laporan[{{$nama_bulan[$key]}}]" style="width: 100%; height: 100%;" maxlength="22">{{isset($lp['keterangan']->$ket)?$lp['keterangan']->$ket:''}}</textarea>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    <br>
                    <button class="btn btn-sm btn-success" id="simpan">simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $('#simpan').on('click', function() {
        $.post("{{url('laporan_jumlah_pengunjung')}}", $('form').serialize(),
            function(data, textStatus, jqXHR) {
                notif(data.status, data.message, "{{URL::current()}}")
            },
            "JSON"
        );
    })

    $('#dateyear').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    })

    $('#dateyear').on('change', function() {
        window.location.href = "{{url('laporan_jumlah_pengunjung')}}" + '/' + $('#posyandu_id').val() + '/' +
            $(this).val()
    })
    $('#posyandu_id').on('change', function() {
        window.location.href = "{{url('laporan_jumlah_pengunjung')}}" + '/' + $(this).val() + '/' +
            $('#dateyear').val()
    })

    $('#cetak').on('click', function() {
        window.open("{{url('print/laporan_jumlah_pengunjung/'.$id_posyandu.'/'.$tahun)}}");
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