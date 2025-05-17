@extends('layouts.admin-master')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {!! $html->scripts() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! Toastr::message() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function delconf(url) {
            swal({
                title: "Hapus Data ?",
                text: "Semua data tidak dapat dikembalikan !",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    window.location.href = url;
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }</script>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($title) ? $title : 'Dashboard' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('pasien.create') }}" class="btn btn-success">Tambah Data
                        Pasien</a></div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        {!! $html->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
