@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Terima Kader</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analisis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="tableData" class="table table-hover compact" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Posyandu</th>
                                <th>Alamat</th>
                                <th>Username</th>
                                <th>No Telfon</th>
                                <th>Email</th>
                                <th>Mendaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($kader as $k)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $k->name }}</td>
                                <td>{{ $k->nik }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->alamat }}</td>
                                <td>{{$k->username}}</td>
                                <td>{{ $k->no_tlp }}</td>
                                <td>{{ $k->email }}</td>
                                <td id="created_at">{{ $k->created_at }}</td>
                                <td>
                                    <div class="form-button-action">

                                        <a onclick="actionTable.acceptRow('{{$k->kader_id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-success btn-sm" style="width: 50%;">
                                            <i class="mdi mdi-tooltip-edit"></i>Terima
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="actionTable.deleteRow('{{$k->kader_id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-danger btn-sm" style="width: 50%;">
                                            <i class="mdi mdi-delete-forever"></i>Hapus
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
                <table class="table table-hover" id="tableModal">
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
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;"></p>
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
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;">Ya</button>
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

    var actionTable = function() {
        var acceptRow = function(id) {

            $('#modalConfirmTitle').text('Apakah anda ingin menambahkan?');
            $('#modalConfirmYes').attr('onclick', 'actionTable.tambah(' + id + ')');

        }

        var tambah = function(id) {
            $.get(`{{url('/accept_kader/` + id + `/confirm')}}`, function(m) {
                if (m == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil Ditambah'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 950);
                } else {
                    ToastError.fire({
                        icon: 'error',
                        title: 'Gagal Ditambah',
                    });

                    console.log(m)
                }
            });
        }

        var deleteRow = function(id) {

            $('#modalConfirmTitle').text('Apakah anda ingin menghapus?');
            $('#modalConfirmYes').attr('onclick', 'actionTable.hapus(' + id + ')');

        }

        var hapus = function(id) {
            $.get(`{{url('/accept_kader/` + id + `/destroy')}}`, function(m) {
                if (m == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil Dihapus'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 950);
                } else {
                    ToastError.fire({
                        icon: 'error',
                        title: 'Gagal Dihapus',
                    });

                    console.log(m)
                }
            });
        }


        actionTable.acceptRow = acceptRow;
        actionTable.tambah = tambah;

        actionTable.deleteRow = deleteRow;
        actionTable.hapus = hapus;
    }

    actionTable();
</script>

@endpush