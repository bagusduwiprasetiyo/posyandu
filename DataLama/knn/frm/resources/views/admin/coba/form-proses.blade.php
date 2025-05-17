@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('pasien.index') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('ujicoba.proses') }}">
                        {{--TODO:Buat validasi input--}}
                        @csrf
                        <div class='form-group'>
                            <label for='k'>K</label>
                            <input class='form-control' type='number' id='k' name='k'>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class='form-group'>
                                    <label for='usia_ibu'>usia_ibu</label>
                                    <input class='form-control' type='number' id='usia_ibu' name='usia_ibu'>
                                </div>
                                <div class='form-group'>
                                    <label for='usia_kehamilan'>usia_kehamilan</label>
                                    <input class='form-control' type='number' id='usia_kehamilan' name='usia_kehamilan'>
                                </div>
                                <div class='form-group'>
                                    <label for='hamil_ke'>hamil_ke</label>
                                    <input class='form-control' type='number' id='hamil_ke' name='hamil_ke'>
                                </div>
                                <div class='form-group'>
                                    <label for='berat_badan'>berat_badan</label>
                                    <input class='form-control' type='text' id='berat_badan' name='berat_badan'
                                           pattern="[0-9]+([.][0-9]+)?"
                                           title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                </div>
                                <div class='form-group'>
                                    <label for='tinggi_badan'>tinggi_badan</label>
                                    <input class='form-control' type='text' id='tinggi_badan' name='tinggi_badan'
                                           pattern="[0-9]+([.][0-9]+)?"
                                           title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                </div>
                            </div>
                            <div class="col">
                                <div class='form-group'>
                                    <label for='lila'>lila</label>
                                    <input class='form-control' type='text' id='lila' name='lila'
                                           pattern="[0-9]+([.][0-9]+)?"
                                           title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                </div>
                                <div class='form-group'>
                                    <label for='hb'>hb</label>
                                    <input class='form-control' type='text' id='hb' name='hb'
                                           pattern="[0-9]+([.][0-9]+)?"
                                           title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                </div>
                                <div class='form-group'>
                                    <label for='tesni_a'>tesni_a</label>
                                    <input class='form-control' type='text' id='tesni_a' name='tesni_a'
                                           pattern="[0-9]+([.][0-9]+)?"
                                           title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                </div>
                                <div class='form-group'>
                                    <label for='tesni_b'>tesni_b</label>
                                    <input class='form-control' type='text' id='tesni_b' name='tesni_b'
                                           pattern="[0-9]+([.][0-9]+)?"
                                           title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat">
                                </div>
                                <div class='form-group'>
                                    <label for='jarak_hamil'>jarak_hamil</label>
                                    <input class='form-control' type='text' id='jarak_hamil' name='jarak_hamil'
                                           pattern="[0-9]+([.][0-9]+)?"
                                           title="Isi dengan Angka, gunakan tanda . jika bukan angka bulat"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class='form-group'>
                                    <label class="d-block">lambat_hamil_pertama</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lambat_hamil_pertama' type="radio"
                                               id="inlineradio1" value="4">
                                        <label class="form-check-label" for="inlineradio1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lambat_hamil_pertama' type="radio"
                                               id="inlineradio2" value="0" checked>
                                        <label class="form-check-label" for="inlineradio2">Tidak</label>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class="d-block">gagal_hamil</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='gagal_hamil' type="radio"
                                               id="gagal_hamil1"
                                               value="4">
                                        <label class="form-check-label" for="gagal_hamil1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='gagal_hamil' type="radio"
                                               id="gagal_hamil2"
                                               value="0" checked>
                                        <label class="form-check-label" for="gagal_hamil2">Tidak</label>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class="d-block">Pernah lahir_vakum</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lahir_vakum' type="radio"
                                               id="lahir_vakum1"
                                               value="4">
                                        <label class="form-check-label" for="lahir_vakum1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lahir_vakum' type="radio"
                                               id="lahir_vakum2"
                                               value="0" checked>
                                        <label class="form-check-label" for="lahir_vakum2">Tidak</label>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class="d-block">Pernah lahir_dirogoh</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lahir_dirogoh' type="radio"
                                               id="lahir_dirogoh1"
                                               value="4">
                                        <label class="form-check-label" for="lahir_dirogoh1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lahir_dirogoh' type="radio"
                                               id="lahir_dirogoh2"
                                               value="0" checked>
                                        <label class="form-check-label" for="lahir_dirogoh2">Tidak</label>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class="d-block">Pernah lahir_transfusi</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lahir_transfusi' type="radio"
                                               id="lahir_transfusi1"
                                               value="4">
                                        <label class="form-check-label" for="lahir_transfusi1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='lahir_transfusi' type="radio"
                                               id="lahir_transfusi2"
                                               value="0" checked>
                                        <label class="form-check-label" for="lahir_transfusi2">Tidak</label>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class="d-block">Pernah sesar</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='pernah_sesar' type="radio"
                                               id="pernah_sesar1"
                                               value="8">
                                        <label class="form-check-label" for="pernah_sesar1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='pernah_sesar' type="radio"
                                               id="pernah_sesar2"
                                               value="0" checked>
                                        <label class="form-check-label" for="pernah_sesar2">Tidak</label>
                                    </div>
                                </div>


                            </div>
                            <div class="col">

                                <div class='form-group'>
                                    <label class="d-block">penyakit_kurang_darah</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_kurang_darah' type="radio"
                                               id="penyakit_kurang_darah1"
                                               value="4">
                                        <label class="form-check-label" for="penyakit_kurang_darah1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_kurang_darah' type="radio"
                                               id="penyakit_kurang_darah2"
                                               value="0" checked>
                                        <label class="form-check-label" for="penyakit_kurang_darah2">Tidak</label>
                                    </div>
                                </div>

                                <div class='form-group'>

                                    <label class="d-block">penyakit_malaria</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_malaria' type="radio"
                                               id="penyakit_malaria1"
                                               value="4">
                                        <label class="form-check-label" for="penyakit_malaria1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_malaria' type="radio"
                                               id="penyakit_malaria2"
                                               value="0" checked>
                                        <label class="form-check-label" for="penyakit_malaria2">Tidak</label>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class="d-block">penyakit_tbc</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_tbc' type="radio"
                                               id="penyakit_tbc1"
                                               value="4">
                                        <label class="form-check-label" for="penyakit_tbc1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_tbc' type="radio"
                                               id="penyakit_tbc2"
                                               value="0" checked>
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
                                        <input class="form-check-input" name='penyakit_jantung' type="radio"
                                               id="penyakit_jantung2"
                                               value="0" checked>
                                        <label class="form-check-label" for="penyakit_jantung2">Tidak</label>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class="d-block">penyakit_kencing_manis</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_kencing_manis' type="radio"
                                               id="penyakit_kencing_manis1"
                                               value="4">
                                        <label class="form-check-label" for="penyakit_kencing_manis1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_kencing_manis' type="radio"
                                               id="penyakit_kencing_manis2"
                                               value="0" checked>
                                        <label class="form-check-label" for="penyakit_kencing_manis2">Tidak</label>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class="d-block">penyakit_pms</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_pms' type="radio"
                                               id="penyakit_pms1"
                                               value="4">
                                        <label class="form-check-label" for="penyakit_pms1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='penyakit_pms' type="radio"
                                               id="penyakit_pms2"
                                               value="0" checked>
                                        <label class="form-check-label" for="penyakit_pms2">Tidak</label>
                                    </div>
                                </div>
                                <div class='form-group'>

                                    <label class="d-block">hamil_kembar</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='hamil_kembar' type="radio"
                                               id="hamil_kembar1"
                                               value="4">
                                        <label class="form-check-label" for="hamil_kembar1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name='hamil_kembar' type="radio"
                                               id="hamil_kembar2"
                                               value="0" checked>
                                        <label class="form-check-label" for="hamil_kembar2">Tidak</label>
                                    </div>
                                </div>
                            </div>
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
                                            <input class="form-check-input" name='hamil_kembar'
                                                   type="radio"
                                                   id="hamil_kembar2"
                                                   value="0" checked>
                                            <label class="form-check-label" for="hamil_kembar2">Tidak</label>
                                        </div>
                                    </div>

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
                        </fieldset>

                        <hr>
                        <input type='submit' value='Hitung KNN' class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
