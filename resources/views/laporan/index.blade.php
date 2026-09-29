@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        @if(auth()->user()->status == 3)
                        <h2>Selamat Datang {{Auth::user()->username}},</h2>
                        @else
                        <h2>Selamat Datang {{Auth::user()->name}},</h2>
                        @endif
                        <p class="mb-md-0">Di Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
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
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h6 class="mt-3">Tampilkan Data Posyandu Dari : </h6>
                            <select name="posyandu_id" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true" required>
                                <option value="0">-- Semua Posyandu --</option>
                                @foreach($list_posyandu as $lp)
                                <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h6 class="mt-3">Pilih Data Yang Ingin Dicetak : </h6>
                            <select name="type_id" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true" required>

                                <option value="0">Pilih Data</option>
                                <option value="1">Data Kehamilan Ibu</option>
                                <option value="2">Data Bayi</option>
                                <!-- <option value="3">Pus/Wus</option> -->

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h6 class="mt-3">Tahun : </h6>
                            <select name="filter_tahun" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true">
                                <option value="0">-- Semua Tahun --</option>
                                @php
                                $tahunSekarang = (int)date('Y');
                                @endphp
                                @for($th = $tahunSekarang; $th >= $tahunSekarang - 5; $th--)
                                <option value="{{$th}}">{{$th}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <h6 class="mt-3">Rentang Waktu (Bulan) : </h6>
                            <select name="filter_bulan" class="form-control selectpicker mt-3" data-show-subtext="true">
                                <option value="0">-- Semua Bulan / 1 Tahun Penuh --</option>
                                <option value="1">1 Bulan Terakhir</option>
                                <option value="3">3 Bulan Terakhir</option>
                                <option value="6">6 Bulan Terakhir</option>
                                <option value="custom">Pilih Rentang Bulan Sendiri...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row d-none" id="customBulanRow">
                        <div class="form-group col-md-6">
                            <h6>Dari Bulan :</h6>
                            <select name="bulan_dari" class="form-control selectpicker">
                                @php
                                $namaBulanList = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
                                @endphp
                                @foreach($namaBulanList as $num => $namaBln)
                                <option value="{{$num}}">{{$namaBln}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <h6>Sampai Bulan :</h6>
                            <select name="bulan_sampai" class="form-control selectpicker">
                                @foreach($namaBulanList as $num => $namaBln)
                                <option value="{{$num}}" {{ $num == (int)date('m') ? 'selected' : '' }}>{{$namaBln}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success btn-sm submit" style="float: right;"><i class="mdi mdi-printer menu-icon"></i> Cetak Data</button>

                </div>
            </div>

        </div>


    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        // tampilkan/sembunyikan row rentang bulan manual
        $('select[name=filter_bulan]').on('change', function() {
            if ($(this).val() === 'custom') {
                $('#customBulanRow').removeClass('d-none');
            } else {
                $('#customBulanRow').addClass('d-none');
            }
        });

        $('.submit').on('click', function() {
            var type_id     = $('select[name=type_id]').val();
            var posyandu_id = $('select[name=posyandu_id]').val();
            var tahun       = $('select[name=filter_tahun]').val();
            var filterBulan = $('select[name=filter_bulan]').val();

            if (type_id == 0) {
                alert('Pastikan anda memilih data yang ingin dicetak!');
                return;
            }

            // Hitung bulan_dari & bulan_sampai
            var bulan_dari   = 0;
            var bulan_sampai = 0;

            if (filterBulan === 'custom') {
                bulan_dari   = $('select[name=bulan_dari]').val();
                bulan_sampai = $('select[name=bulan_sampai]').val();
            } else if (filterBulan != 0) {
                // N bulan terakhir dari bulan sekarang
                var now     = new Date();
                var bSampai = now.getMonth() + 1; // 1-12
                var bDari   = bSampai - parseInt(filterBulan) + 1;
                if (bDari < 1) bDari = 1;
                bulan_dari   = bDari;
                bulan_sampai = bSampai;
            }

            var baseUrl;
            if (type_id == 1) baseUrl = "{{url('laporan_registrasi_bumil')}}";
            if (type_id == 2) baseUrl = "{{url('laporan_registrasi_bayi')}}";
            if (type_id == 3) baseUrl = "{{url('laporan_registrasi_puswus')}}";

            var url;
            if (bulan_dari != 0 && bulan_sampai != 0) {
                url = baseUrl + '/' + posyandu_id + '/' + tahun + '/' + bulan_dari + '/' + bulan_sampai;
            } else {
                url = baseUrl + '/' + posyandu_id + '/' + tahun;
            }

            window.open(url);
        });
    })
</script>
@endpush