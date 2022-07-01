@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Data Bayi</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">bayi</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/bayi/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Bayi Baru
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
                            @foreach ($bayi as $b)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $b->nama }}</td>
                                <td>

                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="details('regis','{{$b->id}}', '{{$b->tanggal_lahir}}')">
                                        Registrasi
                                    </button>
                                    <table class="table table-hover text-center table_regis_{{$b->id}}" hidden="true">
                                        <tr>
                                            <td width="40%;">
                                                Tanggal Lahir
                                            </td>
                                            <td>
                                                Umur
                                            </td>
                                            <td>
                                                BB/(PB/TB)
                                            </td>

                                            <td>
                                                Orang tua
                                            </td>
                                            <td>
                                                Jenis Kelamin
                                            </td>
                                        </tr>
                                        <tr style="background-color: #ffff">

                                            <td width="40%;">
                                                <span class="badge badge-pill badge-light tgl_{{$b->id}}"></span>
                                            </td>
                                            <td width="40%;">
                                                <span class="badge badge-pill badge-light umur_{{$b->id}}"></span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">{{$b->bb_pb}} </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">Ibu {{$b->nama_ibu}} dan Bapak {{$b->nama_ayah}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">

                                                    @if($b->l_p == 1)
                                                    Laki-laki
                                                    @else
                                                    Perempuan
                                                    @endif
                                                </span>

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="details('timbang','{{$b->id}}')">
                                        Hasil Timbang
                                    </button>
                                    <table class="table table-hover text-center table_timbang_{{$b->id}}" hidden="true" style="overflow-x: scroll;">
                                        <tr class="appendData">
                                            <td>
                                                Bulan Ke
                                            </td>
                                            <td width="40%;">
                                                Bulan
                                            </td>
                                            <td>
                                                BB
                                            </td>
                                            <td>
                                                PB/TB
                                            </td>
                                            <td>
                                                z score BB/U
                                            </td>
                                            <td>
                                                kategori BB/U
                                            </td>
                                            <td>
                                                z score PB/U atau TB/U
                                            </td>
                                            <td>
                                                kategori PB/U atau TB/U
                                            </td>
                                        </tr>
                                        @php
                                        $keyField = 'bayi_'.$b->id;
                                        @endphp
                                        @foreach($dt_bayi_timbang->$keyField as $d)
                                        <tr style="background-color: #ffff;">
                                            <td>
                                                <span class="badge badge-pill badge-light">{{$d->bulan_ke}}</span>
                                            </td>
                                            <td width="40%;">
                                                <span class="badge badge-pill badge-light">{{$d->bulan}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">{{$d->berat_badan}} kg</span>
                                                <span class="badge badge-pill" style="background-color: #B266FF;">{{isset($statustmb['dt_bb_'.$d->id]) ? $statustmb['dt_bb_'.$d->id] : ''}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-light">{{$d->tinggi_badan}} cm</span>
                                                <span class="badge badge-pill" style="background-color: #B266FF;">{{isset($statustmb['dt_pb_'.$d->id]) ? $statustmb['dt_pb_'.$d->id] : ''}}</span>
                                            </td>
                                            <td>
                                                @if($d->sd_bb == '-3')
                                                @php
                                                $badgeColor = 'danger';
                                                @endphp
                                                @elseif($d->sd_bb == '-2')
                                                @php
                                                $badgeColor = 'warning';
                                                @endphp
                                                @else
                                                @php
                                                $badgeColor = 'success';
                                                @endphp
                                                @endif
                                                <span class="badge badge-pill badge-{{$badgeColor}}">{{$d->sd_bb}} standar deviasi</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-{{$badgeColor}}">{{$d->status_bb}}</span>
                                            </td>
                                            <td>
                                                @if($d->sd_pb == '-3')
                                                @php
                                                $badgeColor = 'danger';
                                                @endphp
                                                @elseif($d->sd_pb == '-2')
                                                @php
                                                $badgeColor = 'warning';
                                                @endphp
                                                @else
                                                @php
                                                $badgeColor = 'success';
                                                @endphp
                                                @endif
                                                <span class="badge badge-pill badge-{{$badgeColor}}">{{$d->sd_pb}} standar deviasi</span>
                                            </td>
                                            <td>
                                                <span class=" badge badge-pill badge-{{$badgeColor}}">{{$d->status_pb}}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </td>
                                @if(!session()->has('kader'))
                                <td>
                                    @php
                                    $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where id = '.$b->posyandu_id));
                                    @endphp
                                    {{$posyandu[0]->nama}}
                                </td>
                                @endif
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{url('/bayi/')}}/{{$b->id}}/detail" class="btn btn-outline-warning btn-sm">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{url('/bayi/')}}/{{ $b->id }}/edit" data-toggle="tooltip" title="" class="btn btn-outline-primary btn-sm" data-original-title="Update Data">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$b->id}}')" data-toggle="modal" data-target="#modalConfirm" class="btn btn-outline-danger btn-sm">
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
        $.get(" {{url('/bayi')}}/" + idDelete + `/destroy`, function(m) {

            if (m == 'success') {
                Toast.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus'
                });
                setTimeout(function() {
                    window.location.href = "{{url('/bayi')}}";
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