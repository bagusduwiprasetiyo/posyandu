@extends('layouts.admin-master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! Toastr::message() !!}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                responsive: {
                    details: {
                        renderer: function (api, rowIdx, columns) {
                            var data = $.map(columns, function (col, i) {
                                return col.hidden ?
                                    '<tr class="detailsData" data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                                    '<td class="detailsData">' + col.title + ':' + '</td> ' +
                                    '<td class="detailsData">' + col.data + '</td>' +
                                    '</tr>' :
                                    '';
                            }).join('');

                            return data ?
                                $('<table class="scroller"/>').append(data) :
                                false;
                        }
                    }
                }
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
                    {{--                    <a href="{{ route('kehamilan.tambah', $pasien->id) }}" class="btn btn-info">Tambah Data--}}
                    {{--                        Kehamilan</a>--}}
                    <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nilai KSPR</th>
                                <th>Resiko KSPR</th>
                                <th>Jarak KNN</th>
                                <th>Resiko KNN</th>
                                <th>#</th>
                                <th>Bengkak Muka</th>
                                <th>Hidraniom</th>
                                <th>Bayi Meninggal</th>
                                <th>Lebih Bulan</th>
                                <th>Sungsang</th>
                                <th>Lintang</th>
                                <th>Pendarahan</th>
                                <th>PEB</th>
                                <th>Catatan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->skor_akhir ?? '-'}}</td>
                                    <td>{{ $r->resiko ?? '-'}}</td>
                                    <td>{{ $r->jarak_knn ?? '-'}}</td>
                                    <td>{{ $r->resiko_knn ?? '-'}}</td>
                                    <td>
                                        @if($r->resiko_knn == null and $r->jarak_knn == null)
                                            <a href="{{ route('kunjungan.pasien.hitungknn', [$r->pasien_id, $r->kehamilan_id, $r->id]) }}"
                                               class="btn btn-info btn-sm">Hitung KNN</a>
                                        @endif
                                        @if($r->resiko_knn == null and $r->jarak_knn == null)
                                            <a href="{{ route('ujiknn', [$r->pasien_id, $r->kehamilan_id, $r->id]) }}"
                                               class="btn btn-info btn-sm">Uji KNN</a>
                                        @endif
                                    </td>
                                    <td>{{ yesno($r->bengkak_muka) }}</td>
                                    <td>{{ yesno($r->hidraniom) }}</td>
                                    <td>{{ yesno($r->bayi_mati) }}</td>
                                    <td>{{ yesno($r->lebih_bulan) }}</td>
                                    <td>{{ yesno($r->sungsang) }}</td>
                                    <td>{{ yesno($r->lintang) }}</td>
                                    <td>{{ yesno($r->pendarahan) }}</td>
                                    <td>{{ yesno($r->peb) }}</td>
                                    {{--                                    <td>{!!   \Illuminate\Support\Str::words($r->catatan ?? '-', 4) !!}</td>--}}
                                    <td>{!!   $r->catatan ?? '-' !!}</td>

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
