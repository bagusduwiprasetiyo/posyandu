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
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
    </script>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }} - Hamil Ke: {{ $kehamilan->hamil_ke }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('kunjungan.index') }}"
                                                class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('kunjungan.store') }}">
                                @csrf

                                <div style="display: none" class='form-group'>
                                    <label for='kehamilan_id'>kehamilan_id</label>
                                    <input class='form-control' value="{{ $kehamilan->id }}" type='hidden'
                                           id='kehamilan_id' name='kehamilan_id'>
                                    <input class='form-control' value="{{ $pasien->id }}" type='hidden' id='pasien_id'
                                           name='pasien_id'>
                                </div>
                                <fieldset class="bagian">
                                    <legend class="bagian">Pemeriksaan Kunjungan:</legend>
                                    <div class="row">
                                        <div class="col">
                                            <div style="display: none" class='form-group'>
                                                <label class="d-block">Hamil Kembar:</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name='hamil_kembar' type="radio"
                                                           id="hamil_kembar1"
                                                           value="4">
                                                    <label class="form-check-label" for="hamil_kembar1">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input checked class="form-check-input" name='hamil_kembar'
                                                           type="radio"
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
                                                    <input checked class="form-check-input" name='bengkak_muka'
                                                           type="radio"
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
                                                    <input checked class="form-check-input" name='hidraniom'
                                                           type="radio"
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
                                                    <input checked class="form-check-input" name='bayi_mati'
                                                           type="radio"
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
                                                    <input checked class="form-check-input" name='lebih_bulan'
                                                           type="radio"
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
                                                    <input checked class="form-check-input" name='pendarahan'
                                                           type="radio"
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

                                <input type='submit' value='Simpan Data Kunjungan' class="btn btn-primary">
                                <a href="{{ route('pasien.show', $pasien->id) }}" class="btn btn-link">Kembali</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
