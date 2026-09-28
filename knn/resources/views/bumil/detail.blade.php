@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Detail Data Ibu Hamil</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analisis</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/bumil')}}" class="btn btn-primary btn-sm mt-3"> Kembali </a>
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Registrasi</h4>
                                    <div class="row">
                                        <div class="col-md-12 grid-margin stretch-card">
                                            <div class="card" style="min-width: 550px;">
                                                <div class="card-body dashboard-tabs p-0">
                                                    <ul class="nav nav-tabs px-4" role="tablist" style="background-color: #f3f3f3;">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Data Pasien</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Pemberian Tablet dan Imunisasi</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="timbang-tab" data-toggle="tab" href="#timbang" role="tab" aria-controls="timbang" aria-selected="false">Hasil Timbang Bulanan</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content py-0 px-0">
                                                        <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md-6 stretch-card" style="padding: 20px;">
                                                                        <table class="table table-sm table-bordered">
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Registrasi
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Posyandu</td>
                                                                                <td>@php
                                                                                    $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where id = '.$bumils->posyandu_id));
                                                                                    @endphp
                                                                                    {{$posyandu[0]->nama}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Nama Ibu</td>
                                                                                <td>{{$bumils->nama_ibu}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Nama Suami</td>
                                                                                <td>
                                                                                    {{$bumils->nama_suami}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Umur</td>
                                                                                <td>
                                                                                    {{$bumils->umur}} Tahun
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Klp Dasa Wisma</td>
                                                                                <td>
                                                                                    {{$bumils->klp_dasa_wisma != NULL ? $bumils->klp_dasa_wisma : '-'  }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Pendaftaran</td>
                                                                                <td>
                                                                                    @php
                                                                                    $tanggal = date('d M Y', strtotime($bumils->tanggal));
                                                                                    @endphp
                                                                                    {{$tanggal}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Pemeriksaan
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Usia Kehamilan</td>
                                                                                <td>
                                                                                    {{$bumils->umur_kelahiran}} minggu
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="padding: 14px; font-weight: bold;">Hamil Ke </td>
                                                                                <td>
                                                                                    {{$bumils->hamil_ke}}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Lila</td>
                                                                                @if((float)$bumils->lila > 23.5)
                                                                                <td><span class="badge badge-pill badge-success">{{$bumils->lila}}cm, gizi normal</span></td>
                                                                                @else
                                                                                <td><span class="badge badge-pill badge-danger">{{$bumils->lila}}cm, gizi kurang</span></td>
                                                                                @endif
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Pmt Pemulihan</td>
                                                                                <td>
                                                                                    {{$bumils->pmt_pemulihan != NULL ? $bumils->pmt_pemulihan : '-'  }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Kapsul Yodium</td>
                                                                                <td>
                                                                                    @if($bumils->kapsul_yodium != NULL)

                                                                                    @if($bumils->kapsul_yodium == 1)
                                                                                    Telah Diberi
                                                                                    @endif
                                                                                    @else
                                                                                    -
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Resiko</td>
                                                                                <td>
                                                                                    {{$bumils->resiko != NULL ? $bumils->resiko : '-'  }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>


                                                                    </div>
                                                                    <div class="col-md-6 mt-4">
                                                                        <table class="table table-sm" style="padding: 20px;">
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Persalinan
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Tanggal</td>
                                                                                <td>
                                                                                    {{$bumils->tanggal_persalinan != NULL ? $bumils->tanggal_persalinan : '-'  }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Ditolong Oleh</td>
                                                                                <td>
                                                                                    @if($bumils->persalinan != NULL)

                                                                                    @if($bumils->persalinan == 1)
                                                                                    Nakes
                                                                                    @endif
                                                                                    @if($bumils->persalinan == 2)
                                                                                    Dukun
                                                                                    @endif
                                                                                    @else
                                                                                    -
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Bayi
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Bayi</td>
                                                                                <td>
                                                                                    @if($bumils->bayi != NULL)

                                                                                    @if($bumils->bayi == 1)
                                                                                    < 2000 gr @endif @if($bumils->bayi == 2)
                                                                                        2000-2500 gr
                                                                                        @endif
                                                                                        @if($bumils->bayi == 3)
                                                                                        normal
                                                                                        @endif
                                                                                        @if($bumils->bayi == 4)
                                                                                        > 4000 gr
                                                                                        @endif
                                                                                        @else
                                                                                        -
                                                                                        @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Bayi Meninggal</td>
                                                                                <td>
                                                                                    {{$bumils->bayi_meninggal != NULL ? $bumils->bayi_meninggal : '-'  }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="text-center">
                                                                                <td colspan="2" style="padding: 14px; font-weight: bold; background-color: #f3f3f3">
                                                                                    Ibu
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Ibu Meninggal</td>
                                                                                <td>
                                                                                    {{$bumils->ibu_meninggal != NULL ? $bumils->ibu_meninggal : '-'  }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="40%;" style="font-weight: bold; padding: 14px;">Keterangan</td>
                                                                                <td>
                                                                                    {{$bumils->keterangan != NULL ? $bumils->keterangan : '-'  }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                                                            <div class="col-md-12 stretch-card" style="padding: 20px;">

                                                                <table class="table table-bordered table-stripped table text-center table-sm">
                                                                    <tr>
                                                                        <td colspan="4" width="40%;" style="font-weight: bold; padding: 14px;">
                                                                            Pemberian Tablet Tambah Darah
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="background-color: #f3f3f3;font-weight: bold; padding: 14px;" class="text-center">
                                                                        <td style="padding: 14px;">
                                                                            No
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            Nama
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            Status
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            Tanggal
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                    $i = 1;
                                                                    @endphp
                                                                    @foreach($dt_bumil_td as $td)
                                                                    <tr>
                                                                        <td style="padding: 14px;">{{$i}}</td>
                                                                        <td style="padding: 14px;">Tablet Tambah Darah ke - {{$td->status}}</td>
                                                                        <td style="padding: 14px;">
                                                                            Telah Diberikan
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            @php
                                                                            $tanggal = date('d M Y', strtotime($td->tanggal));
                                                                            @endphp
                                                                            {{$tanggal}}
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                    $i++;
                                                                    @endphp
                                                                    @endforeach
                                                                </table>

                                                            </div>
                                                            <div class="col-md-12 stretch-card" style="padding: 20px;">
                                                                <table class="table table-bordered table-stripped table text-center">
                                                                    <tr>
                                                                        <td colspan="4" style="font-weight: bold; padding: 14px;" class="text-center">
                                                                            Pemberian Imunisasi TT
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="background-color: #f3f3f3; font-weight: bold; padding: 14px;" class="text-center">
                                                                        <td style="padding: 14px;">
                                                                            No
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            Nama
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            Status
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            Tanggal
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                    $i = 1;
                                                                    @endphp
                                                                    @foreach($dt_bumil_tt as $td)
                                                                    <tr>
                                                                        <td style="padding: 14px;">{{$i}}</td>
                                                                        <td style="padding: 14px;">Imunisasi TT ke - {{$td->status}}</td>
                                                                        <td style="padding: 14px;">
                                                                            Telah Diberikan
                                                                        </td>
                                                                        <td style="padding: 14px;">
                                                                            @php
                                                                            $tanggal = date('d M Y', strtotime($td->tanggal));
                                                                            @endphp
                                                                            {{$tanggal}}
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                    $i++;
                                                                    @endphp
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="timbang" role="tabpanel" aria-labelledby="timbang-tab">
                                                            <div class="col-md-12" style="padding: 20px;">
                                                                <table class="table table-bordered table-stripped table text-center">

                                                                    <tr style="background-color: #f3f3f3; font-weight: bold;" class="text-center">

                                                                        <td>
                                                                            Bulan Ke
                                                                        </td>
                                                                        <td>
                                                                            Bulan
                                                                        </td>
                                                                        <td>
                                                                            Berat Badan
                                                                        </td>
                                                                        <td>
                                                                            Tekanan Darah
                                                                        </td>
                                                                        <td>
                                                                            Tanggal
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                    $i = 1;
                                                                    @endphp
                                                                    @foreach($dt_bumil_timbang as $td)
                                                                    <tr>
                                                                        <td>
                                                                            Bulan ke - {{$td->bulan_ke}}
                                                                        </td>
                                                                        <td>{{$td->bulan}}</td>
                                                                        <td>
                                                                            {{$td->berat_badan}} kg
                                                                        </td>
                                                                        <td>
                                                                            {{$td->tekanan_darah}} mmHg
                                                                        </td>
                                                                        <td>
                                                                            @php
                                                                            $tanggal = date('d M Y', strtotime($bumils->tanggal));
                                                                            @endphp
                                                                            {{$tanggal}}
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                    $i++;
                                                                    @endphp
                                                                    @endforeach
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="timbang" role="tabpanel" aria-labelledby="timbang-tab">
                                                            data 3
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Detail Data</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: white;">
                <table class="table" id="tableModal">
                    <thead>
                        <tr id="detailDataTitle">

                        </tr>
                    </thead>
                    <tbody>
                        <tr id="detailDataPush">

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
    jQuery(document).ready(function($) {

        $('#tableData').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            responsive: false
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
        if (confirm('Anda yakin ingin menghapus?')) {

            $.get(" {{url('/bumil')}}/" + id + `/destroy`, function(m) {

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
                    });

                    console.log(m)
                }

            });

        }

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