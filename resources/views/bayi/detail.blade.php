@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap page-header-modern">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2 class="page-title-modern">Detail Data Ibu Hamil</h2>
                        <p class="mb-md-0 text-muted">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex breadcrumb-modern">
                        <i class="mdi mdi-home text-muted"></i>
                        <p class="text-muted mb-0">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 font-weight-bold">Analisis</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/bayi')}}" class="btn btn-primary btn-modern btn-sm mt-2 mt-xl-0">
                            <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card card-modern">
                <div class="card-body">
                    <h4 class="section-title-modern">Data Bayi</h4>

                    <div class="card card-modern-inner" style="min-width: 550px;">
                        <div class="card-body dashboard-tabs p-0">
                            <ul class="nav nav-tabs nav-tabs-modern px-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                                        <i class="mdi mdi-account-details mr-1"></i>Data Pasien
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">
                                        <i class="mdi mdi-needle mr-1"></i>Pemberian Tablet dan Imunisasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="timbang-tab" data-toggle="tab" href="#timbang" role="tab" aria-controls="timbang" aria-selected="false">
                                        <i class="mdi mdi-scale-bathroom mr-1"></i>Hasil Timbang Bulanan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="kurva-tab" data-toggle="tab" href="#kurva" role="tab" aria-controls="kurva" aria-selected="false">
                                        <i class="mdi mdi-chart-line mr-1"></i>Grafik KMS
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content py-0 px-0">

                                {{-- =============== TAB: DATA PASIEN =============== --}}
                                <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="container-fluid" style="padding: 22px;">
                                        <div class="row">
                                            <div class="col-md-6 mb-4 mb-md-0">
                                                <p class="detail-block-title"><i class="mdi mdi-clipboard-text-outline mr-1"></i>Registrasi</p>
                                                @php
                                                $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where id = '.$bayi->posyandu_id));
                                                @endphp
                                                <div class="regis-detail-grid">
                                                    <div class="regis-detail-item">
                                                        <span class="regis-detail-label"><i class="mdi mdi-hospital-building mr-1"></i>Posyandu</span>
                                                        <span class="regis-detail-value">{{$posyandu[0]->nama}}</span>
                                                    </div>
                                                    <div class="regis-detail-item">
                                                        <span class="regis-detail-label"><i class="mdi mdi-baby-face-outline mr-1"></i>Nama Bayi</span>
                                                        <span class="regis-detail-value">{{$bayi->nama}}</span>
                                                    </div>
                                                    <div class="regis-detail-item">
                                                        <span class="regis-detail-label"><i class="mdi mdi-calendar-outline mr-1"></i>Tanggal Lahir</span>
                                                        <span class="regis-detail-value">{{$bayi->tanggal_lahir}}</span>
                                                    </div>
                                                    <div class="regis-detail-item">
                                                        <span class="regis-detail-label"><i class="mdi mdi-human-male-female mr-1"></i>Jenis Kelamin</span>
                                                        @if($bayi->l_p == 1)
                                                        <span class="badge badge-pill badge-gender badge-gender-boy">
                                                            <i class="mdi mdi-gender-male mr-1"></i> Laki-laki
                                                        </span>
                                                        @else
                                                        <span class="badge badge-pill badge-gender badge-gender-girl">
                                                            <i class="mdi mdi-gender-female mr-1"></i> Perempuan
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="regis-detail-item regis-detail-item-full">
                                                        <span class="regis-detail-label"><i class="mdi mdi-account-heart-outline mr-1"></i>Nama Orang Tua</span>
                                                        <span class="regis-detail-value">{{$bayi->nama_ibu}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="detail-block-title"><i class="mdi mdi-file-document-outline mr-1"></i>Detail Bayi</p>
                                                <div class="regis-detail-grid">
                                                    <div class="regis-detail-item">
                                                        <span class="regis-detail-label"><i class="mdi mdi-emoticon-sad-outline mr-1"></i>Bayi Meninggal</span>
                                                        <span class="regis-detail-value">{{$bayi->bayi_meninggal ?: '-'}}</span>
                                                    </div>
                                                    <div class="regis-detail-item">
                                                        <span class="regis-detail-label"><i class="mdi mdi-note-text-outline mr-1"></i>Keterangan</span>
                                                        <span class="regis-detail-value">{{$bayi->keterangan ?: '-'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- =============== TAB: PEMBERIAN TABLET DAN IMUNISASI =============== --}}
                                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                    <div class="container-fluid" style="padding: 22px;">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-tint mr-1"></i>Sirup FE</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tahun Ke</th>
                                                                        <th>Bulan Ke 1</th>
                                                                        <th>Bulan Ke 2</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($sirup_fe) > 0)
                                                                    @foreach($sirup_fe as $key=>$b)
                                                                    <tr>
                                                                        <td>{{$b['tahun_ke']}}</td>
                                                                        <td>{{$b['bulan_ke_1'] != '' ? $b['bulan_ke_1'] : '-'}}</td>
                                                                        <td>{{$b['bulan_ke_2'] != '' ? $b['bulan_ke_2'] : '-'}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-pill mr-1"></i>Vitamin A</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tahun Ke</th>
                                                                        <th>Bulan Ke 1</th>
                                                                        <th>Bulan Ke 2</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($vit_a) > 0)
                                                                    @foreach($vit_a as $key=>$b)
                                                                    <tr>
                                                                        <td>{{$b['tahun_ke']}}</td>
                                                                        <td>{{$b['bulan_ke_1'] != '' ? $b['bulan_ke_1'] : '-'}}</td>
                                                                        <td>{{$b['bulan_ke_2'] != '' ? $b['bulan_ke_2'] : '-'}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-cup-water mr-1"></i>Oralit BLN</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tahun Ke</th>
                                                                        <th>Tanggal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($oralit) > 0)
                                                                    @foreach($oralit as $key=>$b)
                                                                    <tr>
                                                                        <td>{{$b['tahun_ke']}}</td>
                                                                        <td>{{$b['tanggal'] != '' ? $b['tanggal'] : '-'}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-needle mr-1"></i>HB-O</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tahun Ke</th>
                                                                        <th>Tanggal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($hbo) > 0)
                                                                    @foreach($hbo as $key=>$b)
                                                                    <tr>
                                                                        <td>{{$b['tahun_ke']}}</td>
                                                                        <td>{{$b['tanggal'] != '' ? $b['tanggal'] : '-'}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-needle mr-1"></i>BCG</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tahun Ke</th>
                                                                        <th>Tanggal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($bcg) > 0)
                                                                    @foreach($bcg as $key=>$b)
                                                                    <tr>
                                                                        <td>{{$b['tahun_ke']}}</td>
                                                                        <td>{{$b['tanggal'] != '' ? $b['tanggal'] : '-'}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-needle mr-1"></i>DPT-HB</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tahun Ke</th>
                                                                        <th>Bulan Ke 1</th>
                                                                        <th>Bulan Ke 2</th>
                                                                        <th>Bulan Ke 3</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($dpthb) > 0)
                                                                    @foreach($dpthb as $key=>$b)
                                                                    <tr>
                                                                        <td>{{$b['tahun_ke']}}</td>
                                                                        <td>{{$b['bulan_ke_1'] != '' ? $b['bulan_ke_1'] : '-'}}</td>
                                                                        <td>{{$b['bulan_ke_2'] != '' ? $b['bulan_ke_2'] : '-'}}</td>
                                                                        <td>{{$b['bulan_ke_3'] != '' ? $b['bulan_ke_3'] : '-'}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-needle mr-1"></i>POLIO</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tahun Ke</th>
                                                                        <th>Bulan Ke 1</th>
                                                                        <th>Bulan Ke 2</th>
                                                                        <th>Bulan Ke 3</th>
                                                                        <th>Bulan Ke 4</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($polio) > 0)
                                                                    @foreach($polio as $key=>$b)
                                                                    <tr>
                                                                        <td>{{$b['tahun_ke']}}</td>
                                                                        <td>{{isset($b['bulan_ke_1'])? $b['bulan_ke_1'] : '-'}}</td>
                                                                        <td>{{isset($b['bulan_ke_2'])? $b['bulan_ke_2'] : '-'}}</td>
                                                                        <td>{{isset($b['bulan_ke_3'])? $b['bulan_ke_3'] : '-'}}</td>
                                                                        <td>{{isset($b['bulan_ke_4'])? $b['bulan_ke_4'] : '-'}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 mb-4">
                                                <div class="card card-modern-inner h-100">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title"><i class="mdi mdi-needle mr-1"></i>CAMPAK</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-modern-mini text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Status Pemberian</th>
                                                                        <th>Tanggal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @if($bayi->campak != '')
                                                                        <td>Telah Diberikan</td>
                                                                        <td>{{$bayi->campak}}</td>
                                                                        @else
                                                                        <td>-</td>
                                                                        <td>-</td>
                                                                        @endif
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- =============== TAB: HASIL TIMBANG BULANAN =============== --}}
                                <div class="tab-pane fade" id="timbang" role="tabpanel" aria-labelledby="timbang-tab">
                                    <div class="container-fluid" style="padding: 22px;">
                                        <div class="table-responsive">
                                            <table class="table table-modern text-center" id="tableTimbang">
                                                <thead>
                                                    <tr>
                                                        <th width="5%;">Bulan Ke</th>
                                                        <th width="10%;">Bulan</th>
                                                        <th>Umur</th>
                                                        <th>Berat Badan</th>
                                                        <th>Panjang/Tinggi Badan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($bayi_timbang as $key=>$b)
                                                    <tr>
                                                        <td><span class="badge badge-pill badge-light">{{$b->bulan_ke}}</span></td>
                                                        <td><span class="badge badge-pill badge-light">{{$b->bulan}}</span></td>
                                                        <td><span class="badge badge-pill badge-light">{{$b->umur_bulan}} bulan, {{$b->umur_hari}} hari</span></td>
                                                        <td>
                                                            <table class="table table-mini-modern text-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>BB</th>
                                                                        <th>Z-score BB/U</th>
                                                                        <th>Kategori BB/U</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @if($b->sd_bb == '-3')
                                                                        @php $badgeColor = 'danger'; @endphp
                                                                        @elseif($b->sd_bb == '-2')
                                                                        @php $badgeColor = 'warning'; @endphp
                                                                        @else
                                                                        @php $badgeColor = 'success'; @endphp
                                                                        @endif
                                                                        <td><span class="badge badge-pill badge-{{$badgeColor}}">{{$b->berat_badan}}</span></td>
                                                                        <td><span class="badge badge-pill badge-{{$badgeColor}}">{{$b->sd_bb}}</span></td>
                                                                        <td><span class="badge badge-pill badge-{{$badgeColor}}">{{$b->status_bb}}</span></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <table class="table table-mini-modern text-center mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>PB/TB</th>
                                                                        <th>Z-score PB/U - TB/U</th>
                                                                        <th>Kategori PB/U - TB/U</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        @if($b->sd_pb == '-3')
                                                                        @php $badgeColor = 'danger'; @endphp
                                                                        @elseif($b->sd_pb == '-2')
                                                                        @php $badgeColor = 'warning'; @endphp
                                                                        @else
                                                                        @php $badgeColor = 'success'; @endphp
                                                                        @endif
                                                                        <td><span class="badge badge-pill badge-{{$badgeColor}}">{{$b->tinggi_badan}}</span></td>
                                                                        <td><span class="badge badge-pill badge-{{$badgeColor}}">{{$b->sd_pb}}</span></td>
                                                                        <td><span class="badge badge-pill badge-{{$badgeColor}}">{{$b->status_pb}}</span></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {{-- =============== TAB: GRAFIK KMS (unchanged chart logic) =============== --}}
                                <div class="tab-pane fade grafik-kms-gender {{ $bayi->l_p == 1 ? 'grafik-kms-boy' : 'grafik-kms-girl' }}" role="tabpanel" id="kurva" aria-labelledby="kurva-tab">
                                    <div class="container-fluid" style="padding: 22px;">
                                        <div class="row">
                                            <div class="col-lg-12 grid-margin stretch-card">
                                                <div class="card card-modern-inner">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title">Berat Badan 0-24 Bulan</h4>
                                                        <div class="kms-chart-box"><canvas id="bb_1"></canvas></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 grid-margin stretch-card">
                                                <div class="card card-modern-inner">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title">Berat Badan 24-60 Bulan</h4>
                                                        <div class="kms-chart-box"><canvas id="bb_2"></canvas></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 grid-margin stretch-card">
                                                <div class="card card-modern-inner">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title">Panjang Badan 0-24 Bulan</h4>
                                                        <div class="kms-chart-box"><canvas id="pb_1"></canvas></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 grid-margin stretch-card">
                                                <div class="card card-modern-inner">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title">Tinggi Badan 24-60 Bulan</h4>
                                                        <div class="kms-chart-box"><canvas id="pb_2"></canvas></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 grid-margin stretch-card">
                                                <div class="card card-modern-inner">
                                                    <div class="card-body">
                                                        <h4 class="card-title imunisasi-title">Berat Badan Menurut Panjang Badan 0-24 Bulan</h4>
                                                        <div class="kms-chart-box mb-4"><canvas id="bb_pb_1"></canvas></div>
                                                        <h4 class="card-title imunisasi-title">Berat Badan Menurut Tinggi Badan 24-60 Bulan</h4>
                                                        <div class="kms-chart-box"><canvas id="bb_pb_2"></canvas><p class="text-muted text-center mt-5 d-none" id="bb_pb_2_empty">Data BB/TB belum tersedia di tabel bpb.</p></div>
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
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-dark">
                <h6 class="modal-title" id="exampleModalLongTitle">Detail Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-modern" id="tableModal">
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

@push('css')
<style>
    /* ---------- Header ---------- */
    .page-title-modern {
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #1a2333;
        margin-bottom: 2px;
    }

    .breadcrumb-modern {
        opacity: 0.85;
        font-size: 0.85rem;
    }

    .btn-modern {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.55rem 1.1rem;
        box-shadow: 0 4px 10px rgba(66, 103, 178, 0.18);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(66, 103, 178, 0.25);
        color: #fff;
    }

    /* ---------- Cards ---------- */
    .card-modern {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(20, 30, 60, 0.06);
    }

    .card-modern-inner {
        border: 1px solid #eef1f8;
        border-radius: 12px;
        box-shadow: none;
    }

    .grafik-kms-boy .card-modern-inner {
        background-color: #cfe2ff;
    }

    .grafik-kms-girl .card-modern-inner {
        background-color: #ffd1e5;
    }

    .kms-chart-box {
        position: relative;
        height: 360px;
        width: 100%;
        background-color: #fff;
        border: 1px solid rgba(15, 23, 42, 0.08);
        border-radius: 12px;
        padding: 12px;
    }

    .section-title-modern {
        font-weight: 700;
        color: #1a2333;
        font-size: 1.1rem;
        margin-bottom: 16px;
    }

    .detail-block-title {
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: #5c6b8a;
        margin-bottom: 12px;
    }

    .imunisasi-title {
        font-weight: 700;
        font-size: 0.95rem;
        color: #1a2333;
        margin-bottom: 14px;
    }

    /* ---------- Tabs ---------- */
    .nav-tabs-modern {
        border-bottom: 1px solid #eef1f8;
        background-color: #f8faff;
        padding-top: 10px;
    }

    .nav-tabs-modern .nav-link {
        border: none;
        border-radius: 8px 8px 0 0;
        color: #5c6b8a;
        font-weight: 600;
        font-size: 0.82rem;
        padding: 10px 16px;
        margin-right: 2px;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .nav-tabs-modern .nav-link:hover {
        background-color: #eef2ff;
        color: #4f46e5;
    }

    .nav-tabs-modern .nav-link.active {
        background-color: #fff;
        color: #4f46e5;
        box-shadow: 0 -2px 8px rgba(20, 30, 60, 0.05);
    }

    /* ---------- Detail grid (Data Pasien) ---------- */
    .regis-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .regis-detail-item {
        background-color: #f8faff;
        border: 1px solid #eef1f8;
        border-radius: 10px;
        padding: 12px 14px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .regis-detail-item-full {
        grid-column: 1 / -1;
    }

    .regis-detail-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        color: #8b96ab;
    }

    .regis-detail-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1a2333;
    }

    /* ---------- Gender badge (matches index datatable) ---------- */
    .badge-gender {
        font-weight: 600;
        padding: 6px 12px;
        font-size: 0.78rem;
        width: fit-content;
    }

    .badge-gender-boy {
        background-color: #e6f0ff;
        color: #2563eb;
    }

    .badge-gender-girl {
        background-color: #ffe6f1;
        color: #db2777;
    }

    /* ---------- Modern tables (Imunisasi mini tables) ---------- */
    .table-modern-mini {
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0;
    }

    .table-modern-mini thead th {
        background-color: #f4f6fb;
        color: #5c6b8a;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        border-top: none;
        border-bottom: 1px solid #eef1f8;
        padding: 8px;
    }

    .table-modern-mini tbody td {
        border-bottom: 1px solid #f4f6fb;
        border-top: none;
        padding: 8px;
        font-size: 0.85rem;
        color: #1a2333;
    }

    .table-modern-mini tbody tr:last-child td {
        border-bottom: none;
    }

    /* ---------- Main modern table (Hasil Timbang) ---------- */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 6px;
    }

    .table-modern thead th {
        border: none;
        background-color: #f4f6fb;
        color: #5c6b8a;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        padding: 12px 10px;
        vertical-align: middle;
    }

    .table-modern thead th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .table-modern thead th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .table-modern tbody tr {
        background-color: #fff;
    }

    .table-modern tbody td {
        border: none;
        border-top: 1px solid #eef1f8;
        border-bottom: 1px solid #eef1f8;
        padding: 10px;
        vertical-align: middle;
    }

    .table-modern tbody td:first-child {
        border-left: 1px solid #eef1f8;
        border-radius: 10px 0 0 10px;
    }

    .table-modern tbody td:last-child {
        border-right: 1px solid #eef1f8;
        border-radius: 0 10px 10px 0;
    }

    /* ---------- Nested mini table inside Hasil Timbang ---------- */
    .table-mini-modern {
        background-color: #fafbfe;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: inset 0 0 0 1px #eef1f8;
    }

    .table-mini-modern thead th {
        background-color: #eef1f8;
        color: #5c6b8a;
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        border: none;
        padding: 6px;
    }

    .table-mini-modern tbody td {
        border: none;
        padding: 8px 6px;
    }

    /* ---------- Modal ---------- */
    .modal-content-modern {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }

    .modal-header-dark {
        background-color: #081F3E;
    }

    .modal-header-dark .modal-title,
    .modal-header-dark .close {
        color: #fff;
    }

    @media (max-width: 576px) {
        .regis-detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('js')

<script>
    var bayi_timbang = JSON.parse('@json($bayi_timbang)');
    var bb = JSON.parse('@json($antropometri_bb)');
    var bpb = JSON.parse('@json($antropometri_bpb)');

    function styleKmsDatasets(datasets) {
        var styles = {
            'Standar Deviasi: Normal': { borderColor: '#4caf50', backgroundColor: '#74df85', borderWidth: 2, pointStyle: 'rectRounded' },
            'Standar Deviasi + 1': { borderColor: '#4caf50', backgroundColor: '#74df85', borderWidth: 1.5, pointStyle: 'triangle' },
            'Standar Deviasi - 1': { borderColor: '#4caf50', backgroundColor: '#74df85', borderWidth: 1.5, pointStyle: 'rectRot' },
            'Standar Deviasi + 2': { borderColor: '#6edb57', backgroundColor: '#91ef63', borderWidth: 1.5, pointStyle: 'rect' },
            'Standar Deviasi - 2': { borderColor: '#6edb57', backgroundColor: '#91ef63', borderWidth: 1.5, pointStyle: 'crossRot' },
            'Standar Deviasi + 3': { borderColor: '#f2c94c', backgroundColor: '#ffc700', borderWidth: 1.5, pointStyle: 'star' },
            'Standar Deviasi - 3': { borderColor: '#e57373', backgroundColor: '#ff5f5f', borderWidth: 2, pointStyle: 'cross' }
        };

        $.each(datasets, function(i, dataset) {
            dataset.lineTension = 0.25;
            dataset.borderWidth = dataset.borderWidth || 2;
            dataset.pointRadius = 0;
            dataset.pointHoverRadius = 5;
            dataset.pointHitRadius = 10;

            if (dataset.type == 'bubble') {
                dataset.backgroundColor = '#6c5ce7';
                dataset.borderColor = '#341f97';
                dataset.borderWidth = 3;
                dataset.pointStyle = 'star';
                dataset.pointRadius = 6;
                dataset.pointHoverRadius = 8;
            }

            if (styles[dataset.label]) {
                $.extend(dataset, styles[dataset.label]);
            }
        });

        return datasets;
    }

    Chart.plugins.register({
        afterDraw: function(chart) {
            if (!chart.options.kmsRightLabels) return;

            var ctx = chart.chart.ctx;
            var yScale = chart.scales['y-axis-0'];
            var chartArea = chart.chartArea;

            ctx.save();
            ctx.font = 'bold 11px Arial';
            ctx.textBaseline = 'middle';

            $.each(chart.data.datasets, function(i, dataset) {
                var meta = chart.getDatasetMeta(i);
                if (meta.hidden || dataset.type == 'bubble') return;

                var lastValue = null;
                for (var j = dataset.data.length - 1; j >= 0; j--) {
                    if (dataset.data[j] !== null && dataset.data[j] !== undefined) {
                        lastValue = dataset.data[j];
                        break;
                    }
                }
                if (lastValue === null) return;

                var y = yScale.getPixelForValue(lastValue);
                if (y < chartArea.top || y > chartArea.bottom) return;

                ctx.fillStyle = dataset.borderColor;
                ctx.fillText(dataset.label, chartArea.right + 12, y);
            });

            ctx.restore();
        }
    });

    function kmsChartOptions(xLabel, yLabel, minX) {
        return {
            responsive: true,
            maintainAspectRatio: false,
            kmsRightLabels: true,
            layout: { padding: { right: 170 } },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    boxWidth: 10,
                    padding: 14,
                    fontSize: 11,
                    fontColor: '#1a2333'
                }
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: false
            },
            elements: {
                point: {
                    radius: 0,
                    hitRadius: 10
                },
                line: {
                    borderCapStyle: 'round',
                    borderJoinStyle: 'round'
                }
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: { color: 'rgba(148, 163, 184, 0.2)' },
                    scaleLabel: {
                        display: true,
                        labelString: xLabel,
                        fontStyle: 'bold'
                    },
                    ticks: minX ? { min: minX } : {}
                }],
                yAxes: [{
                    display: true,
                    gridLines: { color: 'rgba(148, 163, 184, 0.2)' },
                    scaleLabel: {
                        display: true,
                        labelString: yLabel,
                        fontStyle: 'bold'
                    }
                }]
            }
        };
    }

    function bbPbChartOptions(rows, xLabel) {
        var options = kmsChartOptions(xLabel, 'Berat Badan (kg)');
        options.kmsRightLabels = false;
        options.layout.padding.right = 20;
        options.tooltips = {
            callbacks: {
                label: function(tooltipItem) {
                    return 'PB/TB: ' + tooltipItem.xLabel + ' cm, BB: ' + tooltipItem.yLabel + ' kg';
                }
            }
        };
        options.scales.xAxes[0].type = 'linear';
        options.scales.xAxes[0].position = 'bottom';
        if (rows.length) {
            options.scales.xAxes[0].ticks.min = Math.floor(parseFloat(rows[0].panjang_tinggi_badan));
        }
        return options;
    }

    function bpbRows(jenisUkur) {
        return bpb.filter(function(row) { return row.jenis_ukur == jenisUkur; });
    }

    function bbPbPoints(rows, sdKey) {
        var points = [];

        for (var i = 0; i < rows.length; i++) {
            if (rows[i].panjang_tinggi_badan && rows[i][sdKey]) {
                points.push({
                    x: parseFloat(rows[i].panjang_tinggi_badan),
                    y: parseFloat(rows[i][sdKey])
                });
            }
        }

        points.sort(function(a, b) { return a.x - b.x; });

        return points;
    }

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

            median_bb_2[i] = val.median;
            // plus1_bb_2.push(val.plus1);
            plus1_bb_2[i] = val.plus1;
            // plus2_bb_2.push(val.plus2);
            plus2_bb_2[i] = val.plus2;
            // plus3_bb_2.push(val.plus3);
            plus3_bb_2[i] = val.plus3;
            // min1_bb_2.push(val.min1);
            min1_bb_2[i] = val.min1;
            // min2_bb_2.push(val.min2);
            min2_bb_2[i] = val.min2;
            // min3_bb_2.push(val.min3);
            min3_bb_2[i] = val.min3;
            // umur_bb_2.push(val.umur);
            umur_bb_2[i] = val.umur;

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
            datasets: styleKmsDatasets(data_bb_1)
        },
        options: kmsChartOptions('Umur 0 - 24 Bulan', 'Berat Badan')
    });

    // BB 2


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
            datasets: styleKmsDatasets(data_bb_2)
        },
        options: kmsChartOptions('Umur 24 - 60 Bulan', 'Berat Badan', 24)
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
            if (val.umur == 241) {

                umur_pb_1.push(24);
            } else {
                umur_pb_1.push(val.umur);
            }
        }
        if (i > 24) {

            median_pb_2.push(val.median);
            plus1_pb_2.push(val.plus1);
            plus2_pb_2.push(val.plus2);
            plus3_pb_2.push(val.plus3);
            min1_pb_2.push(val.min1);
            min2_pb_2.push(val.min2);
            min3_pb_2.push(val.min3);
            if (val.umur == 242) {

                umur_pb_2.push(24);
            } else {
                umur_pb_2.push(val.umur);

            }

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
            bayi_pb_2.push({
                x: parseInt(val.umur_bulan),
                y: parseInt(val.tinggi_badan),
                r: 7
            });
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
            datasets: styleKmsDatasets(data_pb_1)
        },
        options: kmsChartOptions('Umur 0 - 24 Bulan', 'Tinggi Badan')
    });

    // pb 2

    var data_pb_2 = [{
            label: 'Tinggi Badan',
            data: bayi_pb_2,
            type: 'bubble',
            order: 1,
            backgroundColor: "lightblue",
            borderColor: "blue",
            borderWidth: 0,
            fill: true,

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
            datasets: styleKmsDatasets(data_pb_2)
        },
        options: kmsChartOptions('Umur 24 - 60 Bulan', 'Tinggi Badan', 24),

    });

    var bpb_pb = bpbRows('PB');
    var bpb_tb = bpbRows('TB');
    var bayi_bb_pb_1 = [];
    var bayi_bb_pb_2 = [];

    $.each(bayi_timbang, function(i, val) {
        if (val.tinggi_badan && val.berat_badan) {
            var point = {
                x: parseFloat(val.tinggi_badan),
                y: parseFloat(val.berat_badan),
                r: 7
            };

            if (parseInt(val.umur_bulan) <= 24) {
                bayi_bb_pb_1.push(point);
            } else {
                bayi_bb_pb_2.push(point);
            }
        }
    });

    function bbPbDatasets(rows, bayiData) {
        return styleKmsDatasets([{
            label: 'Berat Badan',
            data: bayiData,
            type: 'bubble',
            order: 1,
            backgroundColor: 'lightblue',
            borderColor: 'blue',
            borderWidth: 1
        }, {
            label: 'Standar Deviasi: Normal',
            data: bbPbPoints(rows, 'median'),
            fill: false,
            order: 1
        }, {
            label: 'Standar Deviasi + 1',
            data: bbPbPoints(rows, 'plus1'),
            fill: '-1',
            order: 2
        }, {
            label: 'Standar Deviasi - 1',
            data: bbPbPoints(rows, 'min1'),
            fill: '-1',
            order: 2
        }, {
            label: 'Standar Deviasi + 2',
            data: bbPbPoints(rows, 'plus2'),
            fill: '-2',
            order: 3
        }, {
            label: 'Standar Deviasi - 2',
            data: bbPbPoints(rows, 'min2'),
            fill: '-2',
            order: 3
        }, {
            label: 'Standar Deviasi + 3',
            data: bbPbPoints(rows, 'plus3'),
            fill: '-3',
            order: 4
        }, {
            label: 'Standar Deviasi - 3',
            data: bbPbPoints(rows, 'min3'),
            fill: '-3',
            order: 4
        }]);
    }

    var bb_pb_1 = document.getElementById('bb_pb_1').getContext('2d');
    var myChart = new Chart(bb_pb_1, {
        type: 'line',
        data: {
            labels: bpb_pb.map(function(row) { return parseFloat(row.panjang_tinggi_badan); }),
            datasets: bbPbDatasets(bpb_pb, bayi_bb_pb_1)
        },
        options: bbPbChartOptions(bpb_pb, 'Panjang Badan (cm)')
    });

    if (bpb_tb.length) {
        var bb_pb_2 = document.getElementById('bb_pb_2').getContext('2d');
        var myChart = new Chart(bb_pb_2, {
            type: 'line',
            data: {
                labels: bpb_tb.map(function(row) { return parseFloat(row.panjang_tinggi_badan); }),
                datasets: bbPbDatasets(bpb_tb, bayi_bb_pb_2)
            },
            options: bbPbChartOptions(bpb_tb, 'Tinggi Badan (cm)')
        });
    } else {
        $('#bb_pb_2').hide();
        $('#bb_pb_2_empty').removeClass('d-none');
    }
</script>

@endpush
