@extends('layouts.admin-master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('kunjungan.create') }}"
                                                class="btn btn-warning">Tambah</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <h3>Data Sebagai Rujukan KNN</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped">
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
                                <th>Skor Awal</th>
                                <th>Lambat Hamil Pertama</th>
                                <th>Lama Hamil Lagi</th>
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
                                <th>Terlalu Muda Hamil</th>
                                <th>Terlalu Tua Hamil</th>
                                <th>Cepat Hamil Lagi</th>
                                <th>Banyak Anak</th>
                                <th>Umur Terlalu Tua</th>
                                <th>Terlalu Pendek</th>
                                <th>Bengkak Muka</th>
                                <th>Hidraniom</th>
                                <th>Bayi Mati</th>
                                <th>Lebih Bulan</th>
                                <th>Sungsang</th>
                                <th>Lintang</th>
                                <th>Pendarahan</th>
                                <th>Peb</th>
                                <th>Skor</th>
                                <th>Resiko</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $jml = 0; ?>
                            @foreach($data as $row)
                                <?php
                                $jml = +
                                    $row->skor_awal
                                    + $row->lambat_hamil_pertama
                                    + $row->lama_hamil_lagi
                                    + $row->gagal_hamil
                                    + $row->lahir_vakum
                                    + $row->lahir_dirogoh
                                    + $row->lahir_transfusi
                                    + $row->pernah_sesar
                                    + $row->penyakit_kurang_darah
                                    + $row->penyakit_malaria
                                    + $row->penyakit_tbc
                                    + $row->penyakit_jantung
                                    + $row->penyakit_kencing_manis
                                    + $row->penyakit_pms
                                    + $row->hamil_kembar
                                    + $row->terlalu_muda_hamil
                                    + $row->terlalu_tua_hamil
                                    + $row->cepat_hamil_lagi
                                    + $row->banyak_anak
                                    + $row->umur_terlalu_tua
                                    + $row->terlalu_pendek
                                    + $row->kunjunganTerakhir->bengkak_muka
                                    + $row->kunjunganTerakhir->hidraniom
                                    + $row->kunjunganTerakhir->bayi_mati
                                    + $row->kunjunganTerakhir->lebih_bulan
                                    + $row->kunjunganTerakhir->sungsang
                                    + $row->kunjunganTerakhir->lintang
                                    + $row->kunjunganTerakhir->pendarahan
                                    + $row->kunjunganTerakhir->peb;
                                ?>
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
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
                                    <td>{{ $row->skor_awal }}</td>
                                    <td>{{ $row->lambat_hamil_pertama }}</td>
                                    <td>{{ $row->lama_hamil_lagi }}</td>
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
                                    <td>{{ $row->terlalu_muda_hamil }}</td>
                                    <td>{{ $row->terlalu_tua_hamil }}</td>
                                    <td>{{ $row->cepat_hamil_lagi }}</td>
                                    <td>{{ $row->banyak_anak }}</td>
                                    <td>{{ $row->umur_terlalu_tua }}</td>
                                    <td>{{ $row->terlalu_pendek }}</td>
                                    <td>{{ $row->kunjunganTerakhir->bengkak_muka }}</td>
                                    <td>{{ $row->kunjunganTerakhir->hidraniom }}</td>
                                    <td>{{ $row->kunjunganTerakhir->bayi_mati }}</td>
                                    <td>{{ $row->kunjunganTerakhir->lebih_bulan }}</td>
                                    <td>{{ $row->kunjunganTerakhir->sungsang }}</td>
                                    <td>{{ $row->kunjunganTerakhir->lintang }}</td>
                                    <td>{{ $row->kunjunganTerakhir->pendarahan }}</td>
                                    <td>{{ $row->kunjunganTerakhir->peb }}</td>
                                    <td>{{ $jml }}</td>
                                    <td>
                                        <?php
                                        if ($jml > 12)
                                            echo 'KRST';
                                        elseif ($jml > 6)
                                            echo 'KRT';
                                        else
                                            echo 'KRR';
                                        ?>
                                    </td>
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
