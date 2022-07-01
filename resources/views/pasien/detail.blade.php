@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Detail Data Pasien</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
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
                                                <div class="row">
                                                    <div class="col-lg-6 grid-margin stretch-card">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Data Diri</h4>
                                                                <table class="table">
                                                                    <tr>
                                                                        <td>NIK</td>
                                                                        <td>{{$pasiendata->nik}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Nama</td>
                                                                        <td>{{$pasiendata->nama}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tempat Lahir</td>
                                                                        <td>{{$pasiendata->tempat_lahir}}</td>
                                                                    </tr>
                                                                    @php
                                                                    if($pasiendata->tanggal_lahir != ''){
                                                                    $tanggal = date('d M Y', strtotime($pasiendata->tgl_lahir));
                                                                    }else{
                                                                    $tanggal = '-';
                                                                    }
                                                                    @endphp
                                                                    <tr>
                                                                        <td>Tanggal Lahir</td>
                                                                        <td>{{$tanggal}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Umur</td>
                                                                        @if($pasiendata->umur != '')
                                                                        <td>{{$pasiendata->umur}} tahun</td>
                                                                        @else
                                                                        <td>-</td>
                                                                        @endif
                                                                    </tr>
                                                                    @if($pasiendata->pekerjaan == 'Lainnya')
                                                                    <tr>
                                                                        <td>Pekerjaan</td>
                                                                        <td>{{$pasiendata->pekerjaan_lainnya}}</td>
                                                                    </tr>

                                                                    @else
                                                                    <tr>
                                                                        <td>Pekerjaan</td>
                                                                        <td>{{$pasiendata->pekerjaan}}</td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <td>Pendidikan</td>
                                                                        <td>{{$pasiendata->pendidikan}}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 grid-margin stretch-card">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Data Suami</h4>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td>NIK Suami</td>
                                                                        <td>{{$pasiendata->nik_suami}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Suami</td>
                                                                        <td>{{$pasiendata->nama_suami}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Umur Suami</td>
                                                                        @if($pasiendata->umur_suami != '')
                                                                        <td>{{$pasiendata->umur_suami}} tahun</td>
                                                                        @else
                                                                        <td>-</td>
                                                                        @endif
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pekerjaan</td>
                                                                        <td>{{$pasiendata->pekerjaan}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pendidikan Suami</td>
                                                                        <td>{{$pasiendata->pendidikan_suami}}</td>
                                                                    </tr>
                                                                    @if($pasiendata->pekerjaan_suami == 'Lainnya')
                                                                    <tr>
                                                                        <td>Pekerjaan Suami</td>
                                                                        <td>{{$pasiendata->pekerjaan_suami_lainnya}}</td>
                                                                    </tr>

                                                                    @else
                                                                    <tr>
                                                                        <td>Pekerjaan Suami</td>
                                                                        <td>{{$pasiendata->pekerjaan_suami}}</td>
                                                                    </tr>
                                                                    @endif
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 grid-margin stretch-card">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Tempat Tinggal</h4>
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td>Alamat</td>
                                                                        <td>{{$pasiendata->alamat}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Alamat Domisili</td>
                                                                        <td>{{$pasiendata->alamat_domisili}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>RT/RW</td>
                                                                        <td>{{$pasiendata->rw}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Kecamatan</td>
                                                                        <td>{{$pasiendata->kecamatan}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Kabupaten</td>
                                                                        <td>{{$pasiendata->kabupaten}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Kota</td>
                                                                        <td>{{$pasiendata->kota}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>No Telpon</td>
                                                                        <td>{{$pasiendata->no_tlp}}</td>
                                                                    </tr>
                                                                </table>
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