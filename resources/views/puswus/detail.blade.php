@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Detail Data PusWus</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analisis</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/puswus')}}" class="btn btn-primary btn-sm mt-3"> Kembali </a>
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
                                    <h4 class="card-title">Data PusWus</h4>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card" style="min-width: 550px;">
                                                <div class="card-body dashboard-tabs p-0">
                                                    <ul class="nav nav-tabs px-4" role="tablist" style="background-color: #f3f3f3;">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Data
                                                                Pasien</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Pemberian Tablet dan Imunisasi</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="timbang-tab" data-toggle="tab" href="#timbang" role="tab" aria-controls="timbang" aria-selected="false">Keluarga Berencana</a>
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
                                                                                    Data PusWus
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Nama PusWus
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{isset($puswus->nama_wuspus) ?
                                                                                    $puswus->nama_wuspus:'-'}}
                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                            if(isset($puswus->tgl_lahir_wuspus)){
                                                                            $date = new
                                                                            DateTime($puswus->tgl_lahir_wuspus);
                                                                            $now = new DateTime();
                                                                            $tgl = date('d-m-Y',
                                                                            strtotime($puswus->tgl_lahir_wuspus));
                                                                            $umur = ($date->diff($now)->format('%y
                                                                            tahun, %m bulan, %d hari'));
                                                                            }else{
                                                                            $tgl = '-';
                                                                            $umur = '-';
                                                                            }
                                                                            @endphp
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Tanggal Lahir
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{$tgl}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Umur
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{$umur}}
                                                                                </td>
                                                                            </tr>
                                                                            @php
                                                                            if(isset($puswus->tgl_lahir_suami)){
                                                                            $date = new
                                                                            DateTime($puswus->tgl_lahir_suami);
                                                                            $now = new DateTime();
                                                                            $tgl = date('d-m-Y',
                                                                            strtotime($puswus->tgl_lahir_suami));
                                                                            $umur = ($date->diff($now)->format('%y
                                                                            tahun, %m bulan, %d hari'));
                                                                            }else{
                                                                            $tgl = '-';
                                                                            $umur = '-';
                                                                            }
                                                                            @endphp
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Tanggal Lahir
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{$tgl}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Umur
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{$umur}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Lila
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    @if($puswus->ukuran_lila != '')
                                                                                    @if($puswus->ukuran_lila < 24) <span class="badge badge-pill badge-danger">
                                                                                        {{$puswus->ukuran_lila}}cm, gizi
                                                                                        kurang
                                                                                        </span>
                                                                                        @else
                                                                                        <span class="badge badge-pill badge-success">
                                                                                            {{$puswus->ukuran_lila}}cm,
                                                                                            gizi
                                                                                            normal
                                                                                        </span>
                                                                                        @endif
                                                                                        @else
                                                                                        -
                                                                                        @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Tahapan KS
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{isset($puswus->tahapan_ks) ?
                                                                                    $puswus->tahapan_ks:'-'}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Kelompok Dasa Wisma
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{isset($puswus->klp_dasa_wisma) ?
                                                                                    $puswus->klp_dasa_wisma:'-'}}
                                                                                </td>
                                                                            </tr>



                                                                        </table>


                                                                    </div>

                                                                    {{-- data anak --}}

                                                                    <div class="col-md-6 mt-4">
                                                                        <table class="table table-sm table-bordered" style="padding: 20px;">
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Jumlah Anak
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Yang Hidup
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{isset($puswus->jml_anak_hidup) ?
                                                                                    $puswus->jml_anak_hidup:'-'}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="padding: 14px;width:30%;">
                                                                                    Yang Meninggal
                                                                                </td>
                                                                                <td style="padding: 14px;">
                                                                                    {{isset($puswus->jml_anak_meninggal)
                                                                                    ?
                                                                                    $puswus->jml_anak_meninggal:'-'}}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        {{-- ############## Tab Kedua ########### --}}


                                                        <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                                            <div class="row">
                                                                <div class="col-md-6 stretch-card" style="padding: 20px;">
                                                                    <table class="table table-bordered text-center table-sm">
                                                                        <tr>
                                                                            <td colspan="4" style="font-weight: bold; padding: 10px;" class="text-center">
                                                                                Pemberian Kapsul Yodium Bulanan
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="background-color: #f3f3f3; font-weight: bold;" class="text-center">
                                                                            <td style="padding: 10px;">
                                                                                Keterangan
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                Tanggal
                                                                            </td>
                                                                        </tr>

                                                                        @if(isset($puswus->imunisasi['kapsul_yodium']))
                                                                        @foreach($puswus->imunisasi['kapsul_yodium'] as
                                                                        $key
                                                                        => $ky)
                                                                        <tr>
                                                                            <td style="padding: 10px;">
                                                                                Pemberian ke {{$ky[0]}}
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                {{$ky[1]}}
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @endif

                                                                    </table>
                                                                </div>
                                                                <div class="col-md-6 stretch-card" style="padding: 20px;">
                                                                    <table class="table table-bordered text-center table-sm">
                                                                        <tr>
                                                                            <td colspan="4" style="font-weight: bold; padding: 10px;" class="text-center">
                                                                                Pemberian Imunisasi TT
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="background-color: #f3f3f3; font-weight: bold;" class="text-center">
                                                                            <td style="padding: 10px;">
                                                                                Keterangan
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                Tanggal
                                                                            </td>
                                                                        </tr>

                                                                        @if(isset($puswus->imunisasi['imunisasi_tt']))
                                                                        @foreach($puswus->imunisasi['imunisasi_tt'] as
                                                                        $key
                                                                        => $ky)
                                                                        <tr>
                                                                            <td style="padding: 10px;">
                                                                                Pemberian ke {{$ky[0]}}
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                {{$ky[1]}}
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @endif

                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        {{-- ############### KELUARGA BERENCANA ############# --}}


                                                        <div class="tab-pane fade" id="timbang" role="tabpanel" aria-labelledby="timbang-tab">
                                                            <div class="row">
                                                                <div class="col-md-5" style="padding: 20px;">
                                                                    <table class="table table-bordered text-center table-sm">
                                                                        <tr style="background-color: #f3f3f3;font-weight: bold;" class="text-center">
                                                                            <td style="padding: 10px;" colspan="3">
                                                                                Jenis Alkon yang Dipakai
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="background-color: #f3f3f3;" class="text-center">
                                                                            <td style="padding: 10px;">Jenis</td>
                                                                            <td style="padding: 10px;">Menggunakan</td>
                                                                            <td style="padding: 10px;">Berakhir</td>
                                                                        </tr>
                                                                        @if(isset($puswus->kb['alkon']))
                                                                        @foreach($puswus->kb['alkon'] as
                                                                        $key
                                                                        => $ky)
                                                                        <tr>
                                                                            <td style="padding: 10px;">
                                                                                {{isset($ky[0])?$ky[0]:''}}
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                {{isset($ky[1])?$ky[1]:''}}
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                {{isset($ky[2])?$ky[2]:''}}
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @endif
                                                                    </table>
                                                                </div>
                                                                <div class="col-md-7" style="padding: 20px;">
                                                                    <table class="table table-bordered text-center table-sm">
                                                                        <tr style="font-weight: bold;" class="text-center">
                                                                            <td style="padding: 10px;" colspan="2">
                                                                                Pergantian Alkon
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="background-color: #f3f3f3;font-weight: bold;" class="text-center">

                                                                            <td style="padding: 10px;">
                                                                                Jenis
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                Tanggal
                                                                            </td>
                                                                        </tr>
                                                                        @if(isset($puswus->kb['pergantian_alkon']))
                                                                        @foreach($puswus->kb['pergantian_alkon'] as
                                                                        $key
                                                                        => $ky)
                                                                        <tr>
                                                                            <td style="padding: 10px;">
                                                                                {{$ky[0]}}
                                                                            </td>
                                                                            <td style="padding: 10px;">
                                                                                {{$ky[1]}}
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @endif
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="timbang" role="tabpanel" aria-labelledby="timbang-tab">
                                                            data 3
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

@endsection

@push('js')

<script>

</script>

@endpush