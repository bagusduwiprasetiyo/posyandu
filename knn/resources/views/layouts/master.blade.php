@php

$template = asset('template/backend');

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Posyandu (Pos Pelayanan Terpadu) | {{$title}}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{$template}}/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{$template}}/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{$template}}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{$template}}/vendors/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{$template}}/css/style.css">
  <!-- endinject -->
  <!-- <link rel="shortcut icon" href="{{$template}}/images/favicon.png" /> -->
  <link rel="stylesheet" href="{{$template}}/vendors/toastr/toastr.min.css">
  <link rel="stylesheet" href="{{$template}}/vendors/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="{{$template}}/vendors/datatables.net-bs4/responsive.dataTables.min.css">
  <link rel="stylesheet" href="{{$template}}/vendors/bootstrap-select/bootstrap-select.min.css">
  <link rel="stylesheet" href="{{$template}}/vendors/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

  @stack('css')


</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center" style="background-color: #081F3E;">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('template/frontend')}}/img/core-img/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('template/backend')}}/images/logo-mini.png" alt="logo" /></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color: #081F3E;">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right" style="color: white;">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <!-- <img src="{{$template}}/images/faces/face5.jpg" alt="profile"/> -->
              @if(auth()->user()->status != 3)
              <span class="nav-profile-name" style="color: white;">{{Auth::user()->name}}</span>
              @else
              <span class="nav-profile-name" style="color: white;">{{Auth::user()->username}}</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{url('/logout')}}">
                <i class="mdi mdi-logout text-primary"></i>
                Keluar
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item {{isset($sidebarDashboard) ? $sidebarDashboard : ''}}">
            <a class="nav-link" href="{{url('dashboard')}}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(auth()->user()->status == 3)
          <!-- <li class="nav-item {{isset($userDataDiri) ? $userDataDiri : ''}}">
            <a class="nav-link" href="{{url('user')}}">
              <i class="mdi mdi-human-male-female menu-icon"></i>
              <span class="menu-title">Data Diri</span>
            </a>
          </li> -->
          <li class="nav-item {{isset($userDataKehamilan) ? $userDataKehamilan : ''}}">
            <a class="nav-link" href="{{url('user_kehamilan')}}">
              <i class="mdi mdi-human-pregnant menu-icon"></i>
              <span class="menu-title">Data Kehamilan</span>
            </a>
          </li>
          <li class="nav-item {{isset($userDataBayi) ? $userDataBayi : ''}}">
            <a class="nav-link" href="{{url('user_bayi')}}">
              <i class="mdi mdi-human-child menu-icon"></i>
              <span class="menu-title">Data bayi</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->status != 3)
          @if(auth()->user()->status == 1)
          <li class="nav-item {{isset($sidebarPasien) ? $sidebarPasien : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-hospital-building menu-icon"></i>
              <span class="menu-title">Kader Posyandu</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{isset($collapsePasien) ? $collapsePasien : ''}}" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                @if(Auth::user()->status == 1)
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubAccKader) ? $sidebarSubAccKader : ''}}" href="{{url('accept_kader')}}">Terima Kader</a></li>
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubKader) ? $sidebarSubKader : ''}}" href="{{url('kader')}}">Data
                    Kader</a></li>
                @endif
                <!-- <li class="nav-item"> <a class="nav-link {{isset($sidebarSubPasien) ? $sidebarSubPasien : ''}}" href="{{url('pasien')}}">Data Pasien</a></li> -->
              </ul>
            </div>
          </li>
          @endif

          <li class="nav-item {{isset($sidebarPemeriksaan) ? $sidebarPemeriksaan : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-home-variant menu-icon"></i>
              <span class="menu-title">Pemeriksaan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{isset($collapsePemeriksaan) ? $collapsePemeriksaan : ''}}" id="ui-basic2">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubPuswus) ? $sidebarSubPuswus : ''}}" href="{{url('puswus')}}">Pus/Wus</a></li>
              </ul>

              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubBumil) ? $sidebarSubBumil : ''}}" href="{{url('bumil')}}">Ibu
                    Hamil</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubBayi) ? $sidebarSubBayi : ''}}" href="{{url('bayi')}}">Bayi</a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          @if(Auth::user()->status == 1)
          <li class="nav-item {{isset($sidebarMaster) ? $sidebarMaster : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-pencil-box-outline menu-icon"></i>
              <span class="menu-title">Master</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{isset($collapseMaster) ? $collapseMaster : ''}}" id="ui-basic3">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubPosyandu) ? $sidebarSubPosyandu : ''}}" href="{{url('create_posyandu')}}">Tambah Posyandu</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
              </ul>
            </div>
          </li>
          <li class="nav-item {{isset($sidebarAntropometri) ? $sidebarAntropometri : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-odnoklassniki menu-icon"></i>
              <span class="menu-title">Standar Antropometri</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{isset($collapseAntropometri) ? $collapseAntropometri : ''}}" id="ui-basic4">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubBBL) ? $sidebarSubBBL : ''}}" href="{{url('/antropometri_bbl')}}">BB Laki-Laki</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubPBL) ? $sidebarSubPBL : ''}}" href="{{url('/antropometri_pbl')}}">PB Laki-Laki</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubBBP) ? $sidebarSubBBP : ''}}" href="{{url('/antropometri_bbp')}}">BB Perempuan</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">

                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubPBP) ? $sidebarSubPBP : ''}}" href="{{url('/antropometri_pbp')}}">PB Perempuan</a></li>
              </ul>
            </div>
          </li>


          @endif

          @if(Auth::user()->status != 3)
          <li class="nav-item {{isset($account) ? $account : ''}}">
            <a class="nav-link" href="{{url('account')}}">
              <i class="mdi mdi-account-key menu-icon"></i>
              <span class="menu-title">Data Akun Posyandu</span>
            </a>
          </li>
          <li class="nav-item {{isset($analisis) ? $analisis : ''}}">
            <a class="nav-link" href="{{url('analisis')}}">
              <i class="mdi mdi-book menu-icon"></i>
              <span class="menu-title">Analisis Posyandu</span>
            </a>
          </li>
          <li class="nav-item {{isset($sidebarLaporan) ? $sidebarLaporan : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-printer menu-icon"></i>
              <span class="menu-title">Laporan Posyandu</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{isset($collapseLaporan) ? $collapseLaporan : ''}}" id="laporan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarlaporanregistrasi) ? $sidebarlaporanregistrasi : ''}}" href="{{url('/laporan')}}">Laporan Registrasi</a></li>
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarlaporanpuswus) ? $sidebarlaporanpuswus : ''}}" href="{{url('/laporan_puswus/0/'.date('Y'))}}">Laporan PusWus</a></li>
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarcatatanbumil) ? $sidebarcatatanbumil : ''}}" href="{{url('/laporan_catatan_bumil/0/'.date('Y'))}}">Catatan Ibu Hamil</a></li>
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarkegiatanposyandu) ? $sidebarkegiatanposyandu : ''}}" href="{{url('/laporan_kegiatan_posyandu/0/'.date('Y'))}}">Hasil Kegiatan</a></li>
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarjumlahpengunjung) ? $sidebarjumlahpengunjung : ''}}" href="{{url('/laporan_jumlah_pengunjung/0/'.date('Y'))}}">Jumlah Pengunjung</a></li>
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarlaporanbulanan) ? $sidebarlaporanbulanan : ''}}" href="{{url('/laporan_bulanan/0/'.date('Y').'/'.date('m'))}}">Laporan Bulanan</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item {{isset($sidebarSms) ? $sidebarSms : ''}}">
            <a class="nav-link" data-toggle="collapse" href="#sms" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-comment-text menu-icon"></i>
              <span class="menu-title">SMS Gateway</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{isset($collapseSms) ? $collapseSms : ''}}" id="sms">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubKontak) ? $sidebarSubKontak : ''}}" href="{{url('/sms/kontak')}}">Kontak</a></li>
                <li class="nav-item mdi mdi-hospital-building"><a class="nav-link {{isset($sidebarSubSms) ? $sidebarSubSms : ''}}" href="{{url('/sms/kirim')}}">Kirim SMS</a></li>
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item {{isset($cetak_laporan) ? $cetak_laporan : ''}}">
            <a class="nav-link" href="{{url('laporan')}}">
              <i class="mdi mdi-printer menu-icon"></i>
              <span class="menu-title">Cetak Laporan Posyandu</span>
            </a>
          </li> -->
          @endif
          <li class="nav-item {{isset($profile) ? $profile : ''}}">
            <a class="nav-link" href="{{url('profile')}}">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>

        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">

        @yield('content')

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Sistem Informasi Pelayanan
              Posyandu - <a href="{{url('/')}}" target="_blank"> e-posyand - (Pos Pelayanan Terpadu) </a>. </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{$template}}/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{$template}}/vendors/chart.js/Chart.min.js"></script>
  <script src="{{$template}}/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{$template}}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="{{$template}}/vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{$template}}/vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{$template}}/js/off-canvas.js"></script>
  <script src="{{$template}}/js/hoverable-collapse.js"></script>
  <!-- <script src="{{$template}}/js/template.js"></script> -->
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{$template}}/js/dashboard.js"></script>
  <script src="{{$template}}/js/data-table.js"></script>
  <script src="{{$template}}/js/jquery.dataTables.js"></script>
  <script src="{{$template}}/js/dataTables.bootstrap4.js"></script>
  <script src="{{$template}}/vendors/datatables.net-bs4/dataTables.responsive.min.js"></script>
  <!-- End custom js for this page-->

  <script src="{{$template}}/vendors/moment/moment.min.js"></script>
  <script src="{{$template}}/vendors/moment/locale/id.js"></script>

  <script src="{{asset('template/frontend')}}/plugins/jquery-validation/jquery.validate.js"></script>
  <script src="{{asset('template/frontend')}}/plugins/jquery-validation/localization/messages_id.js"></script>
  <script src="{{asset('template/frontend')}}/plugins/jqueryform/jquery.form.js"></script>
  <!-- Toastr -->
  <script src="{{$template}}/vendors/toastr/toastr.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="{{$template}}/vendors/sweetalert2/sweetalert2.min.js"></script>
  <script src="{{$template}}/vendors/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="{{$template}}/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="{{$template}}/vendors/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>

  <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    var ToastError = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: true
    });

    $('button.navbar-toggler').on('click', function() {

      if ($('body').hasClass('sidebar-icon-only')) {

        $('body').removeClass('sidebar-icon-only');

      } else {

        $('body').addClass('sidebar-icon-only');

      }
    });

    var notif = (status, message, url) => {
      if (status == 'success') {
        Toast.fire({
          icon: 'success',
          title: message
        });
        setTimeout(function() {
          window.location.href = url
        }, 950);
      } else {
        ToastError.fire({
          icon: 'error',
          title: message,
        });

        console.log(message)
      }
    }

    var static_notif = (status, msg) => {
      if (status == 'success') {
        Toast.fire({
          icon: 'success',
          title: msg
        });

      } else {
        ToastError.fire({
          icon: 'error',
          title: msg,
        });

        console.log(msg)
      }
    }
  </script>

  @stack('js')

</body>

</html>