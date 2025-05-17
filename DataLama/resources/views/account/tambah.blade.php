<style>
    ::-webkit-scrollbar {
        display: none;
    }

    .modal {
        overflow: auto !important;
    }
</style>
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Tambah Akun Ibu Hamil</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTambahIbu" method="post" action="{{url('/account')}}">
                <input type="hidden" name="user_ibu" value="1">
                <div class="modal-body" style="background-color: white;">
                    <div class="modal-body" style="background-color: white; overflow-y: scroll;">
                        {{ csrf_field() }}
                        @method('POST')
                        <div>
                            <input type="hidden" name="id_ibu">
                            <div class="form-group">
                                <label for="username_ibu">username <span style="color: red;">*</span></label>
                                <input type="text" name="username_ibu" class="form-control" placeholder="- username -" required>
                            </div>
                            <div class="form-group">
                                <label for="password_ibu">Password <span style="color: red;">*</span></label>
                                <input type="password" name="password_ibu" class="form-control" placeholder="- isi password -" minlength="8">
                            </div>
                            <div class="form-group">
                                <label for="verifPassword_ibu">Ulangi Password<span style="color: red;">*</span></label>
                                <input type="password" name="verifPassword_ibu" class="form-control" placeholder="- ulangi password -" minlength="8">
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalKehamilan" style="width: 100%;">tambah Data Kehamilan</button>

                            <div class="col-sm-12" style="overflow-x: scroll;">
                                <table class="table table-sm table-bordered mt-3 text-center" id="listKehamilan">
                                    <tr>
                                        <td><span class="badge badge-pill badge-light">Ibu</span></td>
                                        <td><span class="badge badge-pill badge-light">Suami</span></td>
                                        <td><span class="badge badge-pill badge-light">Aksi</span></td>
                                    </tr>

                                </table>
                            </div>

                            <button type="button" class="btn btn-sm btn-primary mt-3" data-toggle="modal" data-target="#modalBayi" style="width: 100%;">tambah Data Bayi</button>

                            <div class="col-sm-12" style="overflow-x: scroll;">
                                <table class="table table-sm table-bordered mt-3 text-center" id="listBayi">
                                    <tr>
                                        <td><span class="badge badge-pill badge-light">Bayi</span></td>
                                        <td><span class="badge badge-pill badge-light">Ibu</span></td>
                                        <td><span class="badge badge-pill badge-light">Aksi</span></td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                    <button type="submit" style="width: 50%;" class="btn btn-success" onclick="">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalKehamilan" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Pilih Relasi Kehamilan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php

            if(!session()->has('kader')){
            $kehamilan = DB::select(DB::raw('select * from bumils'));
            }else{
            $kehamilan = DB::select(DB::raw('select * from bumils where posyandu_id = '. session()->get('kader')->posyandu_id));
            }

            @endphp
            <div class="modal-body" style="background-color: white; overflow-x: scroll;">
                <table id="tableKehamilan" class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Nama Ibu</th>
                            <th>Nama Suami</th>
                            <th>Posyandu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kehamilan as $v)
                        <tr>
                            <td>
                                <input type="checkbox" name="kehamilan" value="{{$v->id}}" />&nbsp;
                                <input type="hidden" name="nama_ibu" class="{{$v->id}}" value="{{$v->nama_ibu}}">
                                <input type="hidden" name="nama_suami" class="{{$v->id}}" value="{{$v->nama_suami}}">
                            </td>
                            <td>
                                {{$v->nama_ibu}}
                            </td>
                            <td>
                                {{$v->nama_suami}}
                            </td>
                            <td>
                                @php
                                $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where id = '.$v->posyandu_id));
                                @endphp
                                {{$posyandu[0]->nama}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="addKehamilan" style="width: 50%;" class="btn btn-success" onclick="tambahKehamilan()">Tambah</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modalBayi" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Pilih Relasi Bayi</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php

            if(!session()->has('kader')){
            $bayi = DB::select(DB::raw('select * from bayi'));
            }else{
            $bayi = DB::select(DB::raw('select * from bayi where posyandu_id = '. session()->get('kader')->posyandu_id));
            }

            @endphp
            <div class="modal-body" style="background-color: white; overflow-x: scroll;">
                <table id="tableBayi" class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Nama Bayi</th>
                            <th>Nama Ibu</th>
                            <th>Posyandu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bayi as $v)
                        <tr>
                            <td>
                                <input type="checkbox" name="bayi" value="{{$v->id}}" />&nbsp;
                                <input type="hidden" name="nama_bayi" class="{{$v->id}}" value="{{$v->nama}}">
                                <input type="hidden" name="nama_ibu_bayi" class="{{$v->id}}" value="{{$v->nama_ibu}}">
                            </td>
                            <td>
                                {{$v->nama}}
                            </td>
                            <td>
                                {{$v->nama_ibu}}
                            </td>
                            <td>
                                @php
                                $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where id = '.$v->posyandu_id));
                                @endphp
                                {{$posyandu[0]->nama}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="addKehamilan" style="width: 50%;" class="btn btn-success" onclick="tambahBayi()">Tambah</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Tambah Akun Admin</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTambahAdmin" method="post" action="{{url('/add_admin')}}">
                <div class="modal-body" style="background-color: white;">
                    <div class="modal-body" style="background-color: white;">
                        {{ csrf_field() }}
                        @method('POST')
                        <div>
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="usernameAdmin">username <span style="color: red;">*</span></label>
                                <input type="text" name="usernameAdmin" id="usernameAdmin" class="form-control" placeholder="- username -" required>
                            </div>
                            <div class="form-group">
                                <label for="passwordAdmin">Password <span style="color: red;">*</span></label>
                                <input type="password" name="passwordAdmin" id="passwordAdmin" class="form-control" placeholder="- isi password -" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <label for="verifPasswordAdmin">Ulangi Password<span style="color: red;">*</span></label>
                                <input type="password" name="verifPasswordAdmin" id="verifPasswordAdmin" class="form-control" placeholder="- ulangi password -" minlength="8" required>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer part_2">
                    <button type="button" style="width: 50%;" class="btn btn-danger" onclick="registrasi.back()">Kembali</button>
                    <button type="submit" id="submitRegis" style="width: 50%;" class="btn btn-success" onclick="">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $('input[name=username_ibu]').on('keyup keypress change', function() {
        $('.alertUsername').remove();

        if (jQuery.inArray($(this).val(), username) != -1) {
            if ($(this).val() != usernameNow) {
                $(this).after('<p style="color: red" class="alertUsername">Username tidak bisa digunakan!</p>');
                isvalid = false;
            }

        } else {
            isvalid = true;
            $('.alertUsername').remove();

        }
    });


    $('#formTambahAdmin').validate({
        rule: {
            verifPasswordAdmin: {
                equalTo: '#passwordAdmin'
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
    })


    $('#formTambahAdmin').on('submit', function(e) {
        e.preventDefault();
        if ($(this).valid() && isvalid) {
            $.ajax({
                type: "POST",
                url: "{{url('/add_admin')}}",
                data: $('#formTambahAdmin').serialize(),
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
            });
        }
    })


    $('input[name=usernameAdmin]').on('keyup keypress change', function() {
        $('.alertUsername').remove();

        if (jQuery.inArray($(this).val(), username) != -1) {

            $(this).after('<p style="color: red" class="alertUsername">Username tidak bisa digunakan!</p>');
            isvalid = false;

        } else {
            isvalid = true;
            $('.alertUsername').remove();

        }
    });

    $('#formTambahIbu').validate({
        rules: {
            username_ibu: {
                minlength: 5
            },
            verifPassword_ibu: {
                minlength: 8,
                equalTo: "input[name=password_ibu]"
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


    $('#tableKehamilan').DataTable({
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

    $('#tableBayi').DataTable({
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

    var tambahKehamilan = function() {
        $('.kehamilanAppend').remove();
        $('input[name=kehamilan]:checked').each(function(i) {
            id = $(this).val()
            $('#listKehamilan').append(
                `<tr class="kehamilanAppend kehamilanAppend_` + id + `">
                    <input type="hidden" name="list_ibu[` + id + `]" value="` + id + `">
                    <td><span class="badge badge-pill badge-light">` + $('input[name=nama_ibu].' + id).val() + `</span></td>
                    <td><span class="badge badge-pill badge-light">` + $('input[name=nama_suami].' + id).val() + `</span></td>
                    <td><span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="deleteKehamilanAppend(` + id + `)">
                    Hapus
                    </span></td>
                </tr>`
            )
        })

        $('#modalKehamilan').modal('hide');
    }

    var deleteKehamilanAppend = function(id) {
        $('.kehamilanAppend_' + id).remove();
    }

    var tambahBayi = function() {
        $('.bayiAppend').remove();
        $('input[name=bayi]:checked').each(function(i) {
            id = $(this).val()
            $('#listBayi').append(
                `<tr class="bayiAppend bayiAppend_` + id + `">
                <input type="hidden" name="list_bayi[` + id + `]" value="` + id + `">
                    <td><span class="badge badge-pill badge-light">` + $('input[name=nama_bayi].' + id).val() + `</span></td>
                    <td><span class="badge badge-pill badge-light">` + $('input[name=nama_ibu_bayi].' + id).val() + `</span></td>
                    <td><span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="deleteBayiAppend(` + id + `)">
                    Hapus
                    </span></td>
                </tr>`
            )
        })

        $('#modalBayi').modal('hide');
    }

    var deleteBayiAppend = function(id) {
        $('.bayiAppend_' + id).remove();
    }


    $('#formTambahIbu').on('submit', function(e) {
        e.preventDefault();

        if ($(this).valid() && isvalid) {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
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
            });
        }
    })
</script>
@endpush