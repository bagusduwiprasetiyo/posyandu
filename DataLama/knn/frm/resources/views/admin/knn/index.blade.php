@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('knn.index') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <h3>Data Awal Serta Kunjungan Terakhir</h3>
                    <div class="table-responsive">
                        {{--TODO:berikan tabel detail pakai datatable--}}
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr class="text-center">
                                <td>No</td>
                                <td>Usia Ibu</td>
                                <td>Usia Kehamilan</td>
                                <td>Hamil Ke</td>
                                <td>Berat Badan</td>
                                <td>Tinggi Badan</td>
                                <td>Lila</td>
                                <td>Hb</td>
                                <td>Tesni A</td>
                                <td>Tesni B</td>
                                <td>Jarak Hamil</td>
                                <td>Imunisasi</td>
                                <td>Tgl Imunisasi</td>
                                <td>Buku Kia</td>
                                <td>Lambat Hamil Pertama</td>
                                <td>Gagal Hamil</td>
                                <td>Lahir Vakum</td>
                                <td>Lahir Dirogoh</td>
                                <td>Lahir Transfusi</td>
                                <td>Pernah Sesar</td>
                                <td>Penyakit Kurang Darah</td>
                                <td>Penyakit Malaria</td>
                                <td>Penyakit Tbc</td>
                                <td>Penyakit Jantung</td>
                                <td>Penyakit Kencing Manis</td>
                                <td>Penyakit Pms</td>
                                <td>Hamil Kembar</td>
                                <td>-</td>
                                <td>Bengkak Muka</td>
                                <td>Hidraniom</td>
                                <td>Bayi Mati</td>
                                <td>Lebih Bulan</td>
                                <td>Sungsang</td>
                                <td>Lintang</td>
                                <td>Pendarahan</td>
                                <td>Peb</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $row->pasien_id }}</td>
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
                                    <td>{{ $row->imunisasi }}</td>
                                    <td>{{ $row->tgl_imunisasi }}</td>
                                    <td>{{ $row->buku_kia }}</td>
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
                                    <td>-</td>
                                    <td>{{ $row->kunjunganTerakhir->bengkak_muka }}</td>
                                    <td>{{ $row->kunjunganTerakhir->hidraniom }}</td>
                                    <td>{{ $row->kunjunganTerakhir->bayi_mati }}</td>
                                    <td>{{ $row->kunjunganTerakhir->lebih_bulan }}</td>
                                    <td>{{ $row->kunjunganTerakhir->sungsang }}</td>
                                    <td>{{ $row->kunjunganTerakhir->lintang }}</td>
                                    <td>{{ $row->kunjunganTerakhir->pendarahan }}</td>
                                    <td>{{ $row->kunjunganTerakhir->peb }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
