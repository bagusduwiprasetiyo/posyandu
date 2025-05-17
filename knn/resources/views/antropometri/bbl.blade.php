@extends('layouts.master')

@push('css')

<style type="text/css">
    .card-body { overflow-x: scroll; }
    .detailsData{ min-width: 50px; }
</style>

@endpush
@section('content')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Standar Antropometri</h2>
                        <p class="mb-md-0">Berat badan anak laki-laki.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">daftar posyandu</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#exampleExcel">
                        Contoh Format Excel
                    </button>
                    <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                        Import Excel
                    </button>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('sukses'))
                        <div class="alert alert-success" role="alert"style="font-size: 12px; width: 100%;"><i class="fa fa-exclamation-triangle"></i> {{session()->get('sukses')}}</div>
                    @endif
                    @if(session()->has('gagal'))
                        <div class="alert alert-danger" role="alert"style="font-size: 12px; width: 100%;"><i class="fa fa-exclamation-triangle"></i> {{session()->get('gagal')}}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            
                        </div>
                    @endif
                    <table id="tableData" class="table table-hover compact" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th>Umur</th>
                                <th>-3 SD</th>
                                <th>-2 SD</th>
                                <th>-1 SD</th>
                                <th>Median</th>
                                <th>+1 SD</th>
                                <th>+2 SD</th>
                                <th>+3 SD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach($bbl as $b)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$b->umur}}</td>
                                    <td>{{$b->min3}}</td>
                                    <td>{{$b->min2}}</td>
                                    <td>{{$b->min1}}</td>
                                    <td>{{$b->median}}</td>
                                    <td>{{$b->plus1}}</td>
                                    <td>{{$b->plus2}}</td>
                                    <td>{{$b->plus3}}</td>
                                </tr>

                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleExcel" tabindex="-1" role="dialog" aria-labelledby="exampleExcelTitle" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Contoh Excel</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body" style="background-color: white;">
                   <img src="{{asset('template/')}}/backend/images/excel.png" width="700" height="700">
                    
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-sm-2"><button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 100%;">Tutup</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>


<!-- Import Excel -->
        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{url('/antropometri_bbl')}}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                        </div>
                        <div class="modal-body">
 
                            {{ csrf_field() }}
 
                            <label>Pilih file excel</label>
                            <div class="form-group">
                                <input type="file" name="file" required="required">
                                <p class="mt-3" style="color:red;">*Tidak boleh ada format selain number pada excel !</p>
                                    <p class="mt-3" style="color:red;">*Wajib melihat contoh format !</p>
                                    <p class="mt-3" style="color:red;">*Analisa akan salah jika data antropometri tidak sesuai !</p>
                            </div>
 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
 
@endsection


@push('js')

<script>
    $('#tableData').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
    });
</script>
@endpush