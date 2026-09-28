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
            <p class="mb-md-0">Di Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
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
  @if(auth()->user()->status != 3)
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body dashboard-tabs p-0">
          <ul class="nav nav-tabs px-4" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
            </li>
          </ul>
          <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
              <div class="d-flex flex-wrap justify-content-xl-between">
                @if(!session()->has('kader'))
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-account-multiple mr-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Kader</small>
                    <h5 class="mr-2 mb-0">{{$countKader}}</h5>
                  </div>
                </div>
                @endif
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-human-pregnant mr-3 icon-lg text-warning"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Ibu Hamil</small>
                    <h5 class="mr-2 mb-0">{{$countBumil}}</h5>
                  </div>
                </div>
                <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-human-male-female mr-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Balita</small>
                    <h5 class="mr-2 mb-0">{{$countBayi}}</h5>
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

@endif
@endsection


@push('js')

<script>
  var doughnutPieData = {
    datasets: [{
      data: [30, 40, 30, ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
      'Pink',
      'Blue',
      'Yellow',
    ]
  };
  var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };
  if ($("#doughnutChart").length) {
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }
</script>

@endpush