@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Laporan Catatan Jumlah Ibu Hamil</h2>
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
                        <table style="font-size: 10pt; text-align: center; width: 100%;" border="1" cellpadding="8" cellspacing="0">
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
                                        ?>
                                        <textarea name="keterangan_laporan[{{$lp->id}}]" style="width: 100%; height: 100%;" maxlength="22">{{isset($keterangan->$id)?$keterangan->$id:''}}</textarea>
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
        $.post("{{url('laporan_catatan_bumil')}}", $('form').serialize(),
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
        window.location.href = "{{url('laporan_catatan_bumil')}}" + '/' + $('#posyandu_id').val() + '/' +
            $(this).val()
    })
    $('#posyandu_id').on('change', function() {
        window.location.href = "{{url('laporan_catatan_bumil')}}" + '/' + $(this).val() + '/' +
            $('#dateyear').val()
    })

    $('#cetak').on('click', function() {
        window.open("{{url('print/laporan_catatan_bumil/'.$id_posyandu.'/'.$tahun)}}")
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