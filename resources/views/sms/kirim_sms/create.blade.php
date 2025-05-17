@extends('layouts.master')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">

            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Tambah SMS Baru</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">SMS Gateway</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/sms/kirim')}}" class="btn btn-primary mr-3 mt-2 mt-xl-0">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <form action="{{url('sms/store/kirim')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="overflow-x: scroll;">
                        <div class="row">
                            <code>Perhatian : </code>
                            <code style="color: green;">Isi pesan yang anda inginkan, pilih kontak atau posyandu tujuan, dan pilih sekali pengiriman atau bulanan.</code>
                            <textarea name="pesan" class="form-control mt-2" cols="30" rows="5" style="border: 1px solid black;" placeholder="--tulis pesan disini--" required></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-sm-4 float-right">
                                <select name="posyandu" class="form-control" required style="color: black; border: 1px solid #081F3E;">
                                    <option value="all" selected>Pilih Semua Posyandu</option>
                                    @foreach($posyandu as $pos)
                                    <option value="{{$pos->id}}">{{$pos->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-warning" style="width: 100%;" onclick="changeSelected()">Pilih</button>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger" style="width: 100%;" onclick="resetSelected()">Reset Pilihan</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Posyandu</th>
                                            <th>No Hp</th>
                                            <th style="text-align: center;">Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kontak as $key => $value)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$value->nama}}</td>
                                            <td>{{DB::table('list_posyandu')->where('id', $value->posyandu_id)->get()[0]->nama}}</td>
                                            <td>{{$value->no_hp}}</td>

                                            <td style="text-align: center;">
                                                <input type="checkbox" name="kontak[{{$value->id}}]" style="transform:scale(2)" class="input_kontak posyandu_{{$value->posyandu_id}}" value="{{$value->id}}">

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="form-group col-sm-5">
                                <label for="">Tanggal Pengiriman Bulanan</label>
                                <input type="date" name="waktu" class="form-control" required>
                            </div>
                            <div class="col-sm-12">
                                <code style="color: green;">SMS akan dikirim setiap bulan pada tanggal yang dipilih, jika anda ingin mengirim SMS 1 kali saja, maka silahkan pilih kirim sekali saja.</code>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-5">
                                <label class="form-check-label ml-4" style="color: red;">
                                    <input type="checkbox" class="form-check-input" name="sekali_kirim" value="sekali_kirim">
                                    KIRIM SMS SEKALI SAJA
                                    <i class="input-helper"></i></label>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-sm-12">
                                <code>Harap periksa kembali isi SMS, posyandu tujuan dan penerima sebelum melakukan penjadwalan.</code>
                            </div>
                            <div class="col-sm-5 mt-3">
                                <button type="submit" class="btn btn-success" style="width: 100%;">Jadwalkan Pengiriman SMS</button>
                            </div>
                        </div>
                        <div hidden="true" id="kontak_container">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="modalalkon" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Tambah data alkon</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white;">
                <div class="row">
                    <div class="col-sm-12 mt-2">
                        <select name="selectalkon" class="form-control selectpicker" data-live-search="true">
                            <option value="">- Pilih Jenis Alkon -</option>

                        </select>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
                    </div>
                    <div class="col-sm-6  mt-4">
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="addalkon('add')">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/moment.js')}}"></script>
<script>
    table = $('table').DataTable({
        "paging": true,
        "searching": true
    });

    $('.select2').select2();


    $('#form-no-hp').on('submit', (e) => {
        if ($('select[name=bumil]').val() == 0 && $('select[name=bumil]').is(':visible')) {
            e.preventDefault();
        }
    })

    var changeSelected = () => {
        const posyandu = $('select[name=posyandu]').val();
        var rows = table.rows().nodes();
        if (posyandu == 'all') {
            $('.input_kontak', rows).prop('checked', true);
        } else {
            $('.posyandu_' + posyandu, rows).prop('checked', true);
        }
    }

    var resetSelected = () => {
        var rows = table.rows().nodes();
        $('.input_kontak', rows).prop('checked', false);
    }

    const dateNow = new Date();

    $('input[name=waktu]').on('change', function() {
        const dateSending = new Date($(this).val().split('T'));

        if (dateSending < dateNow) {
            alert('Bulan, tanggal tidak boleh kurang dari waktu saat ini!');

            $(this).val('').trigger('change')
        }
    })

    $('form').on('submit', function(e) {
        e.preventDefault();
        $(table.rows({
            'search': 'applied'
        }).nodes()).find('.input_kontak').appendTo('#kontak_container')

        $.ajax({
            type: "post",
            url: $('form').attr('action'),
            data: $('form').serialize(),
            dataType: "JSON",
            success: function(response) {
                // console.log(response)
                // console.log(Object.keys(response.kontak).length)
                if (response.status == 'error') {
                    notif(response.status, response.message, "{{url()->current()}}")
                } else {
                    notif(response.status, response.message, "{{url('sms/kirim')}}")
                }

            }
        });
    })
</script>

@endpush