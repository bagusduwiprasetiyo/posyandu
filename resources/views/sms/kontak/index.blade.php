@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Kontak SMS Gateway</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">SMS Gateway</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/sms/kontak/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Nomor HP
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
                                <th>Posyandu</th>
                                <th>No Hp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kontak as $key => $value)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{DB::table('list_posyandu')->where('id', $value->posyandu_id)->get()[0]->nama}}</td>
                                <td>{{$value->no_hp}}</td>
                                <td>
                                    <div class="form-button-action">

                                        <a href="{{url('sms/kontak/edit/'.Crypt::encrypt($value->id))}}" data-toggle="tooltip" title="" class="btn btn-outline-primary btn-xs" data-original-title="Update Data">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$value->id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-outline-danger btn-xs">
                                            <i class="mdi mdi-delete-forever"></i>
                                        </button>
                                    </div>
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
    $('table').DataTable({
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
    })

    // ############## DELETE ###############
    let id_delete = 0

    var deleteRow = (id) => {
        id_delete = id
    }

    var deleteAcc = () => {
        $.ajax({
            type: "get",
            url: "{{url('sms/kontak')}}/" + id_delete + '/delete',
            success: function(response) {
                // console.log(response)
                notif(response.status, response.message, "{{url('sms/kontak')}}")
            }
        });
    }

    hasNotif = "{{session()->has('status')}}";
    status = "{{session()->has('status')?session()->get('status'): ''}}";
    msg = "{{session()->has('message')?session()->get('message'): ''}}";
    if (hasNotif == 1) {
        static_notif(status, msg);
    }
</script>
@endpush