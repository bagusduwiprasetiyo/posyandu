@extends('layouts.admin-master')
@section('css')
    <style>
        fieldset.bagian {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }

        legend.bagian {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width: auto;
            padding: 0 10px;
            border-bottom: none;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#catatan').summernote({
                minHeight: 100,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['para', ['paragraph']]
                ]
            });
        });
    </script>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ isset($id) ? route('pasien.show', $id):route('pasien.index') }}"
                       class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <form method="post" action="{{ route('kehamilan.store') }}">
                <div class="card">
                    <div class="card-body">
                        <fieldset class="bagian">
                            <legend class="bagian">Pemeriksaan awal:</legend>
                            <div class="row">
                                {{--TODO:Buat validasi input--}}
                                {{--TODO:Buat Form Wizard--}}
                                @csrf
                                <div class="col">
                                    @isset($id)
                                        <input type="hidden" value="{{$id}}" readonly name="pasien_id" id="pasien_id"
                                               class="hidden form-control">
                                    @else
                                        <div class='form-group'>
                                            <label for='pasien_id'>pasien_id</label>
                                            <select class="form-control" name="pasien_id" id="pasien_id">
                                                @foreach($data as $r)
                                                    <option value="{{$r->id}}">{{$r->id}} - {{ $r->nama_ibu }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endisset
                                    <div class='form-group'>
                                        <label for='usia_ibu'>Usia Ibu</label>
                                        <input class='form-control' required type='number' id='usia_ibu' name='usia_ibu'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='usia_kehamilan'>Usia Kehamilan</label>
                                        <input class='form-control' required type='number' id='usia_kehamilan'
                                               name='usia_kehamilan'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='hamil_ke'>Hamil Ke</label>
                                        <input class='form-control' type='number' id='hamil_ke' name='hamil_ke'>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label for='berat_badan'>Berat Badan:</label>
                                        <input class='form-control' required type='text' id='berat_badan' name='berat_badan'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                    </div>
                                    <div class='form-group'>
                                        <label for='tinggi_badan'>Tinggi Badan:</label>
                                        <input class='form-control' required type='text' id='tinggi_badan' name='tinggi_badan'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                    </div>

                                    <div class='form-group'>
                                        <label for='lila'>Lingkar Lengan:</label>
                                        <input class='form-control' required type='text' id='lila' name='lila'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                    </div>
                                </div>
                                <div class="col">

                                    <div class='form-group'>
                                        <label for='hb'>HB</label>
                                        <input class='form-control' required type='text' id='hb' name='hb'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                    </div>

                                    <div class='form-group'>
                                        <label for='tesni_a'>Tensi S:</label>
                                        <input class='form-control' required type='text' id='tesni_a' name='tesni_a'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                    </div>
                                </div>
                                <div class="col">
                                    {{--                                    <div class="col">--}}
                                    <div class='form-group'>
                                        <label for='tesni_b'>Tensi D:</label>
                                        <input class='form-control' required type='text' id='tesni_b' name='tesni_b'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                    </div>
                                    <div class='form-group'>
                                        <label for='jarak_hamil'>Jarak Kehamilan:</label>
                                        <input class='form-control' required type='text' id='jarak_hamil' name='jarak_hamil'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat"/>
                                    </div>

                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="bagian">
                            <legend class="bagian">Imunisasi:</legend>
                            <div class="row">
                                <div class="col">
                                    <div class='form-group'>
                                        <label for='imunisasi'>Jenis Imunisasi:</label>
                                        <select class='form-control'  required id='imunisasi' name='imunisasi'>
                                            <option value="Belum">Belum</option>
                                            <option value="TT1">TT1</option>
                                            <option value="TT2">TT2</option>
                                            <option value="TT3">TT3</option>
                                            <option value="TT4">TT4</option>
                                            <option value="TT5">TT5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label for='tgl_imunisasi'>Tanggal Imunisasi:</label>
                                        <input class='form-control' type='date' id='tgl_imunisasi' name='tgl_imunisasi'>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label for='buku_kia'>Buku Kia:</label>
                                        <select class='form-control' id='buku_kia' name='buku_kia'>
                                            <option selected value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        {{--                                TODO:cek disabled--}}
                        <fieldset class="bagian">
                            <legend class="bagian">Detail Kehamilan:</legend>
                            <div class="row">
                                <div class="col">
                                    <div class='form-group' style="display: none">
                                        <label class='d-block'>skor_awal</label>
                                        <div class='form-check form-check-inline'>
                                            <input checked readonly class='disabled form-check-input' name='skor_awal'
                                                   type='radio' id='skor_awal' value='2'>
                                            <label class='form-check-label disabled' for='skor_awal1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input disabled' readonly name='skor_awal'
                                                   type='radio'
                                                   id='skor_awal2' value='0'>
                                            <label class='form-check-label disabled' for='skor_awal2'>Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='d-block'>Usia Hamil Terlalu Muda (<=16)</label>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='terlalu_muda_hamil' type='radio'
                                                   id='terlalu_muda_hamil1' value='4'>
                                            <label class='form-check-label' for='terlalu_muda_hamil1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input checked class='form-check-input' name='terlalu_muda_hamil'
                                                   type='radio'
                                                   id='terlalu_muda_hamil2' value='0'>
                                            <label class='form-check-label' for='terlalu_muda_hamil2'>Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='d-block'>Terlalu Tua Hamil Pertama (>=35th)</label>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='terlalu_tua_hamil' type='radio'
                                                   id='terlalu_tua_hamil1' value='4'>
                                            <label class='form-check-label' for='terlalu_tua_hamil1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input checked class='form-check-input' name='terlalu_tua_hamil'
                                                   type='radio'
                                                   id='terlalu_tua_hamil2' value='0'>
                                            <label class='form-check-label' for='terlalu_tua_hamil2'>Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">Lambat Hamil Pertama (>=4th)</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='lambat_hamil_pertama' type="radio"
                                                   id="inlineradio1" value="4">
                                            <label class="form-check-label" for="inlineradio1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='lambat_hamil_pertama'
                                                   type="radio"
                                                   id="inlineradio2" value="0">
                                            <label class="form-check-label" for="inlineradio2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class='d-block'>Terlalu Lama Hamil Lagi (>=10th)</label>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='lama_hamil_lagi' type='radio'
                                                   id='lama_hamil_lagi1' value='4'>
                                            <label class='form-check-label' for='lama_hamil_lagi1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input checked class='form-check-input' name='lama_hamil_lagi' type='radio'
                                                   id='lama_hamil_lagi2' value='0'>
                                            <label class='form-check-label' for='lama_hamil_lagi2'>Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='d-block'>Terlalu Cepat Hamil Lagi (<25th)</label>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='cepat_hamil_lagi' type='radio'
                                                   id='cepat_hamil_lagi1' value='4'>
                                            <label class='form-check-label' for='cepat_hamil_lagi1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input checked class='form-check-input' name='cepat_hamil_lagi' type='radio'
                                                   id='cepat_hamil_lagi2' value='0'>
                                            <label class='form-check-label' for='cepat_hamil_lagi2'>Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='d-block'>Terlau Banyak Anak (4 atau lebih)</label>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='banyak_anak' type='radio'
                                                   id='banyak_anak1'
                                                   value='4'>
                                            <label class='form-check-label' for='banyak_anak1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input checked class='form-check-input' name='banyak_anak' type='radio'
                                                   id='banyak_anak2' value='0'>
                                            <label class='form-check-label' for='banyak_anak2'>Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class='d-block'>Umur Ibu Terlalu Tua (>=35th)</label>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='umur_terlalu_tua' type='radio'
                                                   id='umur_terlalu_tua1' value='4'>
                                            <label class='form-check-label' for='umur_terlalu_tua1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input checked class='form-check-input' name='umur_terlalu_tua' type='radio'
                                                   id='umur_terlalu_tua2' value='0'>
                                            <label class='form-check-label' for='umur_terlalu_tua2'>Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='d-block'>Ibu Terlalu Pendek (<=145cm)</label>
                                        <div class='form-check form-check-inline'>
                                            <input class='form-check-input' name='terlalu_pendek' type='radio'
                                                   id='terlalu_pendek1' value='4'>
                                            <label class='form-check-label' for='terlalu_pendek1'>Ya</label>
                                        </div>
                                        <div class='form-check form-check-inline'>
                                            <input checked class='form-check-input' name='terlalu_pendek' type='radio'
                                                   id='terlalu_pendek2' value='0'>
                                            <label class='form-check-label' for='terlalu_pendek2'>Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">Pernah Gagal Hamil</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='gagal_hamil' type="radio"
                                                   id="gagal_hamil1"
                                                   value="4">
                                            <label class="form-check-label" for="gagal_hamil1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='gagal_hamil' type="radio"
                                                   id="gagal_hamil2"
                                                   value="0">
                                            <label class="form-check-label" for="gagal_hamil2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="bagian">
                            <legend class="bagian">Pernah Melahirkan dengan :</legend>
                            <div class="row">
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Pernah dengan Vakum</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='lahir_vakum' type="radio"
                                                   id="lahir_vakum1"
                                                   value="4">
                                            <label class="form-check-label" for="lahir_vakum1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='lahir_vakum' type="radio"
                                                   id="lahir_vakum2"
                                                   value="0">
                                            <label class="form-check-label" for="lahir_vakum2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Uri dirogoh</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='lahir_dirogoh' type="radio"
                                                   id="lahir_dirogoh1"
                                                   value="4">
                                            <label class="form-check-label" for="lahir_dirogoh1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='lahir_dirogoh' type="radio"
                                                   id="lahir_dirogoh2"
                                                   value="0">
                                            <label class="form-check-label" for="lahir_dirogoh2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Pernah Lahir diberi infus:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='lahir_transfusi' type="radio"
                                                   id="lahir_transfusi1"
                                                   value="4">
                                            <label class="form-check-label" for="lahir_transfusi1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='lahir_transfusi' type="radio"
                                                   id="lahir_transfusi2"
                                                   value="0">
                                            <label class="form-check-label" for="lahir_transfusi2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Pernah Operasi Sesar:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='pernah_sesar' type="radio"
                                                   id="pernah_sesar1"
                                                   value="8">
                                            <label class="form-check-label" for="pernah_sesar1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='pernah_sesar' type="radio"
                                                   id="pernah_sesar2"
                                                   value="0">
                                            <label class="form-check-label" for="pernah_sesar2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </fieldset>

                        <fieldset class="bagian">
                            <legend class="bagian">Penyakit Ibu Hamil</legend>
                            <div class="row">
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Kurang Darah</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='penyakit_kurang_darah' type="radio"
                                                   id="penyakit_kurang_darah1"
                                                   value="4">
                                            <label class="form-check-label" for="penyakit_kurang_darah1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='penyakit_kurang_darah'
                                                   type="radio"
                                                   id="penyakit_kurang_darah2"
                                                   value="0">
                                            <label class="form-check-label" for="penyakit_kurang_darah2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">Malaria</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='penyakit_malaria' type="radio"
                                                   id="penyakit_malaria1"
                                                   value="4">
                                            <label class="form-check-label" for="penyakit_malaria1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='penyakit_malaria' type="radio"
                                                   id="penyakit_malaria2"
                                                   value="0">
                                            <label class="form-check-label" for="penyakit_malaria2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">TBC:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='penyakit_tbc' type="radio"
                                                   id="penyakit_tbc1"
                                                   value="4">
                                            <label class="form-check-label" for="penyakit_tbc1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='penyakit_tbc' type="radio"
                                                   id="penyakit_tbc2"
                                                   value="0">
                                            <label class="form-check-label" for="penyakit_tbc2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">Payah Jantung</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='penyakit_jantung' type="radio"
                                                   id="penyakit_jantung1"
                                                   value="4">
                                            <label class="form-check-label" for="penyakit_jantung1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='penyakit_jantung' type="radio"
                                                   id="penyakit_jantung2"
                                                   value="0">
                                            <label class="form-check-label" for="penyakit_jantung2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Kencing Manis:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='penyakit_kencing_manis' type="radio"
                                                   id="penyakit_kencing_manis1"
                                                   value="4">
                                            <label class="form-check-label" for="penyakit_kencing_manis1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='penyakit_kencing_manis'
                                                   type="radio"
                                                   id="penyakit_kencing_manis2"
                                                   value="0">
                                            <label class="form-check-label" for="penyakit_kencing_manis2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">PMS:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='penyakit_pms' type="radio"
                                                   id="penyakit_pms1"
                                                   value="4">
                                            <label class="form-check-label" for="penyakit_pms1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='penyakit_pms' type="radio"
                                                   id="penyakit_pms2"
                                                   value="0">
                                            <label class="form-check-label" for="penyakit_pms2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        {{--                        @if(empty($pasien->kunjungans->count()))--}}
                        <fieldset class="bagian">
                            <legend class="bagian">Pemeriksaan Kunjungan:</legend>
                            <div class="row">
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Hamil Kembar:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='hamil_kembar' type="radio"
                                                   id="hamil_kembar1"
                                                   value="4">
                                            <label class="form-check-label" for="hamil_kembar1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='hamil_kembar' type="radio"
                                                   id="hamil_kembar2"
                                                   value="0">
                                            <label class="form-check-label" for="hamil_kembar2">Tidak</label>
                                        </div>
                                    </div>{{--hamil kembar--}}

                                    <div class='form-group'>
                                        <label class="d-block">Bengkak Muka:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='bengkak_muka' type="radio"
                                                   id="bengkak_muka1"
                                                   value="4">
                                            <label class="form-check-label" for="bengkak_muka1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='bengkak_muka' type="radio"
                                                   id="bengkak_muka2"
                                                   value="0">
                                            <label class="form-check-label" for="bengkak_muka2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">Hidranium:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='hidraniom' type="radio"
                                                   id="hidraniom1"
                                                   value="4">
                                            <label class="form-check-label" for="hidraniom1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='hidraniom' type="radio"
                                                   id="hidraniom2"
                                                   value="0">
                                            <label class="form-check-label" for="hidraniom2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Bayi Meninggal:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='bayi_mati' type="radio"
                                                   id="bayi_mati1"
                                                   value="4">
                                            <label class="form-check-label" for="bayi_mati1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='bayi_mati' type="radio"
                                                   id="bayi_mati2"
                                                   value="0">
                                            <label class="form-check-label" for="bayi_mati2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">Kehamilan Lebih Bulan:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='lebih_bulan' type="radio"
                                                   id="lebih_bulan1"
                                                   value="4">
                                            <label class="form-check-label" for="lebih_bulan1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='lebih_bulan' type="radio"
                                                   id="lebih_bulan2"
                                                   value="0">
                                            <label class="form-check-label" for="lebih_bulan2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Bayi Sungsang:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='sungsang' type="radio"
                                                   id="sungsang1"
                                                   value="8">
                                            <label class="form-check-label" for="sungsang1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='sungsang' type="radio"
                                                   id="sungsang2"
                                                   value="0">
                                            <label class="form-check-label" for="sungsang2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">Bayi Lintang:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='lintang' type="radio"
                                                   id="lintang1"
                                                   value="8">
                                            <label class="form-check-label" for="lintang1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='lintang' type="radio"
                                                   id="lintang2"
                                                   value="0">
                                            <label class="form-check-label" for="lintang2">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class='form-group'>
                                        <label class="d-block">Pendarahan dalam Kehamilan:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='pendarahan' type="radio"
                                                   id="pendarahan1"
                                                   value="8">
                                            <label class="form-check-label" for="pendarahan1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='pendarahan' type="radio"
                                                   id="pendarahan2"
                                                   value="0">
                                            <label class="form-check-label" for="pendarahan2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class="d-block">PEB / Eklamsia</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name='peb' type="radio"
                                                   id="peb1"
                                                   value="8">
                                            <label class="form-check-label" for="peb1">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" name='peb' type="radio"
                                                   id="peb2"
                                                   value="0">
                                            <label class="form-check-label" for="peb2">Tidak</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group"><label for="catatan">Catatan</label>
                                        <textarea id="catatan" name="catatan" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <input type='submit' value='Simpan Data Kehamilan' class="btn btn-primary">
                        <a href="{{ route('pasien.show', $id) }}" class="btn btn-link">Kembali</a>

                    </div>
                </div>
                {{--                        @endif--}}
            </form>
        </div>
    </section>
@endsection
