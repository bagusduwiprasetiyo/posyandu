@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Data KSPR</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">KSPR</p>  
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/kspr/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Deteksi KSPR Baru
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
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Periksa ke</th>
                                <th>Skor</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kspr as $key => $value)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{$value->umur}}</td>
                                <td>{{$value->periksa_ke}}</td>
                                <td>{{$value->total_value}}</td>
                                <td>
                                    <a href="{{url('/kspr/edit/'.$value->id .'/ppa')}}" class="btn btn-outline-warning btn-sm">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                    <a href="{{url('/kspr/edit/'.$value->id)}}" data-toggle="tooltip" title="" class="btn btn-outline-primary btn-sm" data-original-title="Update Data">
                                        <i class="mdi mdi-tooltip-edit"></i>
                                    </a>
                                    <button type="button" id="buttonDelete" onclick="deleteRow('{{$value->id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-outline-danger btn-sm">
                                        <i class="mdi mdi-delete-forever"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="deleteAcc()">Ya</button>
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

    function details(data, id, tgl) {

        if (data == 'regis') {
            var tgl = moment(tgl, 'YYYY-MM-DD').format('DD-MM-YYYY');
            $('.tgl_' + id).text(tgl);

            tgl = moment(tgl, 'DD-MM-YYYY');

            var umur_bulan = moment().diff(tgl, 'months');
            tgl.add(umur_bulan, 'months');

            var umur_hari = moment().diff(tgl, 'days');
            $('.umur_' + id).text(umur_bulan + ' Bulan, ' + umur_hari + ' Hari');
        }

        if ($('.table_' + data + '_' + id).attr('hidden')) {

            $('.table_' + data + '_' + id).attr('hidden', false).show('slow');

        } else {

            $('.table_' + data + '_' + id).hide('slow').attr('hidden', true);

        }
    }

    var deleteRow = function(id) {
        idDelete = id;
    }

    function deleteAcc() {
        $.get(" {{url('/kspr/delete')}}/" + idDelete, function(m) {

            if (m == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus'
                });
                setTimeout(function() {
                    window.location.href = "{{url('/kspr')}}";
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
</script>

@endpush