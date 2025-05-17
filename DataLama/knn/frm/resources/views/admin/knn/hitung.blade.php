@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('ujicoba.form-proses') }}" class="btn btn-warning">Hitung KNN</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <h3>Data Input Pengujian</h3>
                    <div class="table-responsive">
                        <h5>Nilai K = {{ $r['k'] ?? 7}}</h5>
                        <table class="table table-sm table table-bordered table-hover" border="1" cellpadding="2">
                            <thead>
                            <tr>
                                <th>Usia Ibu</th>
                                <th>Usia Kehamilan</th>
                                <th>Hamil Ke</th>
                                <th>Berat Badan</th>
                                <th>Tinggi Badan</th>
                                <th>Lila</th>
                                <th>Hb</th>
                                <th>Tesni A</th>
                                <th>Tesni B</th>
                                <th>Jarak Hamil</th>
                                <th>Lambat Hamil Pertama</th>
                                <th>Gagal Hamil</th>
                                <th>Lahir Vakum</th>
                                <th>Lahir Dirogoh</th>
                                <th>Lahir Transfusi</th>
                                <th>Pernah Sesar</th>
                                <th>Penyakit Kurang Darah</th>
                                <th>Penyakit Malaria</th>
                                <th>Penyakit Tbc</th>
                                <th>Penyakit Jantung</th>
                                <th>Penyakit Kencing Manis</th>
                                <th>Penyakit Pms</th>
                                <th>hamil_kembar</th>
                                <th>bengkak_muka</th>
                                <th>hidraniom</th>
                                <th>bayi_mati</th>
                                <th>lebih_bulan</th>
                                <th>sungsang</th>
                                <th>lintang</th>
                                <th>pendarahan</th>
                                <th>peb</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td>{{$r['usia_ibu'] ?? $data_uji->usia_ibu }}</td>
                                <td>{{$r['usia_kehamilan']  ?? $data_uji->usia_kehamilan }}</td>
                                <td>{{$r['hamil_ke']  ?? $data_uji->hamil_ke }}</td>
                                <td>{{$r['berat_badan'] ?? $data_uji->berat_badan  }}</td>
                                <td>{{$r['tinggi_badan'] ?? $data_uji->tinggi_badan  }}</td>
                                <td>{{$r['lila'] ?? $data_uji->lila  }}</td>
                                <td>{{$r['hb'] ?? $data_uji->hb  }}</td>
                                <td>{{$r['tesni_a'] ?? $data_uji->tesni_a  }}</td>
                                <td>{{$r['tesni_b']  ?? $data_uji->tesni_b }}</td>
                                <td>{{$r['jarak_hamil'] ?? $data_uji->jarak_hamil  }}</td>
                                <td>{{$r['lambat_hamil_pertama'] ?? $data_uji->lambat_hamil_pertama  }}</td>
                                <td>{{$r['gagal_hamil'] ?? $data_uji->gagal_hamil  }}</td>
                                <td>{{$r['lahir_vakum'] ?? $data_uji->lahir_vakum  }}</td>
                                <td>{{$r['lahir_dirogoh'] ?? $data_uji->lahir_dirogoh  }}</td>
                                <td>{{$r['lahir_transfusi'] ?? $data_uji->lahir_transfusi  }}</td>
                                <td>{{$r['pernah_sesar'] ?? $data_uji->pernah_sesar  }}</td>
                                <td>{{$r['penyakit_kurang_darah'] ?? $data_uji->penyakit_kurang_darah  }}</td>
                                <td>{{$r['penyakit_malaria'] ?? $data_uji->penyakit_malaria  }}</td>
                                <td>{{$r['penyakit_tbc'] ?? $data_uji->penyakit_tbc  }}</td>
                                <td>{{$r['penyakit_jantung'] ?? $data_uji->penyakit_jantung  }}</td>
                                <td>{{$r['penyakit_kencing_manis'] ?? $data_uji->penyakit_kencing_manis  }}</td>
                                <td>{{$r['penyakit_pms'] ?? $data_uji->penyakit_pms  }}</td>
                                <td>{{$r['hamil_kembar'] ??  $data_uji->hamil_kembar }}</td>
                                <td>{{$r['bengkak_muka'] ??  $data_uji->kunjunganTerakhir->bengkak_muka }}</td>
                                <td>{{$r['hidraniom'] ??  $data_uji->kunjunganTerakhir->hidraniom }}</td>
                                <td>{{$r['bayi_mati'] ??  $data_uji->kunjunganTerakhir->bayi_mati }}</td>
                                <td>{{$r['lebih_bulan'] ??  $data_uji->kunjunganTerakhir->lebih_bulan }}</td>
                                <td>{{$r['sungsang'] ??  $data_uji->kunjunganTerakhir->sungsang }}</td>
                                <td>{{$r['lintang'] ??  $data_uji->kunjunganTerakhir->lintang }}</td>
                                <td>{{$r['pendarahan'] ??  $data_uji->kunjunganTerakhir->pendarahan }}</td>
                                <td>{{$r['peb'] ??  $data_uji->kunjunganTerakhir->peb }}</td>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <h3>Data Sebagai Rujukan KNN</h3>
                    <div class="table-responsive">
                        <table class="table table-sm table table-bordered table-hover" border="1" cellpadding="2">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ibu</th>
                                <th>Usia Ibu</th>
                                <th>Usia Kehamilan</th>
                                <th>Hamil Ke</th>
                                <th>Berat Badan</th>
                                <th>Tinggi Badan</th>
                                <th>Lila</th>
                                <th>Hb</th>
                                <th>Tesni A</th>
                                <th>Tesni B</th>
                                <th>Jarak Hamil</th>
                                <th>Lambat Hamil Pertama</th>
                                <th>Gagal Hamil</th>
                                <th>Lahir Vakum</th>
                                <th>Lahir Dirogoh</th>
                                <th>Lahir Transfusi</th>
                                <th>Pernah Sesar</th>
                                <th>Penyakit Kurang Darah</th>
                                <th>Penyakit Malaria</th>
                                <th>Penyakit Tbc</th>
                                <th>Penyakit Jantung</th>
                                <th>Penyakit Kencing Manis</th>
                                <th>Penyakit Pms</th>
                                <th>hamil_kembar</th>
                                <th>bengkak_muka</th>
                                <th>hidraniom</th>
                                <th>bayi_mati</th>
                                <th>lebih_bulan</th>
                                <th>sungsang</th>
                                <th>lintang</th>
                                <th>pendarahan</th>
                                <th>PEB</th>
                                <th>Resiko KSPR</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $row->pasien->nama_ibu }}</td>
                                    <td>{{ $row->usia_ibu }}</td>
                                    <td>{{ $row->usia_kehamilan }}</td>
                                    <td>{{ $row->hamil_ke }}</td>
                                    <td>{{ $row->berat_badan }}</td>
                                    <td>{{ $row->tinggi_badan }}</td>
                                    <td>{{ $row->lila }}</td>
                                    <td>{{ $row->hb }}</td>
                                    <td>{{ $row->tesni_a }}</td>
                                    <td>{{ $row->tesni_b }}</td>
                                    <td>{{ $row->jarak_hamil }}</td>
                                    <td>{{ $row->lambat_hamil_pertama }}</td>
                                    <td>{{ $row->gagal_hamil }}</td>
                                    <td>{{ $row->lahir_vakum }}</td>
                                    <td>{{ $row->lahir_dirogoh }}</td>
                                    <td>{{ $row->lahir_transfusi }}</td>
                                    <td>{{ $row->pernah_sesar }}</td>
                                    <td>{{ $row->penyakit_kurang_darah }}</td>
                                    <td>{{ $row->penyakit_malaria }}</td>
                                    <td>{{ $row->penyakit_tbc }}</td>
                                    <td>{{ $row->penyakit_jantung }}</td>
                                    <td>{{ $row->penyakit_kencing_manis }}</td>
                                    <td>{{ $row->penyakit_pms }}</td>
                                    <td>{{ $row->hamil_kembar }}</td>
                                    <td>{{ $row->kunjunganTerakhir->bengkak_muka }}</td>
                                    <td>{{ $row->kunjunganTerakhir->hidraniom }}</td>
                                    <td>{{ $row->kunjunganTerakhir->bayi_mati }}</td>
                                    <td>{{ $row->kunjunganTerakhir->lebih_bulan }}</td>
                                    <td>{{ $row->kunjunganTerakhir->sungsang }}</td>
                                    <td>{{ $row->kunjunganTerakhir->lintang }}</td>
                                    <td>{{ $row->kunjunganTerakhir->pendarahan }}</td>
                                    <td>{{ $row->kunjunganTerakhir->peb }}</td>
                                    <td>{{ $row->kunjunganTerakhir->resiko }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h3>Tabel perhitungan jarak dengan data Training</h3>
                    <div class="table-responsive">
                        <table class="table table-sm table table-bordered table-hover" border="1" cellpadding="2">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Jarak</th>
                                <th>KSPR</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($hasil as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->pasien->nama_ibu }}</td>
                                    <td>{{ $row->jarak }}</td>
                                    <td>{{ $row->kspr }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Kosong</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h3>Jarak Terdekat Sejumlah K ({{$r['k'] ?? 7}})</h3>
                    <div class="table-responsive">
                        <table class="table table-sm table table-bordered table-hover" border="1" cellpadding="2">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Jarak</th>
                                <th>KSPR</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($hasil_k as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->pasien->nama_ibu }}</td>
                                    <td>{{ $row->jarak }}</td>
                                    <td>{{ $row->kspr }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Kosong</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h3>Kesimpulan KNN</h3>
                    Jarak = {{ $kesimpulan->jarak }} <br>
                    Hasil = {{ $kesimpulan->kspr }}
                </div>
            </div>
        </div>
    </section>
@endsection
