@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap page-header-modern">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2 class="page-title-modern">Data Kader</h2>
                        <p class="mb-md-0 text-muted">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex breadcrumb-modern">
                        <i class="mdi mdi-home text-muted"></i>
                        <p class="text-muted mb-0">&nbsp;/&nbsp;Posyandu&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 font-weight-bold">Data Kader</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <button type="button" data-toggle="modal" data-target="#modalRegis" class="btn btn-primary btn-modern btn-sm mt-2 mt-xl-0">
                            <i class="mdi mdi-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card card-modern">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="tableData" class="table table-modern table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Posyandu</th>
                                <th>Alamat</th>
                                <th>Username</th>
                                <th>No Telfon</th>
                                <th>Email</th>
                                <th>Terdaftar</th>
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

                                        <a onclick="actionTable.editRow('{{$k->kader_id}}');editUsernameNow('{{$k->username}}')" data-toggle="modal" data-target="#modalEdit" class="btn btn-success btn-sm" style="width: 50%;">
                                            <i class="mdi mdi-tooltip-edit"></i>Edit
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="ModalEditTitle" style="color: white;">Edit Data Kader</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" method="post">
                <div class="modal-body" style="background-color: white;">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="part_1Edit">

                        <div class="form-group">
                            <label for="namaEdit">Nama <span style="color: red;">*</span></label>
                            <input type="text" name="namaEdit" id="namaEdit" class="form-control" placeholder="- isi nama kader -" required>
                        </div>
                        <div class="form-group">
                            <label for="nikEdit">NIK <span style="color: red;">*</span></label>
                            <input type="text" name="nikEdit" id="nikEdit" class="form-control" placeholder="- isi NIK kader -" required maxlength="16" minlength="16">
                        </div>
                        <div class="form-group">
                            <label for="alamatEdit">Alamat Lengkap <span style="color: red;">*</span></label>
                            <input type="text" name="alamatEdit" id="alamatEdit" class="form-control" placeholder="- isi alamat kader -" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted"><i>- Isi jika kader memiliki email dan nomor telfon - </i></small>
                        <br>
                        <div class="form-group">
                            <label for="emailEdit">Email</label>
                            <input type="email" name="emailEdit" id="emailEdit" class="form-control" placeholder="- isi email kader -">
                        </div>
                        <div class="form-group">
                            <label for="no_tlpEdit">No Telfon</label>
                            <input type="text" name="no_tlpEdit" id="no_tlpEdit" class="form-control" placeholder="- isi no telfon kader -">
                        </div>
                    </div>
                    <div class="part_2Edit" hidden="true">
                        <div class="form-group">
                            <label for="regisUsernameEdit">Username <span style="color: red;">*</span></label>
                            <input type="text" name="regisUsernameEdit" id="regisUsernameEdit" class="form-control" placeholder="- isi username yang kader inginkan -" required>
                        </div>
                        <small class="form-text text-muted" style="color: red"><i id="posyanduHelp">- isi jika ingin mengganti password - </i></small>
                        <br>
                        <div class="form-group">
                            <label for="regisPasswordEdit">Password <span style="color: red;">*</span></label>
                            <input type="password" name="regisPasswordEdit" id="regisPasswordEdit" class="form-control" minlength="8">
                        </div>
                        <div class="form-group">
                            <label for="verifPasswordEdit">Verifikasi Password <span style="color: red;">*</span></label>
                            <input type="password" name="verifPasswordEdit" id="verifPasswordEdit" class="form-control" minlength="8">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <small class="form-text text-muted" style="color: red"><i id="posyanduHelp">- nama posyandu wajib dipilih - </i></small>
                                <br>
                                <label>Posyandu</label>
                                <br>
                                <select name="posyandu_idEdit" id="posyandu_idEdit" class="form-control">
                                    <option value="">- Silahkan Pilih Posyandu -</option>
                                    @foreach($list_posyandu as $lp)
                                    <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                    @endforeach
                                </select>
                                <br><br>
                                <input type="hidden" name="complete" required>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer part_1Edit">
                    <button type="button" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="edit.next()" style="width: 50%;" class="btn btn-success" onclick="">Selanjutnya</button>
                </div>
                <div class="modal-footer part_2Edit" hidden="true">
                    <button type="button" style="width: 50%;" class="btn btn-danger" onclick="edit.back()">Kembali</button>
                    <button type="submit" id="submitRegis" style="width: 50%;" class="btn btn-success" onclick="">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalRegis" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Daftar Menjadi Kader Posyandu</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRegistrasi" method="post" action="{{url('/postregistrationadmin/')}}">
                <div class="modal-body" style="background-color: white;">
                    {{ csrf_field() }}
                    <div class="part_1">
                        <br>
                        @if(session()->has('registrasiSuccess'))
                        <div class="alert alert-success" role="alert" style="font-size: 12px; width: 100%;"><i class="fa fa-exclamation-triangle"></i>
                            {{session()->get('registrasiSuccess')}}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="nama">Nama <span style="color: red;">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="- isi nama anda -" required>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK <span style="color: red;">*</span></label>
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="- isi NIK anda -" required maxlength="16" minlength="16">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap <span style="color: red;">*</span></label>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="- isi alamat anda -" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted"><i>- Isi jika anda memiliki email dan nomor telfon - </i></small>
                        <br>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="- isi email anda -">
                        </div>
                        <div class="form-group">
                            <label for="no_tlp">No Telfon</label>
                            <input type="text" name="no_tlp" id="no_tlp" class="form-control" placeholder="- isi no telfon anda -">
                        </div>
                    </div>
                    <div class="part_2" hidden="true">
                        <div class="form-group">
                            <label for="regisUsername">Username <span style="color: red;">*</span></label>
                            <input type="text" name="regisUsername" id="regisUsername" class="form-control" placeholder="- isi username yang anda inginkan -" required>
                        </div>
                        <div class="form-group">
                            <label for="regisPassword">Password <span style="color: red;">*</span></label>
                            <input type="password" name="regisPassword" id="regisPassword" class="form-control" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <label for="verifRegisPassword">Ulangi Password <span style="color: red;">*</span></label>
                            <input type="password" name="verifRegisPassword" id="verifRegisPassword" class="form-control" minlength="8" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <small class="form-text text-muted" style="color: red"><i id="posyanduHelp">- nama posyandu wajib dipilih - </i></small>
                                <br>
                                <label>Posyandu</label>
                                <br>
                                <select name="posyandu_id" id="posyandu_id" class="form-control">
                                    <option value="">- Silahkan Pilih Posyandu -</option>
                                    @foreach($list_posyandu as $lp)
                                    <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                    @endforeach
                                </select>
                                <br><br>
                                <input type="hidden" name="complete" required>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer part_1">
                    <button type="button" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="registrasi.next()" style="width: 50%;" class="btn btn-success" onclick="">Selanjutnya</button>
                </div>
                <div class="modal-footer part_2" hidden="true">
                    <button type="button" style="width: 50%;" class="btn btn-danger" onclick="registrasi.back()">Kembali</button>
                    <button type="submit" id="submitRegis" style="width: 50%;" class="btn btn-success" onclick="">Registrasi</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalDetailsTitle" style="color: white;"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white; padding: 4px;">

                <table id="tableDetails">

                </table>

            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    .page-title-modern {
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #1a2333;
        margin-bottom: 2px;
    }

    .breadcrumb-modern {
        opacity: 0.85;
        font-size: 0.85rem;
    }

    .btn-modern {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.55rem 1.1rem;
        box-shadow: 0 4px 10px rgba(66, 103, 178, 0.18);
    }

    .card-modern {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(20, 30, 60, 0.06);
    }

    .table-modern {
        border-collapse: separate;
        border-spacing: 0 6px;
    }

    .table-modern thead th {
        border: none;
        background-color: #f4f6fb;
        color: #5c6b8a;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        padding: 12px 10px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-modern thead th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .table-modern thead th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .table-modern tbody tr {
        background-color: #fff;
    }

    .table-modern tbody td {
        border-top: 1px solid #eef1f8;
        border-bottom: 1px solid #eef1f8;
        vertical-align: middle;
        color: #1a2333;
    }

    .table-modern tbody td:first-child {
        border-left: 1px solid #eef1f8;
        border-radius: 10px 0 0 10px;
    }

    .table-modern tbody td:last-child {
        border-right: 1px solid #eef1f8;
        border-radius: 0 10px 10px 0;
    }
