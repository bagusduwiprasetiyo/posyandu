@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Data Pasien</h2>
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
                        <a href="{{url('/pasien/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Pasien
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
                <div class="card-body">
                    <table id="tableData" class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Posyandu</th>
                                <th>Tempat Lahir</th>
                                <th style="width: 10%;">Tgl Lahir</th>
                                <th style="width: 10%;">Umur ibu</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($pasiens as $png)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $png->nama }}</td>
                                <td>{{ $png->nik }}</td>
                                <td>{{ $png->posyandu }}</td>
                                <td>{{ $png->tempat_lahir }}</td>
                                <td>{{ $png->tgl_lahir }}</td>
                                <td>{{ $png->umur }}</td>
                                <td>{{ $png->alamat }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{url('pasien/')}}/{{$png->id}}/detail" class="detailData btn btn-outline-warning btn-sm">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{url('/pasien/')}}/{{ $png->id }}/edit" data-toggle="tooltip" title="" class="btn btn-outline-primary btn-sm" data-original-title="Update Data">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$png->id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-outline-danger btn-sm">
                                            <i class="mdi mdi-delete-forever"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @php
                            $i++;
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="deleteAcc()">Ya</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    jQuery(document).ready(function($) {

        $('#tableData').DataTable({
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
        });

    });


    $('#modal').on('hidden.bs.modal', function() {
        $('#tableModal').DataTable().destroy();
        $('#detailDataTitle').empty();
        $('#detailDataPush').empty();
    });

    var idDelete = 0;

    var deleteRow = function(id) {
        idDelete = id;
    }

    function deleteAcc() {
        $.get(" {{url('/pasien')}}/" + idDelete + `/destroy`, function(m) {

            if (m == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus'
                });
                setTimeout(function() {
                    window.location.href = "{{url('/pasien')}}";
                }, 950);
            } else {
                ToastError.fire({
                    icon: 'error',
                    title: 'Gagal Dihapus',
                    text: m
                });
            }

        });
    }
</script>

@endpush