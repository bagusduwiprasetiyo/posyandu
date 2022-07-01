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
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('laporan')}}" method="post">
                        {{csrf_field()}}
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
                                    <option value="0">-- Semua Data --</option>

                                    <option value="1">Data Kehamilan Ibu</option>

                                    <option value="2">Data Bayi</option>

                                </select>
                            </div>
                        </div>
                        <button class="btn btn-success btn-sm" style="float: right;"><i class="mdi mdi-printer menu-icon"></i> Cetak Data</button>
                    </form>
                </div>
            </div>

        </div>


    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        // $('form').on('submit', function(e) {
        //     e.preventDefault();


        // })
    })
</script>
@endpush