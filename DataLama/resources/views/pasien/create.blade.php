@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        @if(isset($pasien))

                        <h2>Ubah Data Pasien</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>

                        @else
                        <h2>Data Pasien</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Pasien&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Tambah Data</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if(isset($pasien))

                    <form action="{{url('/pasien')}}/{{ $pasien->id }}/update" method="POST" id="formData">
                        {{ csrf_field() }}
                        @method('PUT')

                        @else
                        <form action="{{url('/pasien')}}" method="POST" id="formData">
                            {{ csrf_field() }}
                            @endif
                            <!-- ============PART 1============= -->
                            <div id="part_1">
                                <div class="form-row">
                                    @if(Auth::user()->status == 1)

                                    @if(isset($pasien))
                                    <div class="form-group col-md-6">
                                        <label>Posyandu <span style="color: red;">*</span> </label>
                                        <select name="posyandu_id" class="form-control" required>
                                            <option value="">Silahkan Pilih!</option>
                                            @foreach($list_posyandu as $lp)
                                            @if($lp->id == $pasien->posyandu_id)
                                            <option selected="true" value="{{$lp->id}}">{{$lp->nama}}</option>
                                            @else
                                            <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @else
                                    <div class="form-group col-md-6">
                                        <label>Posyandu <span style="color: red;">*</span> </label>
                                        <select name="posyandu_id" class="form-control" required>
                                            <option value="">Silahkan Pilih!</option>
                                            @foreach($list_posyandu as $lp)
                                            <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    @else
                                    <div class="form-group col-md-6">
                                        <label>Posyandu <span style="color: red;">*</span> </label>
                                        <select name="posyandu_id" class="form-control" readonly>
                                            <option value="">Silahkan Pilih!</option>
                                            @foreach($list_posyandu as $lp)
                                            @if($lp->id == session()->get('kader')->posyandu_id)
                                            <option selected="true" value="{{$lp->id}}">{{$lp->nama}}</option>
                                            @else
                                            <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                </div>
                                <input type="hidden" name="users_id" id="users_id" value="{{isset($pasien) ? $pasien->users_id : ''}}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>NIK <span style="color: red;">*</span> </label>
                                        <input type="text" name="nik" class="form-control" placeholder="NIK" minlength="16" maxlength="16" value="{{isset($pasien) ? $pasien->nik : ''}}">
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nama Lengkap <span style="color: red;">*</span> </label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{isset($pasien) ? $pasien->nama : ''}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Tempat Lahir <span style="color: red;">*</span> </label>
                                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{isset($pasien) ? $pasien->tempat_lahir : ''}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Tanggal Lahir <span style="color: red;">*</span> </label>
                                        <input type="date" onkeydown="return false" name="tgl_lahir" class="form-control datepicker" value="{{isset($pasien) ? $pasien->tgl_lahir : ''}}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Umur <span style="color: red;">*</span> </label>
                                        <div class="input-group-append">
                                            <input type="text" name="umur" class="form-control" readonly value="{{isset($pasien) ? $pasien->umur : ''}}">
                                            <button type="button" class="btn btn-sm btn-light">tahun</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Pekerjaan <span style="color: red;">*</span> </label>
                                        @if(isset($pasien))
                                        <select name="pekerjaan" class="form-control">
                                            <option value="Tidak Bekerja" @if($pasien->pekerjaan == 'Tidak Bekerja' ) selected @endif>Tidak Bekerja</option>
                                            <option value="Buruh/Petani" @if($pasien->pekerjaan == 'Buruh/Petani') selected @endif>Buruh/Petani</option>
                                            <option value="Nelayan" @if ($pasien->pekerjaan == 'Nelayan' ) selected @endif>Nelayan</option>
                                            <option value="Swasta" @if($pasien->pekerjaan == 'Swasta' ) selected @endif>Swasta</option>
                                            <option value="Wirausaha" @if($pasien->pekerjaan == 'Wirausaha' ) selected @endif>Wirausaha</option>
                                            <option value="Lainnya" @if($pasien->pekerjaan == 'Lainnya' ) selected @endif>Lainya</option>

                                        </select>
                                        @if($pasien->pekerjaan == 'Lainnya')
                                        <div class="form-group pekerjaan_lainnya">
                                            <label>Pekerjaan Lainnya <span style="color: red;">*</span> </label>
                                            <input type="text" name="pekerjaan_lainnya" class="form-control" value="{{$pasien->pekerjaan_lainnya}}">
                                        </div>
                                        @endif
                                        @else
                                        <select name="pekerjaan" class="form-control">
                                            <option value="">Silahkan Pilih!</option>
                                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                                            <option value="Buruh/Petani">Buruh/Petani</option>
                                            <option value="Nelayan">Nelayan</option>
                                            <option value="Swasta">Swasta</option>
                                            <option value="Wirausaha">Wirausaha</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <div class="form-group pekerjaan_lainnya" hidden="true">
                                            <label>Pekerjaan Lainnya <span style="color: red;">*</span> </label>
                                            <input type="text" name="pekerjaan_lainnya" class="form-control">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Pendidikan <span style="color: red;">*</span> </label>
                                        @if(isset($pasien))
                                        <select name="pendidikan" class="form-control">
                                            <option>Silahkan Pilih!</option>
                                            <option value="Tidak Sekolah" @if ($pasien->pendidikan == 'Tidak Sekolah' )selected @endif>Tidak Sekolah</option>
                                            <option value="SD/MI" @if ($pasien->pendidikan == 'SD/MI' )selected @endif>SD/MI</option>
                                            <option value="SMP/MTS" @if ($pasien->pendidikan == 'SMP/MTS' )selected @endif>SMP/MTS</option>
                                            <option value="SMK/MA" @if ($pasien->pendidikan == 'SMK/MA' )selected @endif>SMK/MA</option>
                                            <option value="S1" @if ($pasien->pendidikan == 'S1' )selected @endif>S1</option>
                                            <option value=">S2" @if ($pasien->pendidikan == 'S2' )selected @endif>S2</option>
                                            <option value=">S3" @if ($pasien->pendidikan == 'S3' )selected @endif>S3</option>
                                        </select>
                                        @else
                                        <select name="pendidikan" class="form-control">
                                            <option value="">Silahkan Pilih!</option>
                                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                                            <option value="SD/MI">SD/MI</option>
                                            <option value="SMP/MTS">SMP/MTS</option>
                                            <option value="SMK/MA">SMK/MA</option>
                                            <option value="S1">S1</option>
                                            <option value=">S2">S2</option>
                                            <option value=">S3">S3</option>
                                        </select>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <br><br>
                                        <button type="button" class="btn btn-sm btn-primary selanjutnya" onclick="allFunc.next(1)" style="width: 100%;">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                            <!-- ==========PART 2========= -->
                            <div id="part_2" hidden="true">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nama Suami <span style="color: red;">*</span> </label>
                                        <input type="text" name="nama_suami" class="form-control" placeholder="Nama Lengkap Suami" value="{{isset($pasien) ? $pasien->nama_suami : ''}}">
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>No KTP Suami <span style="color: red;">*</span> </label>
                                        <input type="text" name="nik_suami" class="form-control" placeholder="Nomor KTP" minlength="16" maxlength="16" value="{{isset($pasien) ? $pasien->nik_suami : ''}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>Umur Suami <span style="color: red;">*</span> </label>
                                        <input type="text" name="umur_suami" class="form-control" placeholder="Umur Suami" value="{{isset($pasien) ? $pasien->umur_suami : ''}}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Pendidikan Suami <span style="color: red;">*</span> </label>
                                        @if(isset($pasien))

                                        <select name="pendidikan_suami" class="form-control">
                                            <option>Silahkan Pilih!</option>
                                            <option value="Tidak Sekolah" @if ($pasien->pendidikan_suami == 'Tidak Sekolah' )selected @endif>Tidak Sekolah</option>
                                            <option value="SD/MI" @if ($pasien->pendidikan_suami == 'SD/MI' )selected @endif>SD/MI</option>
                                            <option value="SMP/MTS" @if ($pasien->pendidikan_suami == 'SMP/MTS' )selected @endif>SMP/MTS</option>
                                            <option value="SMK/MA" @if ($pasien->pendidikan_suami == 'SMK/MA' )selected @endif>SMK/MA</option>
                                            <option value="S1" @if ($pasien->pendidikan_suami == 'S1' )selected @endif>S1</option>
                                            <option value=">S2" @if ($pasien->pendidikan_suami == 'S2' )selected @endif>S2</option>
                                            <option value=">S3" @if ($pasien->pendidikan_suami == 'S3' )selected @endif>S3</option>
                                        </select>

                                        @else
                                        <select name="pendidikan_suami" class="form-control">
                                            <option value="">Silahkan Pilih!</option>
                                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                                            <option value="SD/MI">SD/MI</option>
                                            <option value="SMP/MTS">SMP/MTS</option>
                                            <option value="SMK/MA">SMK/MA</option>
                                            <option value="S1">S1</option>
                                            <option value=">S2">S2</option>
                                            <option value=">S3">S3</option>
                                        </select>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Pekerjaan Suami <span style="color: red;">*</span> </label>
                                        @if(isset($pasien))

                                        <select name="pekerjaan_suami" class="form-control">
                                            <option>Silahkan Pilih!</option>
                                            <option value="Tidak Bekerja" @if ($pasien->pekerjaan_suami == 'Tidak Bekerja' )selected @endif>Tidak Bekerja</option>
                                            <option value="Buruh/Petani" @if ($pasien->pekerjaan_suami == 'Buruh/Petani' )selected @endif>Buruh/Petani</option>
                                            <option value="Nelayan" @if ($pasien->pekerjaan_suami == 'Nelayan' )selected @endif>Nelayan</option>
                                            <option value="Swasta" @if ($pasien->pekerjaan_suami == 'Swasta' )selected @endif>Swasta</option>
                                            <option value="Wirausaha" @if ($pasien->pekerjaan_suami == 'Wirausaha' )selected @endif>Wirausaha</option>
                                            <option value="Lainnya" @if ($pasien->pekerjaan_suami == 'Lainnya' )selected @endif>Lainya</option>
                                        </select>
                                        @if($pasien->pekerjaan_suami == 'Lainnya')
                                        <div class="form-group pekerjaan_suami_lainnya">
                                            <label>Pekerjaan Lainnya <span style="color: red;">*</span> </label>
                                            <input type="text" name="pekerjaan_suami_lainnya" class="form-control" value="{{$pasien->pekerjaan_suami_lainnya}}">
                                        </div>
                                        @endif
                                        @else
                                        <select name="pekerjaan_suami" class="form-control">
                                            <option value="">Silahkan Pilih!</option>
                                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                                            <option value="Buruh/Petani">Buruh/Petani</option>
                                            <option value="Nelayan">Nelayan</option>
                                            <option value="Swasta">Swasta</option>
                                            <option value="Wirausaha">Wirausaha</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <div class="form-group pekerjaan_suami_lainnya" hidden="true">
                                            <label>Pekerjaan Lainnya <span style="color: red;">*</span> </label>
                                            <input type="text" name="pekerjaan_suami_lainnya" class="form-control">
                                        </div>
                                        @endif

                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="allFunc.back(1)">Kembali</button>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="button" class="btn btn-sm btn-primary selanjutnya_2" style="width: 100%;" onclick="allFunc.next(2)">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                            <div id="part_3" hidden="true">

                                <div class="form-group">
                                    <label for="inputAddress">Alamat Rumah <span style="color: red;">*</span> </label>
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat Rumah" value="{{isset($pasien) ? $pasien->alamat : ''}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Alamat Domisili <span style="color: red;">*</span> </label>
                                    <input type="text" name="alamat_domisili" class="form-control" placeholder="Alamat Domisili" value="{{isset($pasien) ? $pasien->alamat_domisili : ''}}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>RT/RW <span style="color: red;">*</span> </label>
                                        <input type="text" name="rw" class="form-control" value="{{isset($pasien) ? $pasien->rw : ''}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>No Telpon <span style="color: red;">*</span> </label>
                                        <input type="text" name="no_tlp" class="form-control" placeholder="No Telpon" value="{{isset($pasien) ? $pasien->no_tlp : ''}}" maxlength="13">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="kecamatan">Kecamatan <span style="color: red;">*</span> </label>
                                        <input type="text" name="kecamatan" class="form-control" id="kecamatan" value="{{isset($pasien) ? $pasien->kecamatan : ''}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Kabupaten <span style="color: red;">*</span> </label>
                                        <input type="text" name="kabupaten" class="form-control" id="kabupaten" value="{{isset($pasien) ? $pasien->kabupaten : ''}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputZip">Kota <span style="color: red;">*</span> </label>
                                        <input type="text" name="kota" class="form-control" id="inputZip" value="{{isset($pasien) ? $pasien->kota : ''}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="allFunc.back(2)">Kembali</button>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-sm btn-success selanjutnya_2" style="width: 100%;">Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')
<script>
    jQuery(document).ready(function($) {

        // $('.datepicker').datepicker({
        //     format: 'dd-mm-yyyy',
        //     autoclose: true
        // });

        $('#formData').validate({
            rules: {
                nik: {
                    // required: true,
                    minlength: 16,
                    maxlength: 16
                },
                nama: {
                    // required: true
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

        $('input[name=nik], input[name=umur], input[name=umur_suami], input[name=nik_suami], input[name=no_tlp]').on('keyup', function() {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        });

        $('input[name=nama], input[name=tempat_lahir], input[name=nama_suami], input[name=alamat], input[name=alamat_domisili], input[name=kecamatan], input[name=kabupaten], input[name=kota]').on('keyup', function() {

            capital = $(this).val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            $(this).val(capital);

        });

        var nik = @json($nik);
        var invalidNik = false;

        var isEdit = '{{isset($pasien)}}';

        if (isEdit == 1) {

            nik.splice($.inArray($('input[name=nik]').val(), nik), 1);

        }

        $('input[name=nik]').on('change click keyup keypress', function() {

            invalidNik = false;

            $('#alertNik').remove();

            if (jQuery.inArray($(this).val(), nik) != -1) {

                invalidNik = true;

                $(this).after('<p style="color: red;" id="alertNik">NIK telah terdaftar</p>');

            }

        });



        $('input[name=tgl_lahir]').on('change', function() {
            // console.log(this.val())
            // const ageFormat = moment('dd-mm-yyyy', $(this).val());
            const age = moment().diff($(this).val(), 'years');
            // console.log(age)
            $('input[name=umur]').val(age);
        });


        $('select[name=pekerjaan]').on('change', function() {

            if ($(this).val() == 'Lainnya') {

                $('.pekerjaan_lainnya').attr('hidden', false);

            } else {

                $('.pekerjaan_lainnya').attr('hidden', true);

            }

        });

        $('select[name=pekerjaan_suami]').on('change', function() {

            if ($(this).val() == 'Lainnya') {

                $('.pekerjaan_suami_lainnya').attr('hidden', false);

            } else {

                $('.pekerjaan_suami_lainnya').attr('hidden', true);

            }

        });


        $('#formData').on('submit', function(e) {

            if ($('#formData').valid()) {
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
                                window.location.href = "{{url('/pasien')}}";
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

            e.preventDefault();

        });

    });



    var allFunc = function() {
        var next = function(i) {
            const isValid = $('#formData').valid();
            if (isValid) {
                if (i == 1) {

                    $('#part_1').hide('slow', function() {
                        $(this).attr('hidden', true);
                    });
                    $('#part_2').attr('hidden', false).show('slow');

                } else if (i == 2) {
                    $('#part_2').hide('slow', function() {
                        $(this).attr('hidden', true);
                    });

                    $('#part_3').attr('hidden', false).show('slow');

                }
            }
        }

        var back = function(i) {
            if (i == 1) {
                $('#part_2').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('#part_1').attr('hidden', false).show('slow');
            } else if (i == 2) {
                $('#part_3').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('#part_2').attr('hidden', false).show('slow')
            }
        }



        allFunc.next = next;
        allFunc.back = back;
    }

    allFunc();
</script>
@endpush