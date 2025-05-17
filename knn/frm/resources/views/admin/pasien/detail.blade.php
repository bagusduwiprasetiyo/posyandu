@extends('layouts.admin-master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .modal-xl {
            max-width: 80% !important;
        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('kehamilan.tambah', $pasien->id) }}" class="btn btn-info">Tambah Data
                        Kehamilan</a>
                    <a href="{{ route('pasien.index') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Kehamilan Ke</th>
                                    <th>Jumlah Kunjungan</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($kehamilan as $row)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $row->kunjungan_count }}
                                        </td>
                                        <td>
                                            {{--                                            <a href="{{ route('kunjungan_pasien_detail', [$row->pasien_id, $row->id]) }}"--}}
                                            {{--                                               class="badge badge-success"><i class="fa fa-eye"></i> Kehamilan /--}}
                                            {{--                                                Kunjungan</a>--}}

                                            <a href="{{ route('pasien.kunjungan', [$row->pasien_id, $row->id]) }}"
                                               onclick="details({{$row->pasien_id}},{{$row->id}})"
                                               class="btn btn-warning btn-sm" title="Detail Kehamilan"><i
                                                    class="fa fa-eye"></i> Kehamilan</a>
                                            @if($row->kelahiran_count == 0)
                                                <a href="{{ route('kunjungan.pasien.tambah', [$row->pasien_id, $row->id]) }}"
                                                   class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Kunjungan</a>
                                                <a href="{{ route('kelahiran.create', ['pasien_id' => $row->pasien_id, 'kehamilan_id' =>$row->id]) }}"
                                                   class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                                    Kelahiran</a>
                                            @endif
                                            {{--                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"--}}
                                            {{--                                                    data-target="#staticBackdrop">--}}
                                            {{--                                                Modal--}}
                                            {{--                                            </button>--}}
                                            {{--                                            <a href="" class="badge badge-success">Detail Kehamilan</a>--}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Belum ada data kehamilan</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($data_hamil) and $data_hamil != '')
                <div class="row" id="detail_kehamilan">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3>Detail Kehamilan</h3>
                            </div>
                            <div class="card-body">
                                <nav>
                                    <div class="nav nav-fill nav-tabs nav-pills" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                           href="#nav-home" role="tab" aria-controls="nav-home"
                                           aria-selected="true">Data Kehamilan</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                           href="#nav-profile" role="tab" aria-controls="nav-profile"
                                           aria-selected="false">Data
                                            Kunjungan</a>
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                           href="#nav-contact" role="tab" aria-controls="nav-contact"
                                           aria-selected="false">Data
                                            Kelahiran</a>
                                        <a class="nav-item nav-link" id="nav-kesimpulan-tab" data-toggle="tab"
                                           href="#nav-kesimpulan" role="tab" aria-controls="nav-kesimpulan"
                                           aria-selected="false">Kesimpulan</a>
                                    </div>
                                </nav>
                                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                         aria-labelledby="nav-home-tab">
                                        <div class="section-title mt-0">Pemeriksaan Awal</div>

                                        <table class="table table-sm table-bordered table-hover">
                                            <thead>
                                            <tr class="text-center bg-whitesmoke">
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
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            <tr>
                                                <td>{{ $data_hamil->usia_ibu }}</td>
                                                <td>{{ $data_hamil->usia_kehamilan }}</td>
                                                <td>{{ $data_hamil->hamil_ke }}</td>
                                                <td>{{ $data_hamil->berat_badan }}</td>
                                                <td>{{ $data_hamil->tinggi_badan }}</td>
                                                <td>{{ $data_hamil->lila }}</td>
                                                <td>{{ $data_hamil->hb }}</td>
                                                <td>{{ $data_hamil->tesni_a }}</td>
                                                <td>{{ $data_hamil->tesni_b }}</td>
                                                <td>{{ $data_hamil->jarak_hamil }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="section-title mt-0">Imunisasi</div>

                                        <table class="table table-sm table-bordered table-hover">
                                            <thead>
                                            <tr class="text-center bg-whitesmoke">
                                                <th>Imunisasi</th>
                                                <th>Tgl Imunisasi</th>
                                                <th>Buku Kia</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="text-center">
                                                <td>{{ $data_hamil->imunisasi }}</td>
                                                <td>{{ date('d F, Y', strtotime($data_hamil->tgl_imunisasi)) }}</td>
                                                <td>{{ $data_hamil->buku_kia }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="section-title mt-0">KSPR</div>
                                        <table class="table table-sm table-bordered table-hover">
                                            <thead>
                                            <tr class="text-center bg-whitesmoke">
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
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="text-center">
                                                <td>{{ $data_hamil->lambat_hamil_pertama }}</td>
                                                <td>{{ $data_hamil->gagal_hamil }}</td>
                                                <td>{{ $data_hamil->lahir_vakum }}</td>
                                                <td>{{ $data_hamil->lahir_dirogoh }}</td>
                                                <td>{{ $data_hamil->lahir_transfusi }}</td>
                                                <td>{{ $data_hamil->pernah_sesar }}</td>
                                                <td>{{ $data_hamil->penyakit_kurang_darah }}</td>
                                                <td>{{ $data_hamil->penyakit_malaria }}</td>
                                                <td>{{ $data_hamil->penyakit_tbc }}</td>
                                                <td>{{ $data_hamil->penyakit_jantung }}</td>
                                                <td>{{ $data_hamil->penyakit_kencing_manis }}</td>
                                                <td>{{ $data_hamil->penyakit_pms }}</td>
                                                <td>{{ $data_hamil->hamil_kembar }}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                         aria-labelledby="nav-profile-tab">
                                        <table class="table table-sm table-hover table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr class="bg-whitesmoke">
                                                <th>No</th>
                                                <th>Resiko KRST</th>
                                                <th>Resiko KNN</th>
                                                <th>Bengkak Muka</th>
                                                <th>Hidraniom</th>
                                                <th>Bayi Meninggal</th>
                                                <th>Lebih Bulan</th>
                                                <th>Sungsang</th>
                                                <th>Lintang</th>
                                                <th>Pendarahan</th>
                                                <th>PEB</th>
                                                <th width="30%">Catatan</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @foreach($data_kunjungan as $r)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $r->resiko }}</td>
                                                    <td>
                                                        @if($r->resiko_knn == '')
                                                            <a href="{{ route('ujiknn', [$data_hamil->pasien_id, $data_hamil->id, $r->id]) }}"
                                                               class="btn btn-info btn-sm">Uji KNN</a>
                                                        @else
                                                            {{ $r->resiko_knn }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $r->bengkak_muka }}</td>
                                                    <td>{{ $r->hidraniom }}</td>
                                                    <td>{{ $r->bayi_mati }}</td>
                                                    <td>{{ $r->lebih_bulan }}</td>
                                                    <td>{{ $r->sungsang }}</td>
                                                    <td>{{ $r->lintang }}</td>
                                                    <td>{{ $r->pendarahan }}</td>
                                                    <td>{{ $r->peb }}</td>
                                                    <td style="text-align: left">{!!  $r->catatan!!}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                         aria-labelledby="nav-contact-tab">
                                        @if(isset($data_kelahiran) and $data_kelahiran != '')
                                            <div class="row">
                                                <div class="col">
                                                    <table style="line-height: 35px" cellpadding="3"
                                                           class="table-striped">
                                                        <tr>
                                                            <td width="40%">Penolong Persalinan:</td>
                                                            <th class="text-right">{{ $data_kelahiran->penolong }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Lahir Mati:</td>
                                                            <th class="text-right">{{ ($data_kelahiran->hidup_mati == 'Mati') ? 'Ya':'-' }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Jenis Kelamin:</td>
                                                            <th class="text-right">{{ $data_kelahiran->jk }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Berat lahir (KG):</td>
                                                            <th class="text-right">{{ $data_kelahiran->berat }}</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col">
                                                    <table style="line-height: 35px" cellpadding="3"
                                                           class="table-striped">
                                                        <tr>
                                                            <td width="40%">Nifas : 6 Jam - 3 Hari:</td>
                                                            <th class="text-right">{{ $data_kelahiran->nifas_1 }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Nifas : 8 - 14 Hari:</td>
                                                            <th class="text-right">{{ $data_kelahiran->nifas_2 }}</th>
                                                        </tr>
                                                        <tr>
                                                            <td width="40%">Nifas : 36 - 42 Hari:</td>
                                                            <th class="text-right">{{ $data_kelahiran->nifas_3 }}</th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <hr>
                                                    <table style="line-height: 35px" cellpadding="3"
                                                           class="table-striped" width="100%">
                                                        <tr>
                                                            <td>Keterangan:</td>
                                                            <td>&emsp;{!! $data_kelahiran->catatan !!}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            {{--                                            <table--}}
                                            {{--                                                class="table table-sm table-hover table-bordered dt-responsive nowrap">--}}
                                            {{--                                                <thead>--}}
                                            {{--                                                <tr class="bg-whitesmoke">--}}
                                            {{--                                                    <th rowspan="2">Penolong Persalinan</th>--}}
                                            {{--                                                    <th rowspan="2">Lahir Mati</th>--}}
                                            {{--                                                    <th colspan="2">Lahir Hidup</th>--}}
                                            {{--                                                    <th colspan="3">Nifas</th>--}}
                                            {{--                                                    <th rowspan="2">Catatan</th>--}}
                                            {{--                                                </tr>--}}
                                            {{--                                                <tr class="bg-whitesmoke">--}}
                                            {{--                                                    <th>Jenis Kelamin</th>--}}
                                            {{--                                                    <th>Berat</th>--}}
                                            {{--                                                    <th>6 Jam - 3 Hari</th>--}}
                                            {{--                                                    <th>8 - 14 Hari</th>--}}
                                            {{--                                                    <th>36 - 42 Hari</th>--}}
                                            {{--                                                </tr>--}}
                                            {{--                                                </thead>--}}
                                            {{--                                                <tbody>--}}
                                            {{--                                                <tr>--}}
                                            {{--                                                    <td>{{ $data_kelahiran->penolong }}</td>--}}
                                            {{--                                                    <td>{{ ($data_kelahiran->hidup_mati == 'Mati') ?'Mati':'-' }}</td>--}}
                                            {{--                                                    <td>{{ $data_kelahiran->jk }}</td>--}}
                                            {{--                                                    <td>{{ $data_kelahiran->berat }}</td>--}}
                                            {{--                                                    <td>{{ $data_kelahiran->nifas_1 }}</td>--}}
                                            {{--                                                    <td>{{ $data_kelahiran->nifas_2 }}</td>--}}
                                            {{--                                                    <td>{{ $data_kelahiran->nifas_3 }}</td>--}}
                                            {{--                                                    <td>{!!  $data_kelahiran->catatan  !!}</td>--}}
                                            {{--                                                </tr>--}}
                                            {{--                                                </tbody>--}}
                                            {{--                                            </table>--}}
                                        @else
                                            <a href="{{ route('kelahiran.create', ['pasien_id' => $data_hamil->pasien_id, 'kehamilan_id' =>$data_hamil->id]) }}"
                                               class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Kelahiran</a>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="nav-kesimpulan" role="tabpanel"
                                         aria-labelledby="nav-kesimpulan-tab">
                                        <div class="section-title mt-0">Resiko menggunakan metode KSPR Berdasarkan
                                            Kunjungan Terakhir :
                                        </div>
                                        <p>Skor KSPR : {{ $kspr->skor_akhir }}</p>
                                        <p>Resiko : {{ $kspr->resiko }}</p>
                                        <div class="section-title mt-0">Resiko menggunakan metode KNN Berdasarkan
                                            Kunjungan Terakhir dan Data Training:
                                        </div>
                                        <p>Jarak Terdekat : {{ $kspr->jarak_knn ?? '-' }}</p>
                                        <p>Resiko : {{ $kspr->resiko_knn ?? '-'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Modal -->
    <div class="modal  fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function details(pasien, id) {

            if ($("#detail_kehamilan").attr('hidden')) {
                $("#detail_kehamilan").attr('hidden', false).show('slow');
            } else {
                $("#detail_kehamilan").hide('slow').attr('hidden', true);
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! Toastr::message() !!}
@endsection
