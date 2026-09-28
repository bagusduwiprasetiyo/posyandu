@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Data Ibu Hamil</h2>
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
                        <a href="{{url('/bumil/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Ibu Hamil
                        </a>
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: scroll;">
                    <table id="tableData" class="table table-hover text-center">
                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Nama Ibu dan Suami</th>
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
                                <td>
                                    Ibu {{ $bumil->nama_ibu }} dan Bapak {{ $bumil->nama_suami }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                        onclick="details('regis','{{$bumil->id}}')">
                                        Registrasi
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
                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                        onclick="details('timbang','{{$bumil->id}}')">
                                        Hasil Timbang
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
                                    {{$posyandu[0]->nama}}
                                </td>
                                @endif
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{url('/bumil/')}}/{{$bumil->id}}/detail"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{url('/bumil/')}}/{{ $bumil->id }}/edit" data-toggle="tooltip"
                                            title="" class="btn btn-outline-primary btn-sm"
                                            data-original-title="Update Data">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$bumil->id}}')"
                                            data-toggle="modal" data-target="#modalConfirm"
                                            class="btn btn-outline-danger btn-sm">
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
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Hapus data?</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white; padding: 4px;">
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;"
                            onclick="deleteAcc()">Ya</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

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