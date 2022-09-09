@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Tambah Data Puswus</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">puswus</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/puswus')}}" class="btn btn-primary mr-3 mt-2 mt-xl-0">
                            Kembali
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
                    <form action="{{url('puswus')}}" method="post" id="form_wuspus">
                        @csrf
                        <div id="part_1">
                            <div class="form-row">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-row fr-1">
                                                <div class="form-group col-md-6 ">
                                                    <label>Nama Wus/Pus<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="nama_wuspus" class="form-control form-control-sm" value="" required>
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Tanggal Lahir<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="date" name="tgl_lahir_wuspus" class="form-control form-control-sm" value="" onchange="getUmur(this)" required>
                                                    <code class="tgl_lahir_wuspus"></code>
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Nama Suami<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="nama_suami" class="form-control form-control-sm" value="">
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Tanggal Lahir<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="date" name="tgl_lahir_suami" class="form-control form-control-sm" value="" onchange="getUmur(this)">
                                                    <code class="tgl_lahir_suami"></code>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Posyandu <span style="color: red;">*</span> </label>
                                                    <select name="posyandu_id" class="form-control form-control-sm" required>
                                                        <option value="">Silahkan Pilih!</option>
                                                        @foreach($posyandu as $lp)
                                                        <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Tahapan KS<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="tahapan_ks" class="form-control form-control-sm" value="">
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>KLP Dasa Wisma<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="klp_dasa_wisma" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Jumlah Anak</h4>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 ">
                                                    <label>Yang Hidup<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="jml_anak_hidup" class="form-control form-control-sm" value="">
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Meninggal Pada Umur<span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="jml_anak_meninggal" class="form-control form-control-sm" value="">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 ">
                                                    <label>Pengukuran LILA < 23 cm<span style="color: red;">
                                                            *</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="ukuran_lila" class="form-control form-control-sm" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <br><br>
                                    <button type="button" class="btn btn-sm btn-primary selanjutnya" onclick="next(1)" style="width: 100%;">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                        <div id="part_2" hidden="true">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pemberian</h4>
                                    <br>
                                    <div class="form-row">
                                        <div class="col-md-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">

                                                    <h4 class="card-title">Pemberian Kapsul Yodium</h4>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-sm-12 text-center">
                                                            <button type="button" class="btn btn-light btn-sm add" style="width: 100%; background-color: #F3F3F3" onclick="kapsul_yodium(this)">+ Kapsul Yodium
                                                                Bulanan</button>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row" style="overflow-x: scroll;">

                                                        <table class="table table-sm table-hover text-center table-bordered" id="table_kapsul_yodium" style="min-width: 450px;">

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">

                                                    <h4 class="card-title">Pemberian Imunisasi TT</h4>
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-sm-12 text-center">
                                                            <button type="button" class="btn btn-light btn-sm add" style="width: 100%; background-color: #F3F3F3" onclick="imunisasi_tt(this)">+ Imunisasi TT</button>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row" style="overflow-x: scroll;">

                                                        <table class="table table-sm table-hover text-center table-bordered" id="table_imunisasi_tt" style="min-width: 450px;">

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mt-5">
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(2)">Kembali</button>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-primary selanjutnya" onclick="next(2)" style="width: 100%;">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                        <div id="part_3" hidden="true">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Keluarga Berencana</h4>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body" style="overflow-x: scroll;">
                                                    <h4 class="card-title">Jenis Alat Kontrasepsi</h4>
                                                    <br>
                                                    <p class="card-description">Anda
                                                        dapat<code>memilih beberapa alkon</code>yang
                                                        digunakan</p>

                                                    <div class="row">
                                                        <div class="col-sm-12 text-center">
                                                            <button type="button" class="btn btn-light btn-sm add" style="width: 100%; background-color: #F3F3F3" data-toggle="modal" data-target="#modalalkon">+ Tambah
                                                                Alkon</button>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <table class="table table-sm table-hover text-center table-bordered" id="table_alkon" style="min-width: 450px;">
                                                            <tr class="tr-alkon-awal" hidden>
                                                                <td></td>
                                                                <td>Jenis</td>
                                                                <td>Tanggal Mulai</td>
                                                                <td>Tanggal Berakhir</td>
                                                            </tr>




                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body" style="overflow-x: scroll;">
                                                    <h4 class="card-title">Pergantian Alat Kontrasepsi</h4>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-12 text-center">
                                                            <button type="button" class="btn btn-light btn-sm add" style="width: 100%; background-color: #F3F3F3" onclick="pergantian_alkon(this)">+ Tambah
                                                                Pergantian
                                                                Alkon</button>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <table class="table table-sm table-hover text-center table-bordered" id="table_pergantian_alkon" style="min-width: 450px;">

                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <br>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Keterangan</h4>
                                        <div class="form-group">
                                            <textarea class="form-control" style="background-color: #F3F3F3;" id="keterangan" name="keterangan" rows="4"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(3)">Kembali</button>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-sm btn-success selanjutnya_2" style="width: 100%;">Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalalkon" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Tambah data alkon</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white;">
                <div class="row">
                    <div class="col-sm-12 mt-2">
                        <select name="selectalkon" class="form-control selectpicker" data-live-search="true">
                            <option value="">- Pilih Jenis Alkon -</option>
                            @foreach($jenis_alkon as $alkon)
                            <option value="{{$alkon}}">{{$alkon}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
                    </div>
                    <div class="col-sm-6  mt-4">
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="addalkon('add')">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{asset('assets/js/moment.js')}}"></script>
<script>
    // ########## UMUR ##############
    var getUmur = (e) => {
        date = moment($(e).val())
        now = moment()

        year = date.diff(now, 'years')
        now.add(year, 'years')

        month = date.diff(now, 'months')
        now.add(month, 'months')

        day = date.diff(now, 'days')
        $('.' + $(e).attr('name')).text(Math.abs(year) + ' tahun, ' + Math.abs(month) + ' bulan, ' + +Math.abs(day) + ' hari')

    }

    $(function() {
        $('form').validate({
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
    })

    function next(num) {
        if ($('form').valid()) {
            if ($('#part_' + (num + 1)).length > 0) {
                $('#part_' + num).hide('slow', function() {
                    $(this).attr('hidden', true)
                })
                $('#part_' + (num + 1)).attr('hidden', false).show('slow')
            }
        }
    }


    function back(num) {
        $('#part_' + num).hide().attr('hidden', true)
        $('#part_' + (num - 1)).attr('hidden', false).show('slow')
    }


    // ################## KAPSUL YODIUM BULANAN ########################
    var kapsul_yodium = (e) => {
        num_el = $('.tb_kapsul_yodium').length + 1
        rand = Math.floor(Math.random() * 1000)
        if ($(e).hasClass('add')) {
            $('#table_kapsul_yodium').append(
                `<tr class="mt-3 tb_kapsul_yodium"> <td style="width: 10%;"> <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="kapsul_yodium(this)"> <i class="mdi mdi-delete-forever"></i> </button> </td> <td style="width:50"><div class="input-group"> <div class="input-group-append"> <button type="button" class="btn btn-sm btn-light">Pemberian ke - </button> </div> <input type="number" class="form-control-sm form-control" style="background-color: #F3F3F3" name="imunisasi[kapsul_yodium][` + rand + `][]" min="1" value="` + num_el + `" required></input> </div></td><td style="width: 40%;"> <input type="date" name="imunisasi[kapsul_yodium][` + rand + `][]" class="form-control form-control-sm" required> </td> </tr>`
            )
        } else {
            $(e).parent().parent().remove()
        }
    }

    // ################## Imunisasi TT ########################
    var imunisasi_tt = (e) => {
        num_el = $('.tb_imunisasi_tt').length + 1
        rand = Math.floor(Math.random() * 1000)
        if ($(e).hasClass('add')) {
            if ($('.tb_imunisasi_tt').length < 5) {
                $('#table_imunisasi_tt').append(
                    `<tr class="mt-3 tb_imunisasi_tt"> <td style="width: 10%;"> <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="imunisasi_tt(this)"> <i class="mdi mdi-delete-forever"></i> </button> </td> <td style="width:50"><div class="input-group"> <div class="input-group-append"> <button type="button" class="btn btn-sm btn-light">Imunisasi - </button> </div> <input type="number" class="form-control-sm form-control" style="background-color: #F3F3F3" name="imunisasi[imunisasi_tt][` + rand + `][]" min="1" value="` + num_el + `" required></input> </div></td><td style="width: 40%;"> <input type="date" name="imunisasi[imunisasi_tt][` + rand + `][]" class="form-control form-control-sm" required> </td> </tr>`
                )
            }
        } else {
            $(e).parent().parent().remove()
        }
    }

    // ################## Tambah Alkon ########################
    var addalkon = (fun) => {

        if (fun == 'add') {
            $('#modalalkon').modal('hide');
            rand = Math.floor(Math.random() * 1000)
            varalkon = $('select[name=selectalkon]').val()
            $('#table_alkon').append(
                `<tr class="mt-3 tr-alkon"> <td style="width: 10%;"> <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="addalkon(this)"> <i class="mdi mdi-delete-forever"></i> </button> </td> <td>${varalkon}</td> <td style="width: 40%;"> <input type="hidden" name="kb[alkon][${rand}][]" class="form-control form-control-sm" value="${varalkon}" required> <input type="date" name="kb[alkon][${rand}][]" class="form-control form-control-sm" required> </td> <td> <input type="date" name="kb[alkon][${rand}][]" class="form-control form-control-sm"> </td> </tr>`
            );
        } else {
            $(fun).parent().parent().remove()
        }

        if ($('.tr-alkon').length > 0) {
            $('.tr-alkon-awal').attr('hidden', false)
        } else {
            $('.tr-alkon-awal').attr('hidden', true)
        }

    }


    // ################## Pergantian Alkon ########################
    let alkon = @json($jenis_alkon);

    var pergantian_alkon = (e) => {
        rand = Math.floor(Math.random() * 1000)
        option = ''
        $.each(alkon, function(i, v) {
            option = option + `<option value="` + v + `">` + v + `</option>`
        });

        if ($(e).hasClass('add')) {
            if ($('.tb_pergantian_alkon').length < 5) {
                $('#table_pergantian_alkon').append(
                    `<tr class="mt-3 tb_pergantian_alkon"> <td style="width: 10%;"> <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="pergantian_alkon(this)"> <i class="mdi mdi-delete-forever"></i> </button> </td> <td style="width:50"><select name="kb[pergantian_alkon][` + rand + `][]" class="form-control" data-live-search="true" required>
                        <option value="">- pilih alkon -</option>` + option + `
                    </select></td><td style="width: 40%;"> <input type="date" name="kb[pergantian_alkon][` + rand + `][]" class="form-control form-control-sm" required> </td> </tr>`
                )
            }
        } else {
            $(e).parent().parent().remove()
        }
    }


    // ################ SUBMIT ##################
    $('#form_wuspus').on('submit', function(e) {
        e.preventDefault()
        if ($(this).valid()) {
            $('button[type=submit]').attr('disabled', true)
            setTimeout(() => {
                $('button[type=submit]').attr('disabled', false)
            }, 3000);

            $.ajax({
                type: "post",
                url: "{{url('puswus')}}",
                data: $('#form_wuspus').serialize(),
                success: function(response) {
                    notif(response.status, response.message, "{{url('puswus/')}}")
                }
            });
        }
    })
</script>

@endpush