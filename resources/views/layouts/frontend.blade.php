@php

$template = asset('template/frontend_');

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Posyandu (Pos Pelayanan Terpadu) | {{$title}}</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="{{$template}}/assets/img/favicon.png" rel="icon"> -->
    <link href="{{$template}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Lato:400,300,700,900" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{$template}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{$template}}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{$template}}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="{{$template}}/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{$template}}/assets/css/style.css" rel="stylesheet">

    <link href="{{$template}}/../../assets/css/frontend.css" rel="stylesheet">
    <!-- =======================================================
  * Template Name: Amoeba - v2.0.0
  * Template URL: https://bootstrapmade.com/free-one-page-bootstrap-template-amoeba/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">

        <div class="container">
            <div class="logo float-left">
                <h1 class="text-light"><a href="index.html"><span>E-Posyandu</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="{{$template}}/assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav class="nav-menu float-right d-none d-lg-block">
                <ul>
                    <li class="active"><a href="#header">Home</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="https://eposyandu-gateway.id/kagita" class="registration">KAGITA</a></li>
                    <!-- <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li><a href="#contact">Contact Us</a></li> -->
                    @if(!session()->has('login'))
                    <li class="ml-5"><a href="#" class="registration" data-toggle="modal" data-target="#modalRegis">Jadi Kader</a></li>
                    @endif
                    
                </ul>
            </nav><!-- .nav-menu -->

        </div>
    </header><!-- End #header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <h1 class="round">Selamat Datang di,</h1>
            <h2 class="round"> Elektronik Posyandu (Pos Pelayanan Terpadu) Jember </h2>
            @if(session()->has('login'))
            <a href="{{url('/dashboard')}}" class="btn-get-started scrollto">Dashboard</a>
            @else
            <a href="#" data-toggle="modal" data-target="#modalLogin" class="btn-get-started scrollto" onclick="login()">Masuk</a>
            @endif
        </div>
    </section><!-- #hero -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>About Us</h2>
                </div>

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2">
                        <img src="{{$template}}/assets/img/about.jpeg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1">
                        <h3>Posyandu (Pos Pelayanan Terpadu) Jember</h3>
                        <br>

                        <ul>
                            <li><i class="icofont-check-circled"></i>Buka: <span>Senin-Jumat 8:30-16:00</span></li>
                            <li><i class="icofont-check-circled"></i> Email: <span> info@eposyandu-kelor.net</span>
                            <li><i class="icofont-check-circled"></i>Handphone: <span>+62 8585 6376 061</span></li>
                        </ul>
                        <p>
                            Dalam upaya memberikan kemudahan pelayanan kesehatan dasar dan untuk meningkatkan penurunan Angka Kematian Ibu dan Bayi, Posyandu (Pos Pelayanan Terpadu) bekerjama dengan Tim Pengabdian kepada Masyarakat Politeknik Negeri Jember menyelenggarakan BIMTEK penggunaan aplikasi Elektronik Posyandu (Pos Pelayanan Terpadu) (eposyandu kelor) pada tanggal 08 Agustus 2022.
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Layanan Posyandu</h2>
                    <p>Layanan dari E-posyandu (Pos Pelayanan Terpadu).</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="icofont-computer"></i></div>
                        <h4 class="title"><a href="">Pendataan</a></h4>
                        <p class="description">Sebagai media pendataan posyandu secara digital.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="icofont-chart-bar-graph"></i></div>
                        <h4 class="title"><a href="">Statistik</a></h4>
                        <p class="description">Sebagai statistik dalam menganalisa ibu dan bayi.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="icofont-tasks-alt"></i></div>
                        <h4 class="title"><a href="">Laporan Analisa</a></h4>
                        <p class="description">Laporan dapat dipantau oleh masing-masing ibu.</p>
                    </div>
                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Call To Action Section ======= -->
        <section class="call-to-action">
            <div class="container">
                @if(!session()->has('login'))
                <div class="text-center">
                    <h3>Ingin Menjadi Kader Posyandu</h3>
                    <p>Daftar menjadi kader posyandu membutuhkan beberapa persyaratan, silahkan klik tombol dibawah...</p>
                    <a href="#" class="registration" data-toggle="modal" data-target="#modalRegis">Jadi Kader</a>
                </div>
                @endif

            </div>
        </section><!-- End Call To Action Section -->
        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>E-posyandu</span></strong>. (Pos Pelayanan Terpadu)
                </div>
                <div class="credits">

                </div>
            </div>
        </footer><!-- End #footer -->

        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

        <!-- modal -->
        <!-- ########################LOGIN -->
        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Silahkan isi username dan password!</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formLogin" method="post" action="{{url('/postlogin')}}">
                        <div class="modal-body" style="background-color: white;">
                            {{ csrf_field() }}
                            <small id="emailHelp" class="form-text text-muted"><i>Pastikan <b>username</b> dan <b>password</b> yang di isikan benar.</i></small>
                            <br>
                            @if(session()->has('loginFalse'))
                            <div class="alert alert-danger" role="alert" style="font-size: 12px; width: 100%;"><i class="fa fa-exclamation-triangle"></i>
                                {{session()->get('loginFalse')}}
                            </div>
                            @endif
                            <div class="form-group">

                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" minlength="8" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6"><button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="width: 100%;">Batal</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="submit" id="btn-login" class="btn btn-outline-success" style="width: 100%;">Masuk</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ########################REGISTRATION -->
        <div class="modal fade" id="modalRegis" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle" style="color: white;">Daftar Menjadi Kader Posyandu</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formRegistrasi" method="post" action="{{url('/postregistration')}}">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="part_1">
                                <br>
                                @if(session()->has('registrasiSuccess'))
                                <div class="alert alert-success" role="alert" style="font-size: 12px; width: 100%;"><i class="fa fa-exclamation-triangle"></i>
                                    {{session()->get('registrasiSuccess')}}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="- isi nama anda -" required>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control" placeholder="- isi NIK anda -" required maxlength="16" minlength="16">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="- isi alamat anda -" required>
                                </div>
                                <small id="emailHelp" class="form-text text-muted"><i>- Isi jika anda memiliki email dan nomor telfon - </i></small>
                                <br>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="- isi email anda -">
                                </div>
                                <div class="form-group">
                                    <label for="no_tlp">No Telfon</label>
                                    <input type="text" name="no_tlp" id="no_tlp" class="form-control" placeholder="- isi no telfon anda -">
                                </div>
                            </div>
                            <div class="part_2" hidden="true">
                                <div class="form-group">
                                    <label for="regisUsername">Username</label>
                                    <input type="text" name="regisUsername" id="regisUsername" class="form-control" placeholder="- isi username yang anda inginkan -" required>
                                </div>
                                <div class="form-group">
                                    <label for="regisPassword">Password</label>
                                    <input type="password" name="regisPassword" id="regisPassword" class="form-control" minlength="8" required>
                                </div>
                                <div class="form-group">
                                    <label for="verifRegisPassword">Ulangi Password</label>
                                    <input type="password" name="verifRegisPassword" id="verifRegisPassword" class="form-control" minlength="8" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <small class="form-text text-muted" style="color: red"><i id="posyanduHelp">- nama posyandu wajib dipilih - </i></small>
                                        <br>
                                        <label>Posyandu</label>
                                        <br>
                                        <select name="posyandu_id" id="posyandu_id" class="form-control">
                                            <option value="">- Silahkan Pilih Posyandu -</option>
                                            @foreach($list_posyandu as $lp)
                                            <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                            @endforeach
                                        </select>
                                        <br><br>
                                        <input type="hidden" name="complete" required>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="modal-footer part_1">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="width: 100%;">Batal</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" onclick="registrasi.next()" class="btn btn-outline-success" onclick="" style="width: 100%;">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer part_2" hidden="true">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-outline-danger" style="width: 100%;" onclick="registrasi.back()">Kembali</button>

                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" id="submitRegis" class="btn btn-outline-success" onclick="" style="width: 100%;">Registrasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Vendor JS Files -->
        <script src="{{$template}}/assets/vendor/jquery/jquery.min.js"></script>
        <script src="{{$template}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{$template}}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
        <script src="{{$template}}/assets/vendor/php-email-form/validate.js"></script>
        <script src="{{$template}}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="{{$template}}/assets/vendor/venobox/venobox.min.js"></script>

        <!-- Template Main JS File -->
        <script src="{{$template}}/assets/js/main.js"></script>
        <script src="{{$template}}/plugins/jquery-validation/jquery.validate.js"></script>
        <script src="{{$template}}/plugins/jquery-validation/localization/messages_id.js"></script>

        <!-- JS BUATAN SENDIRI!!!!!! -->
        <script>
            var nik = @json($nik);
            var username = @json($username);
            var isLoginFalse = `{{session()->has('loginFalse')}}`;
            var isregistrasiSuccess = `{{session()->has('registrasiSuccess')}}`;
        </script>
        <script src="{{$template}}/../../assets/js/frontend.js"></script>
</body>

</html>