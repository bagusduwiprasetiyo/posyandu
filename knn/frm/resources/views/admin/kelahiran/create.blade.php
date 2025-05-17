@extends('layouts.admin-master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a
                        href="{{ route('pasien.kunjungan', request()->pasien_id, request()->kehamilan_id) }}"
                        class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('kelahiran.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="kehamilan_id" value="{{ $kehamilan_id }}" required="">
                                <input type="hidden" name="pasien_id" value="{{ $pasien->id }}" required="">
                                <div class="form-group">
                                    <label class="d-block">Penolong Persalinan</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineradio1" value="Nakes"
                                               name="penolong" checked>
                                        <label class="form-check-label" for="inlineradio1">Nakes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="inlineradio2" value="Dukun"
                                               name="penolong">
                                        <label class="form-check-label" for="inlineradio2">Dukun</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="d-block">Kelahiran</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="hidupmati1" value="Hidup"
                                               name="hidup_mati" checked onchange="tampil()">
                                        <label class="form-check-label" for="hidupmati1">Hidup</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="hidupmati2" value="Mati"
                                               name="hidup_mati" onchange="sembunyi()">
                                        <label class="form-check-label" for="hidupmati2">Meninggal</label>
                                    </div>
                                </div>
                                <div id="detail">
                                    <div class="form-group">
                                        <label class="d-block">Jenis Kelamin</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="jko2" value="Perempuan"
                                                   name="jk" checked>
                                            <label class="form-check-label" for="jko2">Perempuan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="jk1"
                                                   value="Laki - Laki"
                                                   name="jk">
                                            <label class="form-check-label" for="jk1">Laki - Laki</label>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label for='berat'>Berat</label>
                                        <input class='form-control' type="text" id="berat" name='berat'
                                               pattern="[0-9]+([.][0-9]+)?"
                                               title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                    </div>

                                </div>
                                <div class='form-group'>
                                    <label for='nifas_1'>Nifas 6 Jam - 3 Hari</label>
                                    <input class='form-control' type="text" id="nifas_1" name='nifas_1'>
                                </div>
                                <div class='form-group'>
                                    <label for='nifas_2'>Nifas 8 - 14 Hari</label>
                                    <input class='form-control' type="text" id="nifas_2" name='nifas_2'>
                                </div>
                                <div class='form-group'>
                                    <label for='nifas_3'>Nifas 36- 42 Hari</label>
                                    <input class='form-control' type="text" id="nifas_3" name='nifas_3'>
                                </div>
                                <div class="form-group"><label for="catatan">Catatan</label>
                                    <textarea id="catatan" name="catatan" class="form-control"></textarea>
                                </div>
                                <input type="submit" name="simpan" value="Simpan Data Kelahiran"
                                       class="btn btn-primary">
                                <a href="{{ route('pasien.kunjungan', [request()->pasien_id, request()->kehamilan_id]) }}" class="btn btn-link">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

        function sembunyi() {
            $('#detail').hide('slow').attr('hidden', true);
            $('#jk1').attr('disabled', 'disabled');
            $('#jko2').attr('disabled', 'disabled');
            $('#berat').attr('disabled', 'disabled');
        }

        function tampil() {
            $("#detail").attr('hidden', false).show('slow');
            $('#jk1').attr('disabled', false);
            $('#jko2').attr('disabled', false);
            $('#berat').attr('disabled', false);
        }
    </script>
@endsection
