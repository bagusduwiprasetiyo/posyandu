@extends('layouts.master')

@push('css')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endpush


@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">

                        <h2>Profile</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">profie</p>
                    </div>
                </div>
                <div>
                    <img src="{{asset('/assets/img/kagita.png')}}"/>
                    <a href="/create_kagita_user" class="btn btn-primary rounded-pill">Bikin User Kagita</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('kader'))
                    <form action="{{url('profile')}}" method="post" id="formKader">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="row">
                            <div class="part_1 col-sm-6">
                                <div class="form-group">
                                    <input type="hidden" name="kader_id" value="{{session()->get('kader')->id}}">
                                    <input type="hidden" name="posyandu_idEdit" value="{{session()->get('kader')->posyandu_id}}">
                                    <label for="namaEdit">Nama <span style="color: red;">*</span></label>
                                    <input type="text" name="namaEdit" id="namaEdit" class="form-control" placeholder="- isi nama anda -" required value="{{$data->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="nikEdit">NIK <span style="color: red;">*</span></label>
                                    <input type="text" name="nikEdit" id="nikEdit" class="form-control" placeholder="- isi NIK anda -" required maxlength="16" minlength="16" value="{{$data->nik}}">
                                </div>
                                <div class="form-group">
                                    <label for="alamatEdit">Alamat Lengkap <span style="color: red;">*</span></label>
                                    <input type="text" name="alamatEdit" id="alamatEdit" class="form-control" placeholder="- isi alamat anda -" required value="{{$data->alamat}}">
                                </div>
                                <small id="emailHelp" class="form-text text-muted"><i>- Isi jika anda memiliki email dan nomor telfon - </i></small>
                                <br>
                                <div class="form-group">
                                    <label for="emailEdit">Email</label>
                                    <input type="emailEdit" name="emailEdit" id="emailEdit" class="form-control" placeholder="- isi email anda -" value="{{$data->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="no_tlpEdit">No Telfon</label>
                                    <input type="text" name="no_tlpEdit" id="no_tlpEdit" class="form-control" placeholder="- isi no telfon anda -" value="{{$data->no_tlp}}">
                                </div>
                            </div>
                            <div class="part_2 col-sm-6">
                                <div class="form-group">
                                    <label for="regisUsernameEdit">Username <span style="color: red;">*</span></label>
                                    <input type="text" name="regisUsernameEdit" id="regisUsernameEdit" class="form-control" placeholder="- isi username yang anda inginkan -" required value="{{$data->username}}" minlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="regisPasswordEdit">Password <span style="color: red;">*</span></label>
                                    <input type="password" name="regisPasswordEdit" id="regisPasswordEdit" class="form-control" minlength="8">
                                </div>
                                <div class="form-group">
                                    <label for="verifRegisPasswordEdit">Ulangi Password <span style="color: red;">*</span></label>
                                    <input type="password" name="verifRegisPasswordEdit" id="verifRegisPasswordEdit" class="form-control" minlength="8">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <form action="{{url('profile')}}" method="post" id="formUser">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="row">
                            <div class="part_1 col-sm-6">
                                <input type="hidden" name="status" value="{{auth()->user()->status}}">
                                @if(Auth::user()->status == 1)
                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                    <label for="nama">Nama <span style="color: red;">*</span></label>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="- isi nama anda -" required value="{{$data->name}}">
                                </div>
                                @else
                                <div class="form-group" hidden="true">
                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                    <label for="nama">Nama <span style="color: red;">*</span></label>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="- isi nama anda -" required value="{{$data->name}}">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap <span style="color: red;">*</span></label>
                                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="- isi alamat anda -" required value="{{$data->alamat}}">
                                </div>
                                <small id="emailHelp" class="form-text text-muted"><i>- Isi jika anda memiliki email dan nomor telfon - </i></small>
                                <br>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="- isi email anda -" value="{{$data->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="no_tlp">No Telfon</label>
                                    <input type="text" name="no_tlp" id="no_tlp" class="form-control" placeholder="- isi no telfon anda -" value="{{$data->no_tlp}}">
                                </div>
                            </div>
                            <div class="part_2 col-sm-6">

                                <div class="form-group">
                                    <label for="regisUsername">Username</label>
                                    <input type="text" name="regisUsername" id="regisUsername" class="form-control" placeholder="- isi username yang anda inginkan -" required value="{{$data->username}}" minlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="regisPassword">Password <span style="color: red;">*</span></label>
                                    <input type="password" name="regisPassword" id="regisPassword" class="form-control" minlength="8">
                                </div>
                                <div class="form-group">
                                    <label for="verifPassword">Ulangi Password <span style="color: red;">*</span></label>
                                    <input type="password" name="verifPassword" id="verifPassword" class="form-control" minlength="8">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-sm" style="width: 100%;">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script>
    $('#formKader').validate({
        rules: {
            verifPassword: {
                minlength: 8,
                equalTo: "#regisPassword"
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
    $('#formUser').validate({
        rules: {
            verifPassword: {
                minlength: 8,
                equalTo: "#regisPassword"
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

    $('#regisPasswordEdit, #verifPasswordEdit').on('change keyup keypress', function() {
        if ($(this).val() != '') {
            $(this).prop('required', true);
        } else {
            $(this).prop('required', false);
        }
    });
    $('#regisPassword, #verifPassword').on('change keyup keypress', function() {
        if ($(this).val() != '') {
            $(this).prop('required', true);
        } else {
            $(this).prop('required', false);
        }
    });
    var username = @json($username);
    var sessionUsername = '{{Auth::user()->username}}';

    invalidUsername = false;

    $('input[name=regisUsernameEdit]').on('change keypress keyup', function() {

        $('#alertUsername').remove();
        invalidUsername = false;

        if (jQuery.inArray($(this).val(), username) != -1) {

            if ($(this).val() != sessionUsername) {
                $(this).after(`<p style="color:red;" id="alertUsername">Username tidak tersedia!</p>`);
                invalidUsername = true;
            }

        }

    });

    $('input[name=regisUsername]').on('change keypress keyup', function() {

        $('#alertUsername').remove();
        invalidUsername = false;

        if (jQuery.inArray($(this).val(), username) != -1) {

            if ($(this).val() != sessionUsername) {
                $(this).after(`<p style="color:red;" id="alertUsername">Username tidak tersedia!</p>`);
                invalidUsername = true;
            }

        }

    });

    $('#formKader').on('submit', function(e) {
        e.preventDefault();
        var kader = $('input[name=kader_id]').val();
        if ($(this).valid()) {
            $.ajax({
                type: 'PUT',
                url: "{{url('kader/')}}" + '/' + kader + '/update',
                data: $('#formKader').serialize(),
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
        }
    })
    $('#formUser').on('submit', function(e) {
        e.preventDefault();
        var id_user = $('input[name=user_id]').val();
        if ($(this).valid()) {
            $.ajax({
                type: 'PUT',
                url: "{{url('profile/')}}" + '/' + id_user + '/update',
                data: $('#formUser').serialize(),
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
        }
    })
</script>
@endpush