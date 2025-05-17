@extends('layouts.master')

@push('css')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Daftar Posyandu</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">daftar posyandu</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <button type="button" data-toggle="modal" data-target="#modalCreate" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah
                        </button>
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
                                <th>Posyandu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($posyandu as $k)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>
                                    <div class="form-button-action">

                                        <button onclick="edit('{{$k->id}}', '{{$k->nama}}')" data-toggle="modal" data-target="#modalEdit" cclass="btn btn-outline-primary btn-sm" class="btn btn-outline-primary btn-sm">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </button>
                                        <button type="button" id="buttonDelete" onclick="deleteData('{{$k->id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-outline-danger btn-sm">
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
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateTitle" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Tambahkan Posyandu</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCreate" method="post" action="{{url('/create_posyandu')}}">
                <div class="modal-body" style="background-color: white;">
                    {{ csrf_field() }}
                    <div class="form-group">

                        <label for="nama">Nama Posyandu</label>
                        <input type="text" name="nama" id="nama" class="form-control" maxlength="30" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6"><button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 100%;">Batal</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success" style="width: 100%;">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Edit Nama Posyandu</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" method="post">
                <div class="modal-body" style="background-color: white;">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="nama">Nama Posyandu</label>
                        <input type="text" name="nama" id="namaEdit" class="form-control" maxlength="30" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6"><button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 100%;">Batal</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success" style="width: 100%;">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

    $('#formCreate').validate();

    $('input[name=nama]').on('keyup keypress change', function() {

        capital = $(this).val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        $(this).val(capital);

    });

    $('#formCreate').on('submit', function(e) {
        e.preventDefault();

        if ($(this).valid()) {
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(m) {
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
                            text: m
                        });

                    }
                }
            })
        }

    })


    $('#formEdit').on('submit', function(e) {
        e.preventDefault();

        if ($(this).valid()) {
            $.ajax({
                url: `{{url("create_posyandu/")}}` + `/` + $('#id').val() + `/edit`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(m) {
                    if (m == 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Diubah'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 950);
                    } else {
                        ToastError.fire({
                            icon: 'error',
                            title: 'Gagal Diubah',
                        });
                    }
                }
            })
        }

    })

    function edit(id, val) {

        $('#id').val(id);
        $('#namaEdit').val(val);

    }

    var idDelete = 0;

    function deleteData(id) {

        idDelete = id;

    }

    function deleteAcc() {

        $.ajax({
            url: `{{url("create_posyandu/")}}` + `/` + idDelete + `/destroy`,
            method: 'DELETE',
            data: {
                _token: '{{csrf_token()}}'
            },
            success: function(m) {
                if (m == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil Diubah'
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 950);
                } else {
                    ToastError.fire({
                        icon: 'error',
                        title: 'Gagal Diubah',
                        text: m
                    });

                    console.log(m)
                }
            }
        })
    }
</script>

@endpush