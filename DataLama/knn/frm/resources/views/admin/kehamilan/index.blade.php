@extends('layouts.admin-master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <div class="breadcrumb-item"><a href="{{ route('kehamilan.create') }}" class="btn btn-success">Tambah Data
                            Kehamilan</a></div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <h3>Data Awal Serta Kunjungan Terakhir</h3>
                    <div class="table-responsive">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>No</th>
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
                                <th>Imunisasi</th>
                                <th>Tgl Imunisasi</th>
                                <th>Buku Kia</th>
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
                                <th>Hamil Kembar</th>
                                <th>-</th>
                                <th>Bengkak Muka</th>
                                <th>Hidraniom</th>
                                <th>Bayi Mati</th>
                                <th>Lebih Bulan</th>
                                <th>Sungsang</th>
                                <th>Lintang</th>
                                <th>Pendarahan</th>
                                <th>Peb</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--                    @foreach($data as $row)--}}
                            @if($row != null)
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
                            @else
                                <tr>
                                    <td colspan="36">Data Kosong</td>
                                </tr>
                            @endif
                            {{--                    @endforeach--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
