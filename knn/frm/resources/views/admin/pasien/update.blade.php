@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('pasien.index') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- TODO:buat tampilan validasi error data --}}
                            <form action="{{ route('pasien.update', $pasien->id) }}" method="post">
                                @csrf
                                {{ method_field('PATCH') }}
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="form-group">
                                    {{-- TODO:buat nomor rekam medik otomatis --}}
                                    <label>Nomor Rekam Medik</label>
                                    <input type="text" class="form-control" value="{{ $pasien->rekam_medik }}"
                                           name="rekam_medik" required="" readonly>
                                    <small>nanti dibuat otomatis</small>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pasien</label>
                                    <input value="{{ $pasien->nama_ibu }}" type="text" name="nama_ibu"
                                           class="form-control" required="">
                                </div>
                                <div class="form-group">
                                    <label>Nama Suami</label>
                                    <input value="{{ $pasien->nama_suami }}" type="text" name="nama_suami"
                                           class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <label class="d-block">Golongan Darah</label>
                                    <div class="form-check form-check-inline">
                                        <input
                                            {{ $pasien->golongan_darah == 'A' ? 'checked':'' }} class="form-check-input"
                                            type="radio" id="inlineradio1" value="A"
                                            name="golongan_darah">
                                        <label class="form-check-label" for="inlineradio1">A</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            {{ $pasien->golongan_darah == 'B' ? 'checked':'' }}  class="form-check-input"
                                            type="radio" id="inlineradio2" value="B"
                                            name="golongan_darah">
                                        <label class="form-check-label" for="inlineradio2">B</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            {{ $pasien->golongan_darah == 'O' ? 'checked':'' }}  class="form-check-input"
                                            type="radio" id="inlineradio3" value="O"
                                            name="golongan_darah">
                                        <label class="form-check-label" for="inlineradio3">O</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            {{ $pasien->golongan_darah == 'AB' ? 'checked':'' }}  class="form-check-input"
                                            type="radio" id="inlineradio4" value="AB"
                                            name="golongan_darah">
                                        <label class="form-check-label" for="inlineradio4">AB</label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea rows="3" name="alamat" class="form-control"
                                              required="">{{$pasien->alamat}}</textarea>
                                </div>
                                <input type="submit" name="simpan" value="Simpan Data Pasien" class="btn btn-primary">
                                <a href="{{ route('pasien.index') }}" class="btn btn-outline-warning">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
