@extends('layouts.master')
@section('content')

@include('account.tambah')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Data Bayi</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">pengaturan akun</p>
                    </div>

                </div>

            </div>
            <br>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <div>
                    @if(!session()->has('kader'))
                    <button data-target="#modalTambahAdmin" data-toggle="modal" class="btn btn-success mr-3 mt-2 mt-xl-0">
                        Tambah Akun Admin
                    </button>
                    <a href="{{url('/kader')}}" class="btn btn-primary mr-3 mt-2 mt-xl-0">Tambah Akun Kader</a>
                    @endif
                    <button data-target="#modalTambah" data-toggle="modal" class="btn btn-warning mr-3 mt-2 mt-xl-0" onclick="tambahAkunIbu()">
                        Tambah Akun Ibu
                    </button>
                    <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="tableData" class="table table-hover text-center">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 10%;">No</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Terdaftar Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($user as $k)
                            @if($k->id != auth()->user()->id)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $k->username }}</td>
                                @if($k->status == 1)
                                <td><span class="badge badge-pill badge-success">Admin</span></td>
                                @endif
                                @if($k->status == 2)
                                <td><span class="badge badge-pill badge-primary">Kader</span></td>
                                @endif
                                @if($k->status == 3)
                                <td><span class="badge badge-pill badge-warning ">User</span></td>
                                @endif
                                <td id="created_at">{{ $k->created_at }}</td>
                                <td>
                                    <div class="form-button-action">

                                        @if($k->status == 3)
                                        <a onclick="editRowIbu('{{$k->id}}', '{{$k->username}}'); editNow('{{$k->username}}')" data-toggle="modal" data-target="#modalTambah" class="btn btn-success btn-sm" style="width: 50%;">
                                            <i class="mdi mdi-tooltip-edit"></i>Edit
                                        </a>
                                        @else
                                        <a onclick="editRow('{{$k->id}}', '{{$k->username}}'); editNow('{{$k->username}}')" data-toggle="modal" data-target="#modalEdit" class="btn btn-success btn-sm" style="width: 50%;">
                                            <i class="mdi mdi-tooltip-edit"></i>Edit
                                        </a>
                                        @endif

                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$k->status}}','{{$k->id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-danger btn-sm" style="width: 50%;" {{($k->id == Auth::user()->id) ? 'disabled' : ''}}>
                                            <i class="mdi mdi-delete-forever"></i>Hapus
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            @endif
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="ModalEditTitle" style="color: white;">Edit Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" method="post">
                <div class="modal-body" style="background-color: white;">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div>
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="username">username <span style="color: red;">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="- username -" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span style="color: red;">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="- isi password -" minlength="8">
                        </div>
                        <div class="form-group">
                            <label for="verifPassword">Ulangi Password<span style="color: red;">*</span></label>
                            <input type="password" name="verifPassword" id="verifPassword" class="form-control" placeholder="- ulangi password -" minlength="8">
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" style="width: 50%;" class="btn btn-danger" onclick="edit.back()">Kembali</button>
                    <button type="submit" id="submitEdit" style="width: 50%;" class="btn btn-success" onclick="">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Hapus Data</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
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

@endsection

@push('js')
<script>
    var username = @json($username);

    isvalid = true;

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

    var usernameNow = null;

    var editNow = function(username) {
        usernameNow = username;
        $('.alertUsername').remove();
    }


    $('#formEdit').validate({
        rules: {
            verifPassword: {
                minlength: 8,
                equalTo: "#password"
            }
        },
        highlight: function(e) {
            $(e).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function(e) {
            $(e).closest('.form-control').removeClass('is-invalid');
            $(e).closest('.form-control').addClass('is-valid');
        },
        success: function(e) {
            $(e).closest('.form-control').removeClass('is-invalid');
            $(e).closest('.form-control').addClass('is-valid');
        },
    });


    var editRow = function(id, username) {

        $('input[name=id]').val(id);
        $('input[name=username]').val(username);

    }

    var editRowIbu = function(id, username) {

        $('.bayiAppend').remove();
        $('.kehamilanAppend').remove();
        $('#formTambahIbu').attr('action', "{{url('account_edit')}}");
        $('input[name=id_ibu]').val(id);
        $('input[name=username_ibu]').val(username);

        $.get("{{url('get_account/')}}" + '/' + id,
            function(data, textStatus, jqXHR) {
                $.each(data[0], function(i, v) {
                    id = v.bumils_id;
                    $('#listKehamilan').append(
                        `<tr class="kehamilanAppend kehamilanAppend_` + id + `">
                    <input type="hidden" name="list_ibu[` + id + `]" value="` + id + `">
                    <td><span class="badge badge-pill badge-light">` + v.nama_ibu + `</span></td>
                    <td><span class="badge badge-pill badge-light">` + v.nama_suami + `</span></td>
                    <td><span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="deleteKehamilanAppend(` + id + `)">
                        Hapus
                        </span></td>
                    </tr>`
                    )
                });
                $.each(data[1], function(i, v) {
                    id = v.bayi_id;
                    $('#listBayi').append(
                        `<tr class="bayiAppend bayiAppend_` + id + `">
                        <input type="hidden" name="list_bayi[` + id + `]" value="` + id + `">
                            <td><span class="badge badge-pill badge-light">` + v.nama + `</span></td>
                            <td><span class="badge badge-pill badge-light">` + v.nama_ibu + `</span></td>
                            <td><span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="deleteBayiAppend(` + id + `)">
                            Hapus
                            </span></td>
                        </tr>`
                    )
                });

            }
        );
    }



    $('#password').on('change', 'keyup', 'keypress', function() {
        if ($(this).val() != '') {
            $('#verifPassword').attr('required', true);
        } else {
            $('#verifPassword').attr('required', false);
        }
    })


    $('#formEdit').on('submit', function(e) {
        e.preventDefault();
        // $('#submitEdit').attr('disabled', true);

        if ($(this).valid()) {
            $.ajax({
                type: 'PUT',
                url: "{{url('account')}}" + '/' + $('input[name=id]').val() + '/edit',
                data: $(this).serialize(),
                success: function(m) {
                    if (m == 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Diedit'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 950);
                    } else {
                        ToastError.fire({
                            icon: 'error',
                            title: 'Gagal Diedit',
                            text: m
                        });
                    }
                }
            });
        }

    })

    var deleteId;
    var statusUser;
    var deleteRow = function(status, id) {
        deleteId = id;
        statusUser = status;
    }

    $('#modalConfirmYes').on('click', function() {
        $.ajax({
            type: "GET",
            url: "{{url('account')}}" + '/' + deleteId + '/delete',
            success: function(m) {
                if (m == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil '
                    });
                    setTimeout(function() {
                        window.location.reload();
                    }, 950);
                } else {
                    ToastError.fire({
                        icon: 'error',
                        title: 'Gagal ',
                        text: m
                    });
                }
            }
        });

    })

    function tambahAkunIbu() {

        $('#formTambahIbu').attr('action', "{{url('/account')}}");
        $('#formTambahIbu').trigger('reset');
        $('.bayiAppend').remove();
        $('.kehamilanAppend').remove();
        // reset state validasi supaya tidak terkunci dari mode edit / cek duplikat sebelumnya
        isvalid = true;
        usernameNow = null;
        $('.alertUsername').remove();
        $('#formTambahIbu').validate().resetForm();
        $('#formTambahIbu .form-control').removeClass('is-invalid is-valid');
        $('input[name=id_ibu]').val('');

    }
</script>
@endpush