@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap page-header-modern">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2 class="page-title-modern">Data Ibu Hamil</h2>
                        <p class="mb-md-0 text-muted">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex breadcrumb-modern">
                        <i class="mdi mdi-home text-muted"></i>
                        <p class="text-muted mb-0">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 font-weight-bold">Ibu Hamil</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/bumil/create')}}" class="btn btn-primary btn-modern mt-2 mt-xl-0">
                            <i class="mdi mdi-plus-circle-outline mr-1"></i> Tambah Ibu Hamil
                        </a>
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card card-modern">
                <div class="card-body" style="overflow-x: auto;">
                    <table id="tableData" class="table table-modern text-center">
                        <thead>

                            <tr>
                                <th>No</th>
                                <th class="text-left">Nama Ibu dan Suami</th>
                                <th>Registrasi</th>
                                <th>Hasil Timbang</th>
                                @if(!session()->has('kader'))
                                <th>Posyandu</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($bumils as $bumil)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="text-left font-weight-semibold">
                                    Ibu {{ $bumil->nama_ibu }} dan Bapak {{ $bumil->nama_suami }}</td>
                                <td>
                                    <button type="button" class="btn-chip btn-chip-primary"
                                        onclick="details('regis','{{$bumil->id}}')">
                                        <i class="mdi mdi-file-document-outline"></i> Registrasi
                                    </button>
                                    <table class="table table-hover text-center table_regis_{{$bumil->id}}"
                                        hidden="true">
                                        <tr>
                                            <td width="40%;">
                                                Tanggal
                                            </td>
                                            <td>
                                                Umur Kelahiran
                                            </td>
                                            <td>
                                                Hamil Ke
                                            </td>
                                            <td>
                                                Lila
                                            </td>
                                        </tr>
                                        <tr style="background-color: #ffff">
                                            @php
                                            $tanggal = date('d M Y', strtotime($bumil->tanggal));
                                            @endphp
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    {{$tanggal}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    {{$bumil->umur_kelahiran}} minggu
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    {{$bumil->hamil_ke}}
                                                </span>
                                            </td>
                                            @if((float)$bumil->lila > 23.5)
                                            <td><span class="badge badge-pill badge-success">{{$bumil->lila}}cm, gizi
                                                    normal</span></td>
                                            @else
                                            <td><span class="badge badge-pill badge-danger">{{$bumil->lila}},cm, gizi
                                                    kurang</span></td>
                                            @endif
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <button type="button" class="btn-chip btn-chip-secondary"
                                        onclick="details('timbang','{{$bumil->id}}')">
                                        <i class="mdi mdi-scale-bathroom"></i> Hasil Timbang
                                    </button>
                                    <table class="table table-hover text-center table_timbang_{{$bumil->id}}"
                                        hidden="true">

                                        <tr>
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    Bulan
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    Berat Badan
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    Tekanan Darah
                                                </span>
                                            </td>
                                        </tr>
                                        @php
                                        $keyField = 'pasien_id_'.$bumil->id;
                                        @endphp
                                        @foreach($dt_bumil_timbang->$keyField as $tmb)
                                        <tr style="background-color: #ffff">
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    {{$tmb->bulan}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    {{$tmb->berat_badan}} kg
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">
                                                    {{$tmb->tekanan_darah}} mmHg
                                                </span>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </table>
                                </td>
                                @if(!session()->has('kader'))
                                <td>
                                    @php
                                    $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where
                                    id = '.$bumil->posyandu_id));
                                    @endphp
                                    <span class="badge badge-pill badge-outline-primary">{{$posyandu[0]->nama}}</span>
                                </td>
                                @endif
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{url('/bumil/')}}/{{$bumil->id}}/detail"
                                            class="btn btn-outline-warning btn-sm btn-icon-modern">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{url('/bumil/')}}/{{ $bumil->id }}/edit" data-toggle="tooltip"
                                            title="" class="btn btn-outline-primary btn-sm btn-icon-modern"
                                            data-original-title="Update Data">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$bumil->id}}')"
                                            data-toggle="modal" data-target="#modalConfirm"
                                            class="btn btn-outline-danger btn-sm btn-icon-modern">
                                            <i class="mdi mdi-delete-forever"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @php
                            $i++;
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-dark">
                <p class="modal-title" id="modalConfirmTitle">Hapus data?</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <p class="text-muted small mb-3">Data ibu hamil yang sudah dihapus tidak dapat dikembalikan.</p>
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-light btn-sm btn-modern-sm" data-dismiss="modal" style="width: 100%;">Batal</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-danger btn-sm btn-modern-sm" id="modalConfirmYes" style="width: 100%;"
                            onclick="deleteAcc()">Ya, Hapus</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .page-title-modern { font-weight: 700; letter-spacing: -0.02em; color: #1a2333; margin-bottom: 2px; }
    .breadcrumb-modern { opacity: 0.85; font-size: 0.85rem; }
    .card-modern { border: none; border-radius: 14px; box-shadow: 0 2px 16px rgba(20, 30, 60, 0.06); }
    .btn-modern { border-radius: 8px; font-weight: 600; padding: 0.55rem 1.1rem; box-shadow: 0 4px 10px rgba(66, 103, 178, 0.18); transition: transform 0.15s ease, box-shadow 0.15s ease; }
    .btn-modern:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(66, 103, 178, 0.25); color: #fff; }
    .table-modern { border-collapse: separate; border-spacing: 0 6px; }
    .table-modern thead th { border: none; background-color: #f4f6fb; color: #5c6b8a; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.04em; font-weight: 700; padding: 12px 10px; }
    .table-modern thead th:first-child { border-radius: 10px 0 0 10px; }
    .table-modern thead th:last-child { border-radius: 0 10px 10px 0; }
    .table-modern tbody tr { background-color: #fff; transition: background-color 0.15s ease, box-shadow 0.15s ease; }
    .table-modern tbody tr:hover { background-color: #f8faff; box-shadow: 0 2px 10px rgba(20, 30, 60, 0.05); }
    .table-modern tbody td { border: none; border-top: 1px solid #eef1f8; border-bottom: 1px solid #eef1f8; padding: 14px 10px; vertical-align: middle; }
    .table-modern tbody td:first-child { border-left: 1px solid #eef1f8; border-radius: 10px 0 0 10px; }
    .table-modern tbody td:last-child { border-right: 1px solid #eef1f8; border-radius: 0 10px 10px 0; }
    .font-weight-semibold { font-weight: 600; color: #1a2333; }
    .badge-outline-primary { background-color: #eef2ff; color: #4f46e5; font-weight: 600; }
    .btn-chip { display: inline-flex; align-items: center; gap: 5px; border: none; border-radius: 20px; font-size: 0.74rem; font-weight: 600; padding: 5px 13px; line-height: 1.4; cursor: pointer; transition: background-color 0.15s ease, transform 0.1s ease; }
    .btn-chip:active { transform: scale(0.97); }
    .btn-chip-primary { background-color: #eef2ff; color: #4f46e5; }
    .btn-chip-primary:hover { background-color: #e0e7ff; color: #4338ca; }
    .btn-chip-secondary { background-color: #fff4e6; color: #c2610a; }
    .btn-chip-secondary:hover { background-color: #ffe9cc; color: #9a4a06; }
    .btn-modern-sm { border-radius: 7px; font-weight: 600; font-size: 0.8rem; }
    .btn-icon-modern { border-radius: 7px; width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; margin: 0 2px; }
    .modal-content-modern { border: none; border-radius: 14px; overflow: hidden; }
    .modal-header-dark { background-color: #081F3E; }
    .modal-header-dark .modal-title, .modal-header-dark .close { color: #fff; }
</style>
@endpush

@push('js')

<script>
    jQuery(document).ready(function($) {

        $('#tableData').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            responsive: {
                details: {
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
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

    var getDetail = function(id) {
        $.get(`{{url('/bumil')}}/` + id + `/detail`, function(data) {

            $.each(data, function(key, val) {

                if (key == 'created_at') {

                    key = 'disimpan';


                    val = moment(val, 'YYYY-MM-DD hh:mm:ss').format('LLLL') + ', ' + moment(val, 'YYYY-MM-DD hh:mm:ss').fromNow();


                }

                if (key == 'updated_at') {

                    key = 'diperbarui';

                    val = moment(val, 'YYYY-MM-DD hh:mm:ss').format('LLLL') + ', ' + moment(val, 'YYYY-MM-DD hh:mm:ss').fromNow();

                }


                key = key.replaceAll('_', ' ');

                key = key.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });


                $('#detailDataTitle').empty();
                $('#detailDataPush').empty();

                $('#detailDataTitle').append('<td style="text-transform: capitalize">' + key + '</td>');
                $('#detailDataPush').append('<td>' + val + '</td>');

            })

            $('#tableModal').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "info": true,
                "autoWidth": false,
                responsive: {
                    details: {
                        renderer: function(api, rowIdx, columns) {
                            var data = $.map(columns, function(col, i) {
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

        })
    }

    $('#modal').on('hidden.bs.modal', function() {
        $('#tableModal').DataTable().destroy();
        $('#detailDataTitle').empty();
        $('#detailDataPush').empty();
    });

    var deleteRow = function(id) {
        idDelete = id;
    }

    function deleteAcc() {
        $.get(" {{url('/bumil')}}/" + idDelete + `/destroy`, function(m) {

            if (m == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus'
                });
                setTimeout(function() {
                    window.location.href = "{{url('/bumil')}}";
                }, 950);
            } else {
                ToastError.fire({
                    icon: 'error',
                    title: 'Gagal Dihapus',
                    text: m
                });

                console.log(m)
            }

        });
    }


    function details(data, id) {

        if ($('.table_' + data + '_' + id).attr('hidden')) {

            $('.table_' + data + '_' + id).attr('hidden', false).show('slow');

        } else {

            $('.table_' + data + '_' + id).hide('slow').attr('hidden', true);

        }

    }
</script>

@endpush
