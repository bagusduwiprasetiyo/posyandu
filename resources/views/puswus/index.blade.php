@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Data Pus/Wus</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Pemeriksaan</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/puswus/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Pus/Wus
                        </a>
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
                    <table id="tableData" class="table table-hover text-center">
                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Nama PusWus</th>
                                <th>Nama Suami</th>
                                <th>Lila</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($puswus as $key => $detail)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$detail->nama_wuspus}}</td>
                                <td>{{$detail->nama_suami}}</td>
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
                                            class="btn btn-outline-warning btn-xs">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{url('puswus/'.Crypt::encrypt($detail->id).'/edit')}}"
                                            data-toggle="tooltip" title="" class="btn btn-outline-primary btn-xs"
                                            data-original-title="Update Data">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$detail->id}}')"
                                            data-toggle="modal" data-target="#modalConfirm"
                                            class="btn btn-outline-danger btn-xs">
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Hapus data?</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white; padding: 4px;">
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;"
                            onclick="deleteAcc()">Ya</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

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