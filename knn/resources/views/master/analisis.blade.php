@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        @if(auth()->user()->status == 3)
                        <h2>Selamat Datang {{Auth::user()->username}},</h2>
                        @else
                        <h2>Selamat Datang {{Auth::user()->name}},</h2>
                        @endif
                        <p class="mb-md-0">Di Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analisis</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    </button>
                    <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h6 class="mt-3">Tampilkan Data Posyandu Dari : </h6>
                            <select name="posyandu_id" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true" required>
                                <option value="0">-- Semua Posyandu --</option>
                                @foreach($list_posyandu as $lp)
                                <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group col-md-12">
                                <h6 class="mt-3">Tampilkan Data Ibu Tahun : </h6>
                                <select name="tahun_timbang_ibu" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true" required>
                                    <option value="0">-- Semua Tahun --</option>
                                    @foreach($thallibu as $v)
                                    <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th style="padding: 14px; font-weight: bold; background-color: #f3f3f3" colspan="2" class="text-center title_kehamilan">
                                        Data Kehamilan Semua Posyandu
                                    </th>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding: 14px;">
                                        Jumlah Data Kehamilan
                                    </td>
                                    <td class="jml_kehamilan">
                                        {{$data['jml_bumil']}} ibu
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding: 14px;">
                                        <span class="badge badge-pill badge-success">
                                            Jumlah Ibu dengan lila > 23.5
                                        </span>
                                    </td>
                                    <td class="jml_lila_lebih">
                                        {{$data['lila_lebih']}} ibu
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding: 14px;">
                                        <span class="badge badge-pill badge-warning">
                                            Jumlah Ibu dengan lila < 23.5 </span> </td> <td class="jml_lila_kurang">
                                                {{$data['lila_kurang']}} ibu
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th style="padding: 14px; font-weight: bold; background-color: #f3f3f3" colspan="2" class="text-center title_bayi">
                                        Data Bayi Semua Posyandu
                                    </th>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding: 14px;">
                                        Jumlah Data Bayi
                                    </td>
                                    <td class="jml_bayi">
                                        {{$data['jml_bayi']}} bayi
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group col-md-6">
                                <h6 class="mt-3">Tampilkan Data Bayi Tahun : </h6>
                                <select name="tahun_timbang" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true" required>
                                    <option value="0">-- Semua Tahun --</option>
                                    @foreach($thall as $v)
                                    <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th style="padding: 14px; font-weight: bold; background-color: #f3f3f3" colspan="2" class="text-center title_data_bayi">
                                        Data Berat Bayi Semua Tahun
                                    </th>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding: 14px;" colspan="2">
                                        <div class="col-lg-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Berat Badan</h4>
                                                    <canvas id="barChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <th style="padding: 14px; font-weight: bold; background-color: #f3f3f3" colspan="2" class="text-center title_data_bayi">
                                        Data Panjang/Tinggi Bayi Semua Tahun
                                    </th>
                                </tr>
                                <tr>
                                    <td style="width: 60%; padding: 14px;" colspan="2">
                                        <div class="col-lg-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title">Panjang/Tinggi badan</h4>
                                                    <canvas id="barChart2"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        $('select').selectpicker();

        $('select[name=posyandu_id]').on('change', function() {
            var idSelect = $(this).val();
            $.get("{{url('analisis')}}" + '/' + $(this).val() + '/detail',
                function(data, textStatus, jqXHR) {

                    $('.jml_kehamilan').text(data.jml_bumil);
                    $('.jml_lila_lebih').text(data.lila_lebih);
                    $('.jml_lila_kurang').text(data.lila_kurang);
                    $('.jml_bayi').text(data.jml_bayi);
                    if (idSelect != 0) {
                        $('.title_kehamilan').text('Data Kehamilan ' + data.posyandu[0].nama);
                        $('.title_bayi').text('Data Bayi ' + data.posyandu[0].nama);

                    } else {
                        $('.title_bayi').text('Data Bayi Semua Posyandu');
                        $('.title_kehamilan').text('Data Kehamilan Semua Posyandu');
                    }
                }
            );

            $('select[name=tahun_timbang]').trigger('change');
        })

        $('select[name=tahun_timbang_ibu]').on('change', function() {
            var idSelect = $(this).val();
            $.get("{{url('analisis_ibu')}}" + '/' + idSelect + '/' + $('select[name=posyandu_id]').val(),
                function(data, textStatus, jqXHR) {
                    $('.jml_kehamilan').text(data.jml_bumil);
                    $('.jml_lila_lebih').text(data.lila_lebih);
                    $('.jml_lila_kurang').text(data.lila_kurang);
                }
            );
        })




        var options = {
            // maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }

        };
        var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var bb = @json($bb_bayi);
        var bb_1 = 'tipe_' + 1;
        var bb_2 = 'tipe_' + 2;
        var bb_3 = 'tipe_' + 3;
        var bb_4 = 'tipe_' + 4;

        var data = {
            labels: bulan,
            datasets: [{
                    label: 'Risiko berat badan lebih',
                    data: bb['tipe_1'],
                    backgroundColor: 'rgba(239, 255, 0, 0.7)',
                    borderColor: 'rgba(239, 255, 0,1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Berat badan normal',
                    data: bb['tipe_2'],
                    backgroundColor: 'rgba(26, 255, 0, 0.7)',
                    borderColor: 'rgba(26, 255, 0,1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Berat badan kurang (underweight)',
                    data: bb['tipe_3'],
                    backgroundColor: 'rgba(168, 186, 0, 0.7)',
                    borderColor: 'rgba(168, 186, 0,1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Berat badan sangat kurang (severely underweight)',
                    data: bb['tipe_4'],
                    backgroundColor: 'rgba(255, 0, 0, 0.7)',
                    borderColor: 'rgba(255,0,0,1)',
                    borderWidth: 1,
                    fill: false
                }
            ]

        };
        var barChartCanvasbb = $("#barChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChartbb = new Chart(barChartCanvasbb, {
            type: 'bar',
            data: data,
            options: options,
        });


        var pb = @json($pb_bayi);
        var pb_1 = 'tipe_' + 1;
        var pb_2 = 'tipe_' + 2;
        var pb_3 = 'tipe_' + 3;
        var pb_4 = 'tipe_' + 4;

        var datapb = {
            labels: bulan,
            datasets: [{
                    label: 'Tinggi',
                    data: pb['tipe_1'],
                    backgroundColor: 'rgba(239, 255, 0, 0.7)',
                    borderColor: 'rgba(239, 255, 0,1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Normal',
                    data: pb['tipe_2'],
                    backgroundColor: 'rgba(26, 255, 0, 0.7)',
                    borderColor: 'rgba(26, 255, 0,1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Pendek (stunted)',
                    data: pb['tipe_3'],
                    backgroundColor: 'rgba(168, 186, 0, 0.7)',
                    borderColor: 'rgba(168, 186, 0,1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Sangat pendek (severely stunted)',
                    data: pb['tipe_4'],
                    backgroundColor: 'rgba(255, 0, 0, 0.7)',
                    borderColor: 'rgba(255,0,0,1)',
                    borderWidth: 1,
                    fill: false
                }
            ]

        };
        var barChartCanvaspb = $("#barChart2").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChartpb = new Chart(barChartCanvaspb, {
            type: 'bar',
            data: datapb,
            options: options,
        });

        $('select[name=tahun_timbang]').on('change', function() {
            var idSelect = $(this).val();
            $.get("{{url('analisis_bayi')}}" + '/' + $(this).val() + '/' + $('select[name=posyandu_id]').val(),
                function(dataCall, textStatus, jqXHR) {

                    bb = dataCall[0];
                    pb = dataCall[1]

                    if (idSelect != 0) {
                        $('.title_data_bayi').text('Data Berat Badan Bayi Tahun ' + idSelect);
                    } else {
                        $('.title_data_bayi').text('Data Berat Badan Bayi Semua Tahun');
                    }
                    var dataupdate = [{
                            label: 'Risiko berat badan lebih',
                            data: bb['tipe_1'],
                            backgroundColor: 'rgba(239, 255, 0, 0.7)',
                            borderColor: 'rgba(239, 255, 0,1)',
                            borderWidth: 1,
                            fill: false
                        },
                        {
                            label: 'Berat badan normal',
                            data: bb['tipe_2'],
                            backgroundColor: 'rgba(26, 255, 0, 0.7)',
                            borderColor: 'rgba(26, 255, 0,1)',
                            borderWidth: 1,
                            fill: false
                        }, {
                            label: 'Berat badan kurang (underweight)',
                            data: bb['tipe_3'],
                            backgroundColor: 'rgba(168, 186, 0, 0.7)',
                            borderColor: 'rgba(168, 186, 0,1)',
                            borderWidth: 1,
                            fill: false
                        }, {
                            label: 'Berat badan sangat kurang (severely underweight)',
                            data: bb['tipe_4'],
                            backgroundColor: 'rgba(255, 0, 0, 0.7)',
                            borderColor: 'rgba(255,0,0,1)',
                            borderWidth: 1,
                            fill: false
                        }
                    ];

                    // barChartbb.data.datasets = dataUpdate;
                    barChartbb.data.datasets = dataupdate;
                    barChartbb.update();


                    var dataupdate2 = [{
                            label: 'Tinggi',
                            data: pb['tipe_1'],
                            backgroundColor: 'rgba(239, 255, 0, 0.7)',
                            borderColor: 'rgba(239, 255, 0,1)',
                            borderWidth: 1,
                            fill: false
                        },
                        {
                            label: 'Normal',
                            data: pb['tipe_2'],
                            backgroundColor: 'rgba(26, 255, 0, 0.7)',
                            borderColor: 'rgba(26, 255, 0,1)',
                            borderWidth: 1,
                            fill: false
                        }, {
                            label: 'Pendek (stunted)',
                            data: pb['tipe_3'],
                            backgroundColor: 'rgba(168, 186, 0, 0.7)',
                            borderColor: 'rgba(168, 186, 0,1)',
                            borderWidth: 1,
                            fill: false
                        }, {
                            label: 'Sangat pendek (severely stunted)',
                            data: pb['tipe_4'],
                            backgroundColor: 'rgba(255, 0, 0, 0.7)',
                            borderColor: 'rgba(255,0,0,1)',
                            borderWidth: 1,
                            fill: false
                        }
                    ];

                    barChartpb.data.datasets = dataupdate2;
                    barChartpb.update();
                }
            );
        })
    });
</script>
@endpush