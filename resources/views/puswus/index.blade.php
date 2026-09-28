@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap page-header-modern">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2 class="page-title-modern">Data Pus/Wus</h2>
                        <p class="mb-md-0 text-muted">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex breadcrumb-modern">
                        <i class="mdi mdi-home text-muted"></i>
                        <p class="text-muted mb-0">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 font-weight-bold">Pus/Wus</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/puswus/create')}}" class="btn btn-primary btn-modern mt-2 mt-xl-0">
                            <i class="mdi mdi-plus-circle-outline mr-1"></i> Tambah Pus/Wus
                        </a>
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card card-modern">
                <div class="card-body" style="overflow-x: auto;">
                    <table id="tableData" class="table table-modern text-center">
                        <thead>

                            <tr>
                                <th>No</th>
                                <th class="text-left">Nama PusWus</th>
                                <th class="text-left">Nama Suami</th>
                                <th>Lila</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($puswus as $key => $detail)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td class="text-left font-weight-semibold">{{$detail->nama_wuspus}}</td>
                                <td class="text-left">{{$detail->nama_suami}}</td>
                                <td>
                                    @if($detail->ukuran_lila != '')
                                    @if($detail->ukuran_lila < 24) <span class="badge badge-pill badge-danger">
                                        {{$detail->ukuran_lila}}cm, gizi
                                        kurang
                                        </span>
                                        @else
                                        <span class="badge badge-pill badge-success">
                                            {{$detail->ukuran_lila}}cm, gizi
                                            normal
                                        </span>
                                        @endif
                                        @else
                                        -
                                        @endif
                                </td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{url('puswus/'.Crypt::encrypt($detail->id))}}"
                                            class="btn btn-outline-warning btn-sm btn-icon-modern">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{url('puswus/'.Crypt::encrypt($detail->id).'/edit')}}"
                                            data-toggle="tooltip" title="" class="btn btn-outline-primary btn-sm btn-icon-modern"
                                            data-original-title="Update Data">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$detail->id}}')"
                                            data-toggle="modal" data-target="#modalConfirm"
                                            class="btn btn-outline-danger btn-sm btn-icon-modern">
                                            <i class="mdi mdi-delete-forever"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-dark">
                <p class="modal-title" id="modalConfirmTitle">Hapus data?</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <p class="text-muted small mb-3">Data Pus/Wus yang sudah dihapus tidak dapat dikembalikan.</p>
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-light btn-sm btn-modern-sm" data-dismiss="modal" style="width: 100%;">Batal</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-danger btn-sm btn-modern-sm" id="modalConfirmYes" style="width: 100%;"
                            onclick="deleteAcc()">Ya, Hapus</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .page-title-modern { font-weight: 700; letter-spacing: -0.02em; color: #1a2333; margin-bottom: 2px; }
    .breadcrumb-modern { opacity: 0.85; font-size: 0.85rem; }
    .card-modern { border: none; border-radius: 14px; box-shadow: 0 2px 16px rgba(20, 30, 60, 0.06); }
    .btn-modern { border-radius: 8px; font-weight: 600; padding: 0.55rem 1.1rem; box-shadow: 0 4px 10px rgba(66, 103, 178, 0.18); transition: transform 0.15s ease, box-shadow 0.15s ease; }
    .btn-modern:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(66, 103, 178, 0.25); color: #fff; }
    .table-modern { border-collapse: separate; border-spacing: 0 6px; }
    .table-modern thead th { border: none; background-color: #f4f6fb; color: #5c6b8a; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.04em; font-weight: 700; padding: 12px 10px; }
    .table-modern thead th:first-child { border-radius: 10px 0 0 10px; }
    .table-modern thead th:last-child { border-radius: 0 10px 10px 0; }
    .table-modern tbody tr { background-color: #fff; transition: background-color 0.15s ease, box-shadow 0.15s ease; }
    .table-modern tbody tr:hover { background-color: #f8faff; box-shadow: 0 2px 10px rgba(20, 30, 60, 0.05); }
    .table-modern tbody td { border: none; border-top: 1px solid #eef1f8; border-bottom: 1px solid #eef1f8; padding: 14px 10px; vertical-align: middle; }
    .table-modern tbody td:first-child { border-left: 1px solid #eef1f8; border-radius: 10px 0 0 10px; }
    .table-modern tbody td:last-child { border-right: 1px solid #eef1f8; border-radius: 0 10px 10px 0; }
    .font-weight-semibold { font-weight: 600; color: #1a2333; }
    .btn-modern-sm { border-radius: 7px; font-weight: 600; font-size: 0.8rem; }
    .btn-icon-modern { border-radius: 7px; width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; margin: 0 2px; }
    .modal-content-modern { border: none; border-radius: 14px; overflow: hidden; }
    .modal-header-dark { background-color: #081F3E; }
    .modal-header-dark .modal-title, .modal-header-dark .close { color: #fff; }
</style>
@endpush

@push('js')
<script>
    $('table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        responsive: {
                details: {
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
                            return col.hidden ?
                                '<tr class="detailsData" data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                                '<td class="detailsData">' + col.title + ':' + '</td> ' +
                                '<td class="detailsData">' + col.data + '</td>' +
                                '</tr>' :
                                '';
                        }).join('');

                        return data ?
                            $('<table class="scroller"/>').append(data) :
                            false;
                    }
                }
            }
    })

    // ############## DELETE ###############
    let id_delete = 0

    var deleteRow = (id) => {
        id_delete = id
    }

    var deleteAcc = () => {
        $.ajax({
            type: "delete",
            url: "{{url('puswus')}}/" + id_delete,
            data: {_token : "{{csrf_token()}}"},
            success: function (response) {
                notif(response.status, response.message, "{{url('puswus/')}}")
            }   
        });
    }


</script>
@endpush