</style>
@endpush

@push('js')

<script>
    var isDetails = false;
    var details = function() {
        $('#modalDetails').modal('show');
    }

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
        $('#regisPasswordEdit, #verifPasswordEdit').on('change keyup keypress', function() {
            if ($(this).val() != '') {
                $(this).prop('required', true);
            } else {
                $(this).prop('required', false);
            }
        });

        var editRow = function(id) {
            $.get(`{{url('/kader/` + id + `/detail')}}`, function(m) {
                $.each(m, function(i, v) {
                    $('#formEdit').prop('action', `{{url('kader/` + v.kader_id + `/update')}}`);
                    $('input[name=namaEdit]').val(v.name);
                    $('input[name=nikEdit]').val(v.nik);
                    $('input[name=alamatEdit]').val(v.alamat);
                    $('input[name=emailEdit]').val(v.email);
                    $('input[name=no_tlpEdit]').val(v.no_tlp);
                    $('input[name=regisUsernameEdit]').val(v.username);
                    $('#posyandu_idEdit').find('option[value=' + v.posyandu_id + ']').prop('selected', true);
                })

            });



            $('#formEdit').on('submit', function(e) {
                e.preventDefault();

                if ($(this).valid()) {
                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
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
                                    text: m
                                });

                            }
                        }
                    });
                }
            });

        }


        var deleteRow = function(id) {

            $('#modalConfirmTitle').text('Apakah kader ingin menghapus?');
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
                        text: m
                    });
                }
            });
        }


        actionTable.editRow = editRow;

        actionTable.deleteRow = deleteRow;
        actionTable.hapus = hapus;
    }

    actionTable();



    var edit = function() {


        $('#formEdit').validate({
            rules: {
                verifPasswordEdit: {
                    minlength: 8,
                    equalTo: "#regisPasswordEdit"
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

        $('input[name=no_tlpEdit], input[name=nikEdit]').on('keyup', function() {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        });

        $('input[name=namaEdit], input[name=alamatEdit]').on('keyup', function() {

            capital = $(this).val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            $(this).val(capital);

        });


        var next = function() {
            if ($('#formEdit').valid()) {
                $('.part_1Edit').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('.part_2Edit').attr('hidden', false).show('slow');

            }
        }

        var back = function() {
            $('.part_2Edit').hide('slow', function() {
                $(this).attr('hidden', true);
            });

            $('.part_1Edit').attr('hidden', false).show('slow');
        }


        edit.next = next;
        edit.back = back;

    }

    edit();

    var registrasi = function() {


        $('#formRegistrasi').validate({
            rules: {
                verifRegisPassword: {
                    equalTo: '#regisPassword'
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

        $('input[name=no_tlp], input[name=nik]').on('keyup', function() {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        });

        $('input[name=nama], input[name=alamat]').on('keyup', function() {

            capital = $(this).val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            $(this).val(capital);

        });


        var invalidNik = false;
        var nik = @json($nik);

        $('input[name=nik]').on('change keyup keypress', function() {

            $('#alertNik').remove();
            invalidNik = false;

            if (jQuery.inArray($(this).val(), nik) != -1) {

                $(this).after(`<p style="color:red;" id="alertNik">Nik telah terdaftar!</p>`);

                invalidNik = true;

            }
        });


        var username = @json($username);
        invalidUsername = false;

        $('input[name=regisUsername]').on('change keypress keyup', function() {

            $('#alertUsername').remove();
            invalidUsername = false;

            if (jQuery.inArray($(this).val(), username) != -1) {

                $(this).after(`<p style="color:red;" id="alertUsername">Username tidak tersedia!</p>`);

                invalidUsername = true;

            }

        });

        $('input[name=regisUsernameEdit]').on('change keypress keyup', function() {

            $('#alertUsername').remove();
            invalidUsername = false;

            if (jQuery.inArray($(this).val(), username) != -1) {

                if ($(this).val() != editNow) {
                    $(this).after(`<p style="color:red;" id="alertUsername">Username tidak tersedia!</p>`);

                    invalidUsername = true;
                }

            }

        });






        var next = function() {
            if ($('#formRegistrasi').valid() && !invalidNik) {
                $('.part_1').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('.part_2').attr('hidden', false).show('slow');

            }
        }

        var back = function() {
            $('.part_2').hide('slow', function() {
                $(this).attr('hidden', true);
            });

            $('.part_1').attr('hidden', false).show('slow');
        }

        $('#formRegistrasi').on('submit', function(e) {
            e.preventDefault();
            if ($(this).valid() && !invalidUsername) {

                if ($('#posyandu_id').val() != '') {
                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(m) {
                            if (m == 'success') {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Berhasil Disimpan'
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 950);
                            } else {
                                ToastError.fire({
                                    icon: 'error',
                                    title: 'Gagal Disimpan',
                                });

                                console.log(m)
                            }
                        }
                    });

                } else {
                    $('#posyanduHelp').attr('style', 'color:red;');
                }
            }
        });

        registrasi.next = next;
        registrasi.back = back;

    }

    registrasi();

    var editNow = null;

    function editUsernameNow(username) {
        editNow = username;
    }
</script>

@endpush
