@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Laporan PUS/WUS</h2>
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

                    <form action="#">
                        @csrf
                        <input type="hidden" name="tahun" value="{{$tahun}}">
                        <input type="hidden" name="posyandu_id" value="{{$id_posyandu}}">
                        <table style="font-size: 8pt; text-align: center;" border="1" cellpadding="8" cellspacing="0">
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
                                    <th rowspan="3">KET</th>
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
                    </form>
                    <br>
                    <!-- <button class="btn btn-sm btn-success" id="simpan">simpan</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $('#simpan').on('click', function() {
        $.post("{{url('laporan_puswus')}}", $('form').serialize(),
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
        window.location.href = "{{url('laporan_puswus')}}" + '/' + $('#posyandu_id').val() + '/' +
            $(this).val()
    })
    $('#posyandu_id').on('change', function() {
        window.location.href = "{{url('laporan_puswus')}}" + '/' + $(this).val() + '/' +
            $('#dateyear').val()
    })

    $('#cetak').on('click', function() {
        window.open("{{url('print/laporan_puswus/'.$id_posyandu.'/'.$tahun)}}");
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