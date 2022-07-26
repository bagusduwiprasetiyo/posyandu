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
                        <h2>Data Bayi</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">bayi</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/bayi')}}" class="btn btn-primary mr-3 mt-2 mt-xl-0">
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
                    <form action="{{url('/bayi')}}" method="POST" id="formData">
                        {{ csrf_field() }}

                        <!-- ============PART 1============= -->

                        <div id="part_1">
                            <div class="form-row">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>Data Orang Tua</h4>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 mb-3">
                                                    <!-- <select name="pasien_id" class="form-control selectpicker mt-3" data-live-search="true">
                                                        <option value="">- pilih dari pasien -</option>
                                                        @foreach ($pasien as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                        <option value="0">- Tidak ada di daftar -</option>
                                                    </select> -->
                                                    <!-- <p style="color: red;" id="pasien_id_required" hidden="true">pilih pasien !</p> -->
                                                </div>


                                            </div>
                                            <div class="form-row nama_ibu">
                                                <div class="form-group col-md-6 ">
                                                    <label>Nama Ibu <span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="nama_ibu" class="form-control form-control-sm" value="" required>
                                                </div>
                                                <div class="form-group col-md-6 ">
                                                    <label>Nama Ayah <span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="nama_ayah" class="form-control form-control-sm" value="" required>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Posyandu <span style="color: red;">*</span> </label>
                                                    <select name="posyandu_id" class="form-control form-control-sm" required>
                                                        <option value="">Silahkan Pilih!</option>
                                                        @foreach($list_posyandu as $lp)
                                                        <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4 class="card-title">Data Bayi</h4>
                                            <br>
                                            <div class="form-row">
                                                <div class="form-group col-md-4 ">
                                                    <label>Nama Bayi <span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="nama_bayi" class="form-control form-control-sm" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label>Tanggal Lahir <span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="date" name="tanggal_lahir" class="form-control form-control-sm" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Berat Badan / Panjang Badan <span style="color: red;">*</span></label>
                                                    <input style="background-color: #F3F3F3;" type="text" name="bb_pb" class="form-control form-control-sm" value="">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Jenis Kelamin <span style="color: red;">*</span></label>
                                                    <select name="jk" style="background-color: #F3F3F3;" class="form-control form-control-sm" required>
                                                        <option value="">- pilih -</option>
                                                        <option value="1">Laki-Laki</option>
                                                        <option value="2">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Memiliki KMS <span style="color: red;">*</span></label>
                                                    <div class="row">
                                                        <div class="form-check ml-2">
                                                            <label class="form-check-label">

                                                                <input type="radio" class="form-check-input" name="kms" value="1" checked>
                                                                Ya
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                        <div class="form-check ml-3">
                                                            <label class="form-check-label">

                                                                <input type="radio" class="form-check-input" name="kms" value="0">
                                                                Tidak
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    </div>
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

                        <!-- ==========PART 2========= -->


                        <div id="part_2" hidden="true">

                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Hasil Penimbangan</h4>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <div class="alert alert-warning">
                                                    <p>Standar antropometri berdasarkan umur bulan dari balita, harap teliti umur sebelum memasukkan data berat dan tinggi !</p>
                                                </div>
                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="" data-toggle="modal" data-target="#modalPenimbangan">+ Tambah Bulan</button>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <table class="table table-sm table-hover text-center table-bordered" id="bulan_timbang" style="min-width: 450px;">

                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(1)">Kembali</button>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-primary selanjutnya_2" style="width: 100%;" onclick="next(2)">Selanjutnya</button>
                                </div>
                            </div>
                        </div>


                        <!-- ===========PART 3============ -->

                        <div id="part_3" hidden="true">
                            <div class="form-row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4 class="card-title">Pemberian</h4>
                                            <br>
                                            <div class="row">
                                                <div class="card  col-md-6" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">Sirup FE</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="sirupFe()">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="sirup_fe">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card  col-md-6" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">Vitamin A</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="vitA()">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="vit_a">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card  col-md-6 mt-3" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">Oralit Bln</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="oralit()">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="oralit">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card  col-md-6 mt-3" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">Pemberian PMT</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm add" style="width: 100%; background-color: #F3F3F3" onclick="pmt(this)">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="table_pmt">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(2)">Kembali</button>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-primary selanjutnya_2" style="width: 100%;" onclick="next(3)">Selanjutnya</button>
                                </div>
                            </div>
                        </div>


                        <!-- =======PART4============ -->

                        <div id="part_4" hidden="true">
                            <div class="form-row">

                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4 class="card-title">Pelayanan Imunisasi</h4>
                                            <br>
                                            <div class="row">
                                                <div class="card  col-md-6" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">HB-O</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="hbo()">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="hbo">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card  col-md-6" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">BCG</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="bcg()">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="bcg">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="card  col-md-6" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">DPT-HB</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="dpthb()">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="dpthb">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card  col-md-6" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">Polio</h4>

                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="polio()">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="polio">

                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(3)">Kembali</button>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-primary selanjutnya_2" style="width: 100%;" onclick="next(4)">Tambahkan</button>
                                </div>
                            </div>
                        </div>

                        <!-- ============= PART 5 ============== -->

                        <div id="part_5" hidden="true">
                            <div class="form-row">

                                <div class="col-md-12 grid-margin stretch-card">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="card col-md-6">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Menderita Diare</h4>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-light btn-sm add" style="width: 100%; background-color: #F3F3F3" onclick="diare(this)">+</button>

                                                            </div>
                                                            <br>
                                                            <div class="col-sm-12 mt-3">

                                                                <table class="table table-hover table-sm table-bordered text-center" id="table_diare">
                                                                    <tr hidden="true" id="trhead_diare">
                                                                        <td></td>
                                                                        <td>diare</td>
                                                                        <td>diberi oralit</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <br><br>
                                            <div class="row">
                                                <div class="card col-md-8" style="overflow-x: scroll;">
                                                    <div class="card-body">

                                                        <h4 class="card-title">Lain-lain</h4>

                                                        <br>
                                                        <div class="row">

                                                            <div class="form-group col-md-4">
                                                                <label>Campak</label>
                                                                <input style="background-color: #F3F3F3;" type="date" name="campak" class="form-control form-control-sm">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Bayi Meninggal</label>
                                                                <input style="background-color: #F3F3F3;" type="date" name="bayi_meninggal" class="form-control form-control-sm">
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label>Keterangan</label>
                                                                <input style="background-color: #F3F3F3;" type="text" name="keterangan" class="form-control form-control-sm">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(4)">Kembali</button>
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


<!-- ==========MODEL=============== -->
<div class="modal fade" id="modalPenimbangan" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Hapus data?</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white;">
                <div class="row">
                    <div class="col-sm-12 mt-2">
                        @php
                        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        @endphp

                        <select name="bulan" class="form-control selectpicker" data-live-search="true">
                            <option value="">- pilih Bulan Penimbangan -</option>
                            @foreach ($namaBulan as $n)
                            <option value="{{ $n }}">{{ $n }}</option>
                            @endforeach
                        </select>



                    </div>
                    <div class="col-sm-6 mt-4">
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
                    </div>
                    <div class="col-sm-6  mt-4">
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="bulanTimbang()">Ya</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    $(function() {
        $('#formData').validate({
            rules: {
                nik: {
                    required: true,
                    minlength: 16,
                    maxlength: 16
                },
                nama: {
                    required: true
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
    })

    function next(i) {

        var duplicate = false;
        var duplicateName = '';


        $('input.bulan_timbang_ke').each(function() {

            var $this = $(this);

            $('input.bulan_timbang_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'bulan penimbangan';
                }
            });

        });

        $('input.sirup_fe_ke').each(function() {

            var $this = $(this);

            $('input.sirup_fe_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun pemberian sirup FE';
                }
            });

        });
        $('input.vit_a_ke').each(function() {

            var $this = $(this);

            $('input.vit_a_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun pemberian vitamin A';
                }
            });

        });

        $('input.oralit_ke').each(function() {

            var $this = $(this);

            $('input.oralit_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun pemberian oralit';
                }
            });

        });

        $('input.hbo_ke').each(function() {

            var $this = $(this);

            $('input.hbo_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisasi HB-O';
                }
            });

        });

        $('input.bcg_ke').each(function() {

            var $this = $(this);

            $('input.bcg_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisai BCG';
                }
            });

        });

        $('input.dpthb_ke').each(function() {

            var $this = $(this);

            $('input.dpthb_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisai DPT-HB';
                }
            });

        });

        $('input.polio_ke').each(function() {

            var $this = $(this);

            $('input.polio_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisai Polio';
                }
            });

        });


        if (!duplicate) {
            if (i == 1) {

                if ($('select[name=pasien_id]').val() != '') {

                    if ($('#formData').valid()) {

                        $('#part_1').attr('hidden', true);

                        $('#part_2').attr('hidden', false).show('slow');
                    }

                    $('#pasien_id_required').attr('hidden', true).hide('slow');

                } else {
                    $('#pasien_id_required').attr('hidden', false).show('slow');
                }

            }

            if (i == 2) {

                if ($('#formData').valid()) {
                    $('#part_2').hide('slow', function() {
                        $(this).attr('hidden', true);
                    });

                    $('#part_3').attr('hidden', false).show('slow');
                }


            }


            if (i == 3) {

                if ($('#formData').valid()) {
                    $('#part_3').hide('slow', function() {
                        $(this).attr('hidden', true);
                    });

                    $('#part_4').attr('hidden', false).show('slow');
                }
            }

            if (i == 4) {

                if ($('#formData').valid()) {
                    $('#part_4').hide('slow', function() {
                        $(this).attr('hidden', true);
                    });

                    $('#part_5').attr('hidden', false).show('slow');
                }
            }

        } else {

            alert('Perhatian, terdapat data duplikasi pada ' + duplicateName);

        }


    }


    function back(i) {
        var duplicate = false;
        var duplicateName = '';


        $('input.bulan_timbang_ke').each(function() {

            var $this = $(this);

            $('input.bulan_timbang_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'bulan penimbangan';
                }
            });

        });

        $('input.sirup_fe_ke').each(function() {

            var $this = $(this);

            $('input.sirup_fe_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun pemberian sirup FE';
                }
            });

        });
        $('input.vit_a_ke').each(function() {

            var $this = $(this);

            $('input.vit_a_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun pemberian vitamin A';
                }
            });

        });

        $('input.oralit_ke').each(function() {

            var $this = $(this);

            $('input.oralit_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun pemberian oralit';
                }
            });

        });

        $('input.hbo_ke').each(function() {

            var $this = $(this);

            $('input.hbo_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisasi HB-O';
                }
            });

        });

        $('input.bcg_ke').each(function() {

            var $this = $(this);

            $('input.bcg_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisai BCG';
                }
            });

        });

        $('input.dpthb_ke').each(function() {

            var $this = $(this);

            $('input.dpthb_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisai DPT-HB';
                }
            });

        });

        $('input.polio_ke').each(function() {

            var $this = $(this);

            $('input.polio_ke').not($this).each(function() {
                if ($(this).val() == $this.val()) {

                    duplicate = true;
                    duplicateName = 'tahun imunisai Polio';
                }
            });

        });


        if (!duplicate) {

            if (i == 1) {

                $('#part_2').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('#part_1').attr('hidden', false).show('slow');

            }

            if (i == 2) {

                $('#part_3').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('#part_2').attr('hidden', false).show('slow');


            }

            if (i == 3) {

                $('#part_4').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('#part_3').attr('hidden', false).show('slow');

            }

            if (i == 4) {

                $('#part_5').hide('slow', function() {
                    $(this).attr('hidden', true);
                });

                $('#part_4').attr('hidden', false).show('slow');

            }

        } else {

            alert('Perhatian, terdapat data duplikasi pada ' + duplicateName);

        }


    }


    function bulanTimbang() {

        var bulan = $('select[name=bulan]').val();

        let arrBulan = $('.bulan_timbang').length;

        var tl = $('input[name=tanggal_lahir]').val();


        tl = moment(tl, 'YYYY-MM-DD');

        var umur = moment().diff(tl, 'months');
        tl.add(umur, 'months');

        var umur_hari = moment().diff(tl, 'days');

        if ($('select[name=bulan]').val() != '') {

            $('#bulan_timbang').append(`
                <tr class="bulan_timbang bulan_timbang_` + arrBulan + `" style="background-color: #F3F3F3;">
                <td style="width: 10px;" rowspan="5" style="background-color: #F3F3F3;">
                <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_bulan_timbang(` + arrBulan + `)">
                <i class="mdi mdi-delete-forever"></i>
                </button>
                </td>
                
                </tr>
                <tr class="bulan_timbang_` + arrBulan + `" style="background-color: #F3F3F3;">
                <td colspan="4">` + bulan + `</td>
                </tr>
                <tr  class="bulan_timbang_` + arrBulan + `">
                <td>
                <div class="input-group">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">Bulan Ke</button>
                </div>
                <input type="number" name="bulan_ke[` + arrBulan + `]" max="60" min="1" value="` + (arrBulan + 1) + `" required class="form-control form-control-sm bulan_timbang_ke" style="background-color: #F3F3F3;"></input>
                </div> 
                </td>
                <td>
                <div class="input-group">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">Umur</button>
                </div>
                <input type="number" name="umur_bulan[` + arrBulan + `]" max="60" min="0" value="` + umur + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm umur_bulan" data="` + arrBulan + `"></input>
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm btn-light">Bulan</button>

                </div>
                <input type="number" name="umur_hari[` + arrBulan + `]" max="60" min="0" value="` + umur_hari + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm umur_hari" data="` + arrBulan + `"></input>
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm btn-light">Hari</button>
                </div>
                </div> 
                </td>
                
                
                </tr>
                <tr  class="bulan_timbang_` + arrBulan + `">
                <td>
                <input type="hidden" name="bulan_timbang[` + arrBulan + `]" value="` + bulan + `">
                <div class="input-group">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">BB</button>
                </div>
                <input type="number" class="form-control-sm form-control get_bb" style="background-color: #F3F3F3;" placeholder="berat badan" name="berat_badan[` + arrBulan + `]" required data="` + arrBulan + `">
                </div> 
                <div class="input-group sd_bb mt-1">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">Standar Deviasi</button>
                </div>
                <input type="text" class="form-control-sm form-control" placeholder="Standar Deviasi" name="sd_bb[` + arrBulan + `]" readonly>
                </div>
                <div class="input-group sd_bb mt-1">

                <textarea type="text" class="form-control-sm form-control" placeholder="Status BB" name="status_bb[` + arrBulan + `]" readonly ></textarea>
                </div>
                </td>

                <td>
                <div class="input-group">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">PB/TB</button>
                </div>
                <input type="number" class="form-control-sm form-control get_pb" style="background-color: #F3F3F3;" placeholder="Panjang Badan" required name="panjang_badan[` + arrBulan + `]" min="1" data="` + arrBulan + `">
                </div> 
                <div class="input-group sd_pb mt-1">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">Standar Deviasi</button>
                </div>
                <input type="text" class="form-control-sm form-control" placeholder="Standar Deviasi" name="sd_pb[` + arrBulan + `]" readonly >
                </div>
                <div class="input-group sd_pb mt-1">

                <textarea type="text" class="form-control-sm form-control" placeholder="Status BB" name="status_pb[` + arrBulan + `]"  readonly></textarea>
                </div>
                </td>
             
                </tr>
                <tr class="bulan_timbang_` + arrBulan + `">

                <td colspan="2">
                <div class="input-group">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">tanggal penimbangan</button>
                </div>
                <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" required name="tanggal_timbang[` + arrBulan + `]" placeholder="tanggal">

                </td>
                </tr>

                
                `);


            $('#modalPenimbangan').modal('hide');



            $('.umur_bulan, .get_bb, select[name=jk], button').on('click change keyup', function() {

                var id = $(this).attr('data');

                if ($('input[name="umur_bulan[' + id + ']"]').val() != '' && $('input[name="berat_badan[' + id + ']"]').val() != '') {

                    var umur = $('input[name="umur_bulan[' + id + ']"]').val();
                    var bb = $('input[name="berat_badan[' + id + ']"]').val();

                    bb = parseFloat(bb);

                    var jk = $('select[name=jk]').val();

                    var status_bb;
                    var sd_bb;

                    $.get('{{url("antropometri_bb/")}}/' + umur + '/' + jk, function(v) {

                        var closest = null;
                        var clsKey = null;

                        $.each(v, function(key, val) {

                            if (closest == null || Math.abs(bb - val) < Math.abs(bb - closest)) {

                                closest = val;
                                clsKey = key;
                            }

                        });

                        switch (clsKey) {
                            case 'min3':
                                sd_bb = '-3';
                                break;
                            case 'min2':
                                sd_bb = '-2';
                                break;
                            case 'min1':
                                sd_bb = '-1';
                                break;
                            case 'plus1':
                                sd_bb = '+1';
                                break;
                            case 'plus2':
                                sd_bb = '+2';
                                break;
                            case 'plus3':
                                sd_bb = '+3';
                                break;
                            default:
                                sd_bb = clsKey;
                                break;
                        }

                        if (bb < v.min3) {

                            status_bb = `Berat badan sangat kurang (severely underweight)`;

                        }

                        if (bb >= v.min3 && bb < v.min2) {

                            status_bb = `Berat badan kurang (underweight)`;

                        }

                        if (bb >= v.min2 && bb <= v.plus1) {

                            status_bb = `Berat badan normal`;

                        }

                        if (bb > v.plus1) {

                            status_bb = `Risiko berat badan lebih`;

                        }


                        $('.sd_bb').attr('hidden', false);


                        $('input[name="sd_bb[' + id + ']"]').val(sd_bb);
                        $('textarea[name="status_bb[' + id + ']"]').val(status_bb);

                    })


                }

            });

            $('.umur_bulan, .get_pb, select[name=jk], button').on('click change keyup', function() {

                var id = $(this).attr('data');

                if ($('input[name="umur_bulan[' + id + ']"]').val() != '' && $('input[name="panjang_badan[' + id + ']"]').val() != '') {

                    var umur = $('input[name="umur_bulan[' + id + ']"]').val();
                    var umur_hari = parseInt($('input[name="umur_hari[' + id + ']"]').val());
                    var bb = $('input[name="panjang_badan[' + id + ']"]').val();

                    bb = parseFloat(bb);

                    var jk = $('select[name=jk]').val();

                    var status_pb;
                    var sd_pb;

                    if (umur == 24) {

                        if (umur_hari > 15) {

                            umur = 242;

                        }

                        if (umur_hari <= 15) {

                            umur = 241;

                        }

                    }

                    $.get('{{url("antropometri_pb/")}}/' + umur + '/' + jk, function(v) {

                        var closest = null;
                        var clsKey = null;

                        $.each(v, function(key, val) {

                            if (closest == null || Math.abs(bb - val) < Math.abs(bb - closest)) {

                                closest = val;
                                clsKey = key;
                            }

                        });

                        switch (clsKey) {
                            case 'min3':
                                sd_pb = '-3';
                                break;
                            case 'min2':
                                sd_pb = '-2';
                                break;
                            case 'min1':
                                sd_pb = '-1';
                                break;
                            case 'plus1':
                                sd_pb = '+1';
                                break;
                            case 'plus2':
                                sd_pb = '+2';
                                break;
                            case 'plus3':
                                sd_pb = '+3';
                                break;
                            default:
                                sd_pb = clsKey;
                                break;
                        }

                        if (bb < v.min3) {

                            status_pb = `Sangat pendek (severely stunted)`;

                        }

                        if (bb >= v.min3 && bb < v.min2) {

                            status_pb = `Pendek (stunted)`;

                        }

                        if (bb >= v.min2 && bb <= v.plus1) {

                            status_pb = `Normal`;

                        }

                        if (bb > v.plus1) {

                            status_pb = `Tinggi`;

                        }


                        $('.sd_pb').attr('hidden', false);


                        $('input[name="sd_pb[' + id + ']"]').val(sd_pb);
                        $('textarea[name="status_pb[' + id + ']"]').val(status_pb);

                    })


                }

            });

        }

    }

    function delete_bulan_timbang(i) {

        $('.bulan_timbang_' + i).remove();

    }

    function sirupFe() {

        var jml = $('.sirup_fe').length;

        if (jml < 5) {

            $('#sirup_fe').append(`
            <tr class="sirup_fe sirup_fe_` + jml + ` mt-3">
            <td style="width: 10px;" rowspan="4">
            <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_sirup_fe(` + jml + `)">
            <i class="mdi mdi-delete-forever"></i>
            </button>
            </td>
            </tr>
            <tr class="sirup_fe_` + jml + `">
            <td colspan="4">
            <div class="input-group">
            <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-light">Tahun Ke </button>
            </div>
            <input type="number" name="sirup_fe[` + jml + `]" max="5" min="1" value="` + (jml + 1) + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm sirup_fe_ke"></input>
            </div> 
            </td>
            </td>

            </tr>
            <tr class="sirup_fe_` + jml + `">
            <td>
            Bulan 1
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="berat badan" name="sirup_fe_bulan_1[` + jml + `]" required>
            </td>
            </tr>
            <tr class="sirup_fe_` + jml + `">
            <td>
            Bulan 2
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" name="sirup_fe_bulan_2[` + jml + `]">
            </td>
            </tr>
            `);

        }

    }

    function delete_sirup_fe(i) {

        $('.sirup_fe_' + i).remove();

    }

    function vitA() {

        var jml = $('.vit_a').length;

        if (jml < 5) {

            $('#vit_a').append(`
            <tr class="vit_a vit_a_` + jml + ` mt-3">
            <td style="width: 10px;" rowspan="4">
            <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_vit_a(` + jml + `)">
            <i class="mdi mdi-delete-forever"></i>
            </button>
            </td>
            </tr>
            <tr class="vit_a_` + jml + `">
            <td colspan="4">
            <div class="input-group">
            <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-light">Tahun Ke </button>
            </div>
            <input type="number" name="vit_a[` + jml + `]" max="5" min="1" value="` + (jml + 1) + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm vit_a_ke"></input>
            </div> 
            </td>
            </td>

            </tr>
            <tr class="vit_a_` + jml + `">
            <td>
            Bulan 1
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="berat badan" name="vit_a_bulan_1[` + jml + `]" required>
            </td>
            </tr>
            <tr class="vit_a_` + jml + `">
            <td>
            Bulan 2
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" name="vit_a_bulan_2[` + jml + `]">
            </td>
            </tr>
            `);

        }

    }

    function delete_vit_a(i) {

        $('.vit_a_' + i).remove();

    }


    function oralit() {

        var jml = $('.oralit').length;

        if (jml < 5) {

            $('#oralit').append(`
            <tr class="oralit oralit_` + jml + ` mt-3">
            <td style="width: 10px;" rowspan="3">
            <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_oralit(` + jml + `)">
            <i class="mdi mdi-delete-forever"></i>
            </button>
            </td>
            </tr>
            <tr class="oralit_` + jml + `">
            <td>
            <div class="input-group">
            <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-light">Tahun Ke </button>
            </div>
            <input type="number" name="oralit[` + jml + `]" max="5" min="1" value="` + (jml + 1) + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm oralit_ke"></input>
            </div> 
            </td>
            </td>

            </tr>
            <tr class="oralit_` + jml + `">
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" required name="oralit_tanggal[` + jml + `]">
            </td>
            </tr>
            `);

        }

    }

    function delete_oralit(i) {

        $('.oralit_' + i).remove();

    }

    function hbo() {

        var jml = $('.hbo').length;

        if (jml < 5) {

            $('#hbo').append(`
            <tr class="hbo hbo_` + jml + ` mt-3">
            <td style="width: 10px;" rowspan="3">
            <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_hbo(` + jml + `)">
            <i class="mdi mdi-delete-forever"></i>
            </button>
            </td>
            </tr>
            <tr class="hbo_` + jml + `">
            <td>
            <div class="input-group">
            <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-light">Tahun Ke </button>
            </div>
            <input type="number" name="hbo[` + jml + `]" max="5" min="1" value="` + (jml + 1) + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm hbo_ke"></input>
            </div> 
            </td>
            </td>

            </tr>
            <tr class="hbo_` + jml + `">
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" required name="hbo_tanggal[` + jml + `]">
            </td>
            </tr>
            `);

        }

    }

    function delete_hbo(i) {

        $('.hbo_' + i).remove();

    }

    function bcg() {

        var jml = $('.bcg').length;

        if (jml < 5) {

            $('#bcg').append(`
            <tr class="bcg bcg_` + jml + ` mt-3">
            <td style="width: 10px;" rowspan="3">
            <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_bcg(` + jml + `)">
            <i class="mdi mdi-delete-forever"></i>
            </button>
            </td>
            </tr>
            <tr class="bcg_` + jml + `">
            <td>
            <div class="input-group">
            <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-light">Tahun Ke </button>
            </div>
            <input type="number" name="bcg[` + jml + `]" max="5" min="1" value="` + (jml + 1) + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm bcg_ke"></input>
            </div> 
            </td>
            </td>

            </tr>
            <tr class="bcg_` + jml + `">
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" required name="bcg_tanggal[` + jml + `]">
            </td>
            </tr>
            `);

        }

    }

    function delete_bcg(i) {

        $('.bcg_' + i).remove();

    }


    function dpthb() {

        var jml = $('.dpthb').length;

        if (jml < 5) {

            $('#dpthb').append(`
            <tr class="dpthb dpthb_` + jml + ` mt-3">
            <td style="width: 10px;" rowspan="5">
            <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_dpthb(` + jml + `)">
            <i class="mdi mdi-delete-forever"></i>
            </button>
            </td>
            </tr>
            <tr class="dpthb_` + jml + `">
            <td colspan="4">
            <div class="input-group">
            <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-light">Tahun Ke </button>
            </div>
            <input type="number" name="dpthb[` + jml + `]" max="5" min="1" value="` + (jml + 1) + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm dpthb_ke"></input>
            </div> 
            </td>
            </td>

            </tr>
            <tr class="dpthb_` + jml + `">
            <td>
            Ke 1
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="berat badan" name="dpthb_bulan_1[` + jml + `]" required>
            </td>
            </tr>
            <tr class="dpthb_` + jml + `">
            <td>
            Ke 2
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" name="dpthb_bulan_2[` + jml + `]">
            </td>
            </tr>
            <tr class="dpthb_` + jml + `">
            <td>
            Ke 3
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" name="dpthb_bulan_3[` + jml + `]">
            </td>
            </tr>
            `);

        }

    }

    function delete_dpthb(i) {

        $('.dpthb_' + i).remove();

    }

    function polio() {

        var jml = $('.polio').length;

        if (jml < 5) {

            $('#polio').append(`
            <tr class="polio polio_` + jml + ` mt-3">
            <td style="width: 10px;" rowspan="6">
            <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_polio(` + jml + `)">
            <i class="mdi mdi-delete-forever"></i>
            </button>
            </td>
            </tr>
            <tr class="polio_` + jml + `">
            <td colspan="4">
            <div class="input-group">
            <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-light">Tahun Ke </button>
            </div>
            <input type="number" name="polio[` + jml + `]" max="5" min="1" value="` + (jml + 1) + `" required style="background-color: #F3F3F3;" class="form-control form-control-sm polio_ke"></input>
            </div> 
            </td>
            </td>

            </tr>
            <tr class="polio_` + jml + `">
            <td>
            Ke 1
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="berat badan" name="polio_bulan_1[` + jml + `]" required>
            </td>
            </tr>
            <tr class="polio_` + jml + `">
            <td>
            Ke 2
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" name="polio_bulan_2[` + jml + `]">
            </td>
            </tr>
            <tr class="polio_` + jml + `">
            <td>
            Ke 3
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" name="polio_bulan_3[` + jml + `]">
            </td>
            </tr>
            <tr class="polio_` + jml + `">
            <td>
            Ke 4
            </td>
            <td>
            <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3;" placeholder="panjang badan" name="polio_bulan_4[` + jml + `]">
            </td>
            </tr>
            
            `);

        }

    }

    function delete_polio(i) {

        $('.polio_' + i).remove();

    }


    $('input[name=nama_ibu], input[name=nama_bayi], input[name=nama_ayah]').on('keyup', function() {

        capital = $(this).val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        $(this).val(capital);

    });

    $('#formData').on('submit', function(e) {
        e.preventDefault();
        $('button[type=submit]').prop('disabled', true);

        setTimeout(() => {
            $('button[type=submit]').prop('disabled', false);

        }, 3000);

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
                        window.location.href = "{{url('/bayi')}}";
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


    });


    $('select[name=pasien_id]').on('change', function() {
        if ($(this).val() == '0') {
            $('.nama_ibu').attr('hidden', false);
        } else {
            $('.nama_ibu').attr('hidden', true);

        }
    })

    // ################## PMT ########################
    var pmt = (e) => {
        rand = Math.floor(Math.random() * 1000)
        if ($(e).hasClass('add')) {
            $('#table_pmt').append(
                `<tr class="mt-3"> <td style="width: 10%;"> <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="pmt(this)"> <i class="mdi mdi-delete-forever"></i> </button> </td> <td> <input type="date" name="pmt[` + rand + `]" class="form-control form-control-sm" required> </td> </tr>`
            )

        } else {
            $(e).parent().parent().remove()
        }
    }

    var diare = (e) => {

        rand = Math.floor(Math.random() * 1000)
        if ($(e).hasClass('add')) {
            $('#table_diare').append(
                `<tr class="mt-3 trdiare"> <td style="width: 10%;"> <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="diare(this)"> <i class="mdi mdi-delete-forever"></i> </button> </td> <td> <input type="date" name="diare[` + rand + `][tanggal]" class="form-control form-control-sm" required> </td><td> <input type="date" name="diare[` + rand + `][oralit]" class="form-control form-control-sm"> </td> </tr>`
            )

        } else {
            $(e).parent().parent().remove()
        }

        if ($('.trdiare').length > 0) {
            $('#trhead_diare').attr('hidden', false)
        } else {
            $('#trhead_diare').attr('hidden', true)

        }
    }
</script>

@endpush