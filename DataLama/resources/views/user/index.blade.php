@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Selamat Datang {{Auth::user()->name}},</h2>
                        <p class="mb-md-0">Di Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analisis</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    </button>
                    <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Diri</h4>
                    <table class="table">
                        <tr>
                            <td>NIK</td>
                            <td>{{$pasiendata->nik}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{$pasiendata->nama}}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td>{{$pasiendata->tempat_lahir}}</td>
                        </tr>
                        @php
                        $tanggal = date('d M Y', strtotime($pasiendata->tgl_lahir));
                        @endphp
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>{{$tanggal}}</td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>{{$pasiendata->umur}} tahun</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>{{$pasiendata->pekerjaan}}</td>
                        </tr>
                        <tr>
                            <td>Pendidikan</td>
                            <td>{{$pasiendata->pendidikan}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Suami</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>NIK Suami</td>
                            <td>{{$pasiendata->nik_suami}}</td>
                        </tr>
                        <tr>
                            <td>Suami</td>
                            <td>{{$pasiendata->nama_suami}}</td>
                        </tr>
                        <tr>
                            <td>Umur Suami</td>
                            <td>{{$pasiendata->umur_suami}} tahun</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>{{$pasiendata->pekerjaan}}</td>
                        </tr>
                        <tr>
                            <td>Pendidikan Suami</td>
                            <td>{{$pasiendata->pendidikan_suami}}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>{{$pasiendata->pekerjaan}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tempat Tinggal</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>Alamat</td>
                            <td>{{$pasiendata->alamat}}</td>
                        </tr>
                        <tr>
                            <td>Alamat Domisili</td>
                            <td>{{$pasiendata->alamat_domisili}}</td>
                        </tr>
                        <tr>
                            <td>RT/RW</td>
                            <td>{{$pasiendata->rw}}</td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>{{$pasiendata->kecamatan}}</td>
                        </tr>
                        <tr>
                            <td>Kabupaten</td>
                            <td>{{$pasiendata->kabupaten}}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>{{$pasiendata->kota}}</td>
                        </tr>
                        <tr>
                            <td>No Telpon</td>
                            <td>{{$pasiendata->no_tlp}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection


    @push('js')
    @endpush