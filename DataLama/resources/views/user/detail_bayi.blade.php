@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Detail Data Ibu Hamil</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analisis</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/bayi')}}" class="btn btn-primary btn-sm mt-3"> Kembali </a>
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Bayi</h4>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card" style="min-width: 550px;">
                                                <div class="card-body dashboard-tabs p-0">
                                                    <ul class="nav nav-tabs px-4" role="tablist" style="background-color: #f3f3f3;">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Data Pasien</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Pemberian Tablet dan Imunisasi</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="timbang-tab" data-toggle="tab" href="#timbang" role="tab" aria-controls="timbang" aria-selected="false">Hasil Timbang Bulanan</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="kurva-tab" data-toggle="tab" href="#kurva" role="tab" aria-controls="kurva" aria-selected="false">Grafik KMS</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content py-0 px-0">
                                                        <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md-6 stretch-card" style="padding: 20px;">
                                                                        <table class="table table-sm table-bordered">
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Registrasi
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Posyandu</td>
                                                                                <td>@php
                                                                                    $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where id = '.$bayi->posyandu_id));
                                                                                    @endphp
                                                                                    {{$posyandu[0]->nama}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Nama Bayi</td>
                                                                                <td>{{$bayi->nama}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Tanggal Lahir</td>
                                                                                <td>{{$bayi->tanggal_lahir}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Nama Orang Tua</td>
                                                                                <td>{{$bayi->nama_ibu}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Jenis Kelamin</td>
                                                                                <td>{{$bayi->l_p == 1 ? 'Laki-laki' : 'Perempuan'}}</td>
                                                                            </tr>

                                                                        </table>


                                                                    </div>
                                                                    <div class="col-md-6 mt-4">
                                                                        <table class="table table-sm table-bordered" style="padding: 20px;">
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Detail bayi
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Bayi Meninggal</td>
                                                                                <td>
                                                                                    {{$bayi->bayi_meninggal}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Keterangan</td>
                                                                                <td>
                                                                                    {{$bayi->keterangan}}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="card col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">Sirup FE</h4>
                                                                            <table class="table table-sm table-bordered text-center">

                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tahun Ke
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 1
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 2
                                                                                    </td>
                                                                                </tr>

                                                                                @if(count($sirup_fe) > 0)
                                                                                @foreach($sirup_fe as $key=>$b)
                                                                                <tr>
                                                                                    <td style="padding: 14px;">{{$b['tahun_ke']}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_1'] != '' ? $b['bulan_ke_1'] : '-'}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_2'] != '' ? $b['bulan_ke_2'] : '-'}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @endif

                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="card col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">Vitamin A</h4>
                                                                            <table class="table table-sm table-bordered text-center">

                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tahun Ke
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 1
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 2
                                                                                    </td>
                                                                                </tr>
                                                                                @if(count($vit_a) > 0)
                                                                                @foreach($vit_a as $key=>$b)
                                                                                <tr>
                                                                                    <td style="padding: 14px;">{{$b['tahun_ke']}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_1'] != '' ? $b['bulan_ke_1'] : '-'}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_2'] != '' ? $b['bulan_ke_2'] : '-'}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @endif

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">Oralit BLN</h4>
                                                                            <table class=" table table-sm table-bordered text-center">

                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;" class="text-center">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tahun Ke
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tanggal
                                                                                    </td>
                                                                                </tr>
                                                                                @if(count($oralit) > 0)
                                                                                @foreach($oralit as $key=>$b)
                                                                                <tr>
                                                                                    <td style="padding: 14px;">{{$b['tahun_ke']}}</td>
                                                                                    <td style="padding: 14px;">{{$b['tanggal'] != '' ? $b['tanggal'] : '-'}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @endif

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="card col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">HB-O</h4>
                                                                            <table class="table table-sm table-bordered text-center">

                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tahun Ke
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tanggal
                                                                                    </td>
                                                                                </tr>

                                                                                @if(count($hbo) > 0)
                                                                                @foreach($hbo as $key=>$b)
                                                                                <tr>
                                                                                    <td style="padding: 14px;">{{$b['tahun_ke']}}</td>
                                                                                    <td style="padding: 14px;">{{$b['tanggal'] != '' ? $b['tanggal'] : '-'}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @endif

                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="card col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">BCG</h4>
                                                                            <table class="table table-sm table-bordered text-center">

                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tahun Ke
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tanggal
                                                                                    </td>
                                                                                </tr>

                                                                                @if(count($bcg) > 0)
                                                                                @foreach($bcg as $key=>$b)
                                                                                <tr>
                                                                                    <td style="padding: 14px;">{{$b['tahun_ke']}}</td>
                                                                                    <td style="padding: 14px;">{{$b['tanggal'] != '' ? $b['tanggal'] : '-'}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @endif

                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="card col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">DPT-HB</h4>
                                                                            <table class="table table-sm table-bordered text-center">

                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tahun Ke
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 1
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 2
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 3
                                                                                    </td>
                                                                                </tr>
                                                                                @if(count($dpthb) > 0)
                                                                                @foreach($dpthb as $key=>$b)
                                                                                <tr>
                                                                                    <td style="padding: 14px;">{{$b['tahun_ke']}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_1'] != '' ? $b['bulan_ke_1'] : '-'}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_2'] != '' ? $b['bulan_ke_2'] : '-'}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_3'] != '' ? $b['bulan_ke_3'] : '-'}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @endif

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">POLIO</h4>
                                                                            <table class="table table-sm table-bordered text-center">

                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tahun Ke
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 1
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 2
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 3
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Bulan Ke 4
                                                                                    </td>
                                                                                </tr>
                                                                                @if(count($polio) > 0)
                                                                                @foreach($polio as $key=>$b)
                                                                                <tr>
                                                                                    <td style="padding: 14px;">{{$b['tahun_ke']}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_1'] != '' ? $b['bulan_ke_1'] : '-'}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_2'] != '' ? $b['bulan_ke_2'] : '-'}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_3'] != '' ? $b['bulan_ke_3'] : '-'}}</td>
                                                                                    <td style="padding: 14px;">{{$b['bulan_ke_4'] != '' ? $b['bulan_ke_4'] : '-'}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @endif

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="card-body">
                                                                            <h4 class="card-title">CAMPAK</h4>
                                                                            <table class="table table-sm table-bordered text-center">
                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;">
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Status Pemberian
                                                                                    </td>
                                                                                    <td style="font-weight: bold; padding: 14px;">
                                                                                        Tanggal
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    @if($bayi->campak != '')
                                                                                    <td style="padding: 14px;">Telah Diberikan</td>
                                                                                    <td>
                                                                                        {{$bayi->campak}}
                                                                                    </td>
                                                                                    @else
                                                                                    <td>-</td>
                                                                                    <td>-</td>
                                                                                    @endif
                                                                                </tr>

                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="timbang" role="tabpanel" aria-labelledby="timbang-tab">
                                                            <div class="col-md-12" style="padding: 20px;">
                                                                <table class="table table-bordered table-stripped table text-center" id="tableTimbang">

                                                                    <tr style="background-color: #f3f3f3; font-weight: bold;" class="text-center">

                                                                        <td width="5%;" style="font-weight: bold; padding: 14px;">
                                                                            Bulan Ke
                                                                        </td>
                                                                        <td width="10%;" style="font-weight: bold; padding: 14px;">
                                                                            Bulan
                                                                        </td>
                                                                        <td style="font-weight: bold; padding: 14px;">
                                                                            Umur
                                                                        </td>
                                                                        <td style="font-weight: bold; padding: 14px;">
                                                                            Berat Badan
                                                                        </td>
                                                                        <td style="font-weight: bold; padding: 14px;">
                                                                            Panjang/Tinggi Badan
                                                                        </td>
                                                                    </tr>

                                                                    @foreach($bayi_timbang as $key=>$b)
                                                                    <tr>

                                                                        <td>
                                                                            {{$b->bulan_ke}}
                                                                        </td>
                                                                        <td>
                                                                            {{$b->bulan}}
                                                                        </td>
                                                                        <td>
                                                                            {{$b->umur_bulan}} bulan, {{$b->umur_hari}} hari
                                                                        </td>
                                                                        <td>
                                                                            <table class="table table-sm text-sm">
                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;" class="text-center">
                                                                                    <td>BB</td>
                                                                                    <td>Z-score BB/U</td>
                                                                                    <td>Kategori BB/U</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    @if($b->sd_bb == '-3')
                                                                                    @php
                                                                                    $badgeColor = 'danger';
                                                                                    @endphp
                                                                                    @elseif($b->sd_bb == '-2')
                                                                                    @php
                                                                                    $badgeColor = 'warning';
                                                                                    @endphp
                                                                                    @else
                                                                                    @php
                                                                                    $badgeColor = 'success';
                                                                                    @endphp
                                                                                    @endif
                                                                                    <td> <span class="badge badge-pill badge-{{$badgeColor}}">{{$b->berat_badan}}</span></td>
                                                                                    <td>
                                                                                        <span class="badge badge-pill badge-{{$badgeColor}}">{{$b->sd_bb}}</span></td>
                                                                                    <td>
                                                                                        <span class="badge badge-pill badge-{{$badgeColor}}">{{$b->status_bb}}</span></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table table-sm">
                                                                                <tr style="background-color: #f3f3f3; font-weight: bold;" class="text-center">
                                                                                    <td>PB/TB</td>
                                                                                    <td>Z-score PB/U - TB/U</td>
                                                                                    <td>Kategori PB/U - TB/U</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    @if($b->sd_pb == '-3')
                                                                                    @php
                                                                                    $badgeColor = 'danger';
                                                                                    @endphp
                                                                                    @elseif($b->sd_pb == '-2')
                                                                                    @php
                                                                                    $badgeColor = 'warning';
                                                                                    @endphp
                                                                                    @else
                                                                                    @php
                                                                                    $badgeColor = 'success';
                                                                                    @endphp
                                                                                    @endif
                                                                                    <td> <span class="badge badge-pill badge-{{$badgeColor}}">{{$b->tinggi_badan}}</span></td>
                                                                                    <td>
                                                                                        <span class="badge badge-pill badge-{{$badgeColor}}">{{$b->sd_pb}}</span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <span class="badge badge-pill badge-{{$badgeColor}}">
                                                                                            {{$b->status_pb}}</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" role="tabpanel" id="kurva" aria-labelledby="kurva-tab">
                                                            <div class="col-lg-12 grid-margin stretch-card">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Berat Badan 0-24 Bulan</h4>
                                                                        <canvas id="bb_1"></canvas>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 grid-margin stretch-card">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Berat Badan 24-60 Bulan</h4>
                                                                        <canvas id="bb_2"></canvas>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 grid-margin stretch-card">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Panjang Badan 0-24 Bulan</h4>
                                                                        <canvas id="pb_1"></canvas>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 grid-margin stretch-card">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Tinggi Badan 24-60 Bulan</h4>
                                                                        <canvas id="pb_2"></canvas>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Detail Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white;">
                <table class="table" id="tableModal">
                    <thead>
                        <tr id="detailDataTitle">

                        </tr>
                    </thead>
                    <tbody>
                        <tr id="detailDataPush">

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
    var bayi_timbang = JSON.parse('@json($bayi_timbang)');
    var bb = JSON.parse('@json($antropometri_bb)');

    var median_bb_1 = [];
    var umur_bb_1 = [];
    var plus1_bb_1 = [];
    var plus2_bb_1 = [];
    var plus3_bb_1 = [];
    var min1_bb_1 = [];
    var min2_bb_1 = [];
    var min3_bb_1 = [];


    var median_bb_2 = [];
    var umur_bb_2 = [];
    var plus1_bb_2 = [];
    var plus2_bb_2 = [];
    var plus3_bb_2 = [];
    var min1_bb_2 = [];
    var min2_bb_2 = [];
    var min3_bb_2 = [];



    $.each(bb, function(i, val) {
        if (i <= 24) {
            median_bb_1.push(val.median);
            plus1_bb_1.push(val.plus1);
            plus2_bb_1.push(val.plus2);
            plus3_bb_1.push(val.plus3);
            min1_bb_1.push(val.min1);
            min2_bb_1.push(val.min2);
            min3_bb_1.push(val.min3);
            umur_bb_1.push(val.umur);
        }
        if (i >= 24) {

            median_bb_2.push(val.median);
            plus1_bb_2.push(val.plus1);
            plus2_bb_2.push(val.plus2);
            plus3_bb_2.push(val.plus3);
            min1_bb_2.push(val.min1);
            min2_bb_2.push(val.min2);
            min3_bb_2.push(val.min3);
            umur_bb_2.push(val.umur);

        }

    })

    bayi_bb_1 = [];
    bayi_bb_2 = [];
    $.each(bayi_timbang, function(i, val) {
        if (val.umur_bulan <= 24) {
            bayi_bb_1[val.umur_bulan] = {
                x: parseInt(val.umur_bulan),
                y: parseInt(val.berat_badan),
                r: 7
            };
        } else {
            bayi_bb_2[val.umur_bulan] = {
                x: parseInt(val.umur_bulan),
                y: parseInt(val.berat_badan),
                r: 7
            };
        }

    })


    var data_bb_1 = [{
            label: 'Berat Badan',
            data: bayi_bb_1,
            type: 'bubble',
            order: 1,
            backgroundColor: "lightblue",
            borderColor: "blue",
            borderWidth: 1,
            fill: true
        }, {
            label: 'Standar Deviasi: Normal',
            data: median_bb_1,
            order: 1,
            pointStyle: 'triangle',
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: false,
            responsive: true,
        }, {
            label: 'Standar Deviasi + 1',
            order: 2,
            data: plus1_bb_1,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(0, 102, 15, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi - 1',
            order: 2,
            pointStyle: 'triangle',
            data: min1_bb_1,
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi + 2',
            data: plus2_bb_1,
            order: 3,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi - 2',
            data: min2_bb_1,
            pointStyle: 'triangle',
            order: 3,
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi + 3',
            data: plus3_bb_1,
            order: 4,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-3',
            responsive: true
        }, {
            label: 'Standar Deviasi - 3',
            data: min3_bb_1,
            pointStyle: 'triangle',
            order: 4,
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(192,0,0, 1)',
            borderWidth: 2,
            fill: '-3',
            responsive: true,
            order: 3
        },

    ];


    var ctx = document.getElementById('bb_1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: umur_bb_1,
            datasets: data_bb_1
        },
        options: {
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });

    // BB 2


    console.log(bayi_bb_2)

    var data_bb_2 = [{
            label: 'Berat Badan',
            data: bayi_bb_2,
            type: 'bubble',
            order: 1,
            backgroundColor: "lightblue",
            borderColor: "blue",
            borderWidth: 1,
            fill: true
        }, {
            label: 'Standar Deviasi: Normal',
            data: median_bb_2,
            order: 1,
            pointStyle: 'triangle',
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: false,
            responsive: true,
        }, {
            label: 'Standar Deviasi + 1',
            order: 2,
            data: plus1_bb_2,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(0, 102, 15, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi + 2',
            data: plus2_bb_2,
            order: 3,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi + 3',
            data: plus3_bb_2,
            order: 4,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-3',
            responsive: true
        }, {
            label: 'Standar Deviasi - 1',
            order: 2,
            pointStyle: 'triangle',
            data: min1_bb_2,
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi - 2',
            data: min2_bb_2,
            pointStyle: 'triangle',
            order: 3,
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi - 3',
            data: min3_bb_2,
            pointStyle: 'triangle',
            order: 4,
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(192,0,0, 1)',
            borderWidth: 2,
            fill: '-3',
            responsive: true,
            order: 3
        },

    ];
    var bb2 = document.getElementById('bb_2').getContext('2d');
    var myChart = new Chart(bb2, {
        type: 'line',
        data: {
            labels: umur_bb_2,
            datasets: data_bb_2
        },
        options: {
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });


    // =============PANJANG BADAN ====================

    var pb = JSON.parse('@json($antropometri_pb)');


    var median_pb_1 = [];
    var umur_pb_1 = [];
    var plus1_pb_1 = [];
    var plus2_pb_1 = [];
    var plus3_pb_1 = [];
    var min1_pb_1 = [];
    var min2_pb_1 = [];
    var min3_pb_1 = [];


    var median_pb_2 = [];
    var umur_pb_2 = [];
    var plus1_pb_2 = [];
    var plus2_pb_2 = [];
    var plus3_pb_2 = [];
    var min1_pb_2 = [];
    var min2_pb_2 = [];
    var min3_pb_2 = [];



    $.each(pb, function(i, val) {
        if (i <= 24) {
            median_pb_1.push(val.median);
            plus1_pb_1.push(val.plus1);
            plus2_pb_1.push(val.plus2);
            plus3_pb_1.push(val.plus3);
            min1_pb_1.push(val.min1);
            min2_pb_1.push(val.min2);
            min3_pb_1.push(val.min3);
            umur_pb_1.push(val.umur);
        }
        if (i > 24) {

            median_pb_2.push(val.median);
            plus1_pb_2.push(val.plus1);
            plus2_pb_2.push(val.plus2);
            plus3_pb_2.push(val.plus3);
            min1_pb_2.push(val.min1);
            min2_pb_2.push(val.min2);
            min3_pb_2.push(val.min3);
            umur_pb_2.push(val.umur);

        }

    })

    bayi_pb_1 = [];
    bayi_pb_2 = [];
    $.each(bayi_timbang, function(i, val) {
        if (val.umur_bulan <= 24) {
            bayi_pb_1[val.umur_bulan] = {
                x: parseInt(val.umur_bulan),
                y: parseInt(val.tinggi_badan),
                r: 7
            };
        } else {
            bayi_pb_2[val.umur_bulan] = {
                x: parseInt(val.umur_bulan),
                y: parseInt(val.tinggi_badan),
                r: 7
            };
        }

    })


    var data_pb_1 = [{
            label: 'Panjang Badan',
            data: bayi_pb_1,
            type: 'bubble',
            order: 1,
            backgroundColor: "lightblue",
            borderColor: "blue",
            borderWidth: 1,
            fill: true
        }, {
            label: 'Standar Deviasi: Normal',
            data: median_pb_1,
            order: 1,
            pointStyle: 'triangle',
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: false,
            responsive: true,
        }, {
            label: 'Standar Deviasi + 1',
            order: 2,
            data: plus1_pb_1,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(0, 102, 15, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi + 2',
            data: plus2_pb_1,
            order: 3,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi + 3',
            data: plus3_pb_1,
            order: 4,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-3',
            responsive: true
        }, {
            label: 'Standar Deviasi - 1',
            order: 2,
            pointStyle: 'triangle',
            data: min1_pb_1,
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi - 2',
            data: min2_pb_1,
            pointStyle: 'triangle',
            order: 3,
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi - 3',
            data: min3_pb_1,
            pointStyle: 'triangle',
            order: 4,
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(192,0,0, 1)',
            borderWidth: 2,
            fill: '-3',
            responsive: true,
            order: 3
        },

    ];


    var pb_1 = document.getElementById('pb_1').getContext('2d');
    var myChart = new Chart(pb_1, {
        type: 'line',
        data: {
            labels: umur_pb_1,
            datasets: data_pb_1
        },
        options: {
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });

    // pb 2


    console.log(bayi_pb_2)

    var data_pb_2 = [{
            label: 'Tinggi Badan',
            data: bayi_pb_2,
            type: 'bubble',
            order: 1,
            backgroundColor: "lightblue",
            borderColor: "blue",
            borderWidth: 1,
            fill: true
        }, {
            label: 'Standar Deviasi: Normal',
            data: median_pb_2,
            order: 1,
            pointStyle: 'triangle',
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: false,
            responsive: true,
        }, {
            label: 'Standar Deviasi + 1',
            order: 2,
            data: plus1_pb_2,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(0, 102, 15, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi + 2',
            data: plus2_pb_2,
            order: 3,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi + 3',
            data: plus3_pb_2,
            order: 4,
            pointStyle: 'triangle',
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-3',
            responsive: true
        }, {
            label: 'Standar Deviasi - 1',
            order: 2,
            pointStyle: 'triangle',
            data: min1_pb_2,
            backgroundColor: [
                'rgba(0, 102, 15, 1)'
            ],
            borderColor: [
                'rgba(0, 0, 0, 1)'
            ],
            borderWidth: 1,
            fill: '-1',
            responsive: true
        }, {
            label: 'Standar Deviasi - 2',
            data: min2_pb_2,
            pointStyle: 'triangle',
            order: 3,
            backgroundColor: 'rgba(6, 201, 35, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1,
            fill: '-2',
            responsive: true
        }, {
            label: 'Standar Deviasi - 3',
            data: min3_pb_2,
            pointStyle: 'triangle',
            order: 4,
            backgroundColor: 'rgba(250, 196, 0, 1)',
            borderColor: 'rgba(192,0,0, 1)',
            borderWidth: 2,
            fill: '-3',
            responsive: true,
            order: 3
        },

    ];
    var pb_2 = document.getElementById('pb_2').getContext('2d');
    var myChart = new Chart(pb_2, {
        type: 'line',
        data: {
            labels: umur_pb_2,
            datasets: data_pb_2
        },
        options: {
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
</script>

@endpush