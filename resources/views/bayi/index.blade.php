@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap page-header-modern">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2 class="page-title-modern">Data Bayi</h2>
                        <p class="mb-md-0 text-muted">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex breadcrumb-modern">
                        <i class="mdi mdi-home text-muted"></i>
                        <p class="text-muted mb-0">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 font-weight-bold">Bayi</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/bayi/create')}}" class="btn btn-primary btn-modern mt-2 mt-xl-0">
                            <i class="mdi mdi-plus-circle-outline mr-1"></i> Tambah Bayi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card card-modern">
                <div class="card-body" style="overflow-x: auto;">
                    <table id="tableData" class="table table-modern text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-left">Nama</th>
                                <th>Jenis Kelamin</th>
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
                            @php
                            $keyField = 'bayi_'.$b->id;
                            $timbangJson = [];
                            foreach ($dt_bayi_timbang->$keyField as $d) {
                                $sdBb = $d->sd_bb;
                                $sdPb = $d->sd_pb;
                                $timbangJson[] = [
                                    'bulan_ke'   => $d->bulan_ke,
                                    'bulan'      => $d->bulan,
                                    'bb'         => $d->berat_badan,
                                    'pb'         => $d->tinggi_badan,
                                    'bb_status'  => $statustmb['dt_bb_'.$d->id] ?? '',
                                    'pb_status'  => $statustmb['dt_pb_'.$d->id] ?? '',
                                    'sd_bb'      => $sdBb,
                                    'status_bb'  => $d->status_bb,
                                    'sd_pb'      => $sdPb,
                                    'status_pb'  => $d->status_pb,
                                ];
                            }
                            @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="text-left font-weight-semibold">{{ $b->nama }}</td>
                                <td>
                                    @if($b->l_p == 1)
                                    <span class="badge badge-pill badge-gender badge-gender-boy">
                                        <i class="mdi mdi-gender-male mr-1"></i> Laki-laki
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-gender badge-gender-girl">
                                        <i class="mdi mdi-gender-female mr-1"></i> Perempuan
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn-chip btn-chip-primary btn-regis"
                                        data-id="{{$b->id}}"
                                        data-nama="{{$b->nama}}"
                                        data-tgl="{{$b->tanggal_lahir}}"
                                        data-bb-pb="{{$b->bb_pb}}"
                                        data-ibu="{{$b->nama_ibu}}"
                                        data-ayah="{{$b->nama_ayah}}"
                                        data-lp="{{$b->l_p}}">
                                        <i class="mdi mdi-file-document-outline"></i> Registrasi
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn-chip btn-chip-secondary btn-timbang"
                                        data-id="{{$b->id}}"
                                        data-nama="{{$b->nama}}"
                                        data-timbang='{{ json_encode($timbangJson, JSON_HEX_APOS | JSON_HEX_QUOT) }}'>
                                        <i class="mdi mdi-scale-bathroom"></i> Hasil Timbang
                                    </button>
                                </td>
                                @if(!session()->has('kader'))
                                <td>
                                    @php
                                    $posyandu = DB::select(DB::raw('Select list_posyandu.nama from list_posyandu where id = '.$b->posyandu_id));
                                    @endphp
                                    <span class="badge badge-pill badge-outline-primary">{{$posyandu[0]->nama}}</span>
                                </td>
                                @endif
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{url('/bayi/')}}/{{$b->id}}/detail" data-toggle="tooltip" title="Lihat Detail" class="btn btn-outline-warning btn-sm btn-icon-modern">
                                            <i class="mdi mdi-account-card-details"></i>
                                        </a>
                                        <a href="{{url('/bayi/')}}/{{ $b->id }}/edit" data-toggle="tooltip" title="Update Data" class="btn btn-outline-primary btn-sm btn-icon-modern">
                                            <i class="mdi mdi-tooltip-edit"></i>
                                        </a>
                                        <button type="button" id="buttonDelete" onclick="deleteRow('{{$b->id}}')" data-toggle="modal" data-target="#modalConfirm" title="Hapus" class="btn btn-outline-danger btn-sm btn-icon-modern">
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

{{-- ============ Modal: Registrasi ============ --}}
<div class="modal fade" id="modalRegis" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-soft">
                <div>
                    <h5 class="modal-title mb-0" id="modalRegisLabel">Registrasi</h5>
                    <p class="modal-subtitle mb-0">Detail registrasi bayi</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="regis-detail-grid">
                    <div class="regis-detail-item">
                        <span class="regis-detail-label"><i class="mdi mdi-calendar-outline mr-1"></i>Tanggal Lahir</span>
                        <span class="regis-detail-value" id="modalRegisTgl">-</span>
                    </div>
                    <div class="regis-detail-item">
                        <span class="regis-detail-label"><i class="mdi mdi-clock-outline mr-1"></i>Umur</span>
                        <span class="regis-detail-value" id="modalRegisUmur">-</span>
                    </div>
                    <div class="regis-detail-item">
                        <span class="regis-detail-label"><i class="mdi mdi-human-male-female mr-1"></i>Jenis Kelamin</span>
                        <span class="regis-detail-value" id="modalRegisGender">-</span>
                    </div>
                    <div class="regis-detail-item">
                        <span class="regis-detail-label"><i class="mdi mdi-scale-bathroom mr-1"></i>BB/(PB/TB)</span>
                        <span class="regis-detail-value" id="modalRegisBbPb">-</span>
                    </div>
                    <div class="regis-detail-item regis-detail-item-full">
                        <span class="regis-detail-label"><i class="mdi mdi-account-heart-outline mr-1"></i>Orang Tua</span>
                        <span class="regis-detail-value" id="modalRegisOrtu">-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============ Modal: Hasil Timbang ============ --}}
<div class="modal fade" id="modalTimbang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-soft">
                <div>
                    <h5 class="modal-title mb-0" id="modalTimbangLabel">Hasil Timbang</h5>
                    <p class="modal-subtitle mb-0">Riwayat penimbangan bayi</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
                <table class="table table-hover text-center table-modal-timbang">
                    <thead>
                        <tr>
                            <th>Bulan Ke</th>
                            <th>Bulan</th>
                            <th>Berat Badan</th>
                            <th>Panjang/Tinggi Badan</th>
                            <th>Z BB/U</th>
                            <th>Kategori BB/U</th>
                            <th>Z PB/U atau TB/U</th>
                            <th>Kategori PB/U atau TB/U</th>
                        </tr>
                    </thead>
                    <tbody id="modalTimbangBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ============ Modal: Konfirmasi Hapus ============ --}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-modern">
            <div class="modal-header modal-header-dark">
                <p class="modal-title" id="modalConfirmTitle">Hapus data?</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid">
                <p class="text-muted small mb-3">Data yang sudah dihapus tidak dapat dikembalikan.</p>
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-light btn-sm btn-modern-sm" data-dismiss="modal" style="width: 100%;">Batal</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-danger btn-sm btn-modern-sm" id="modalConfirmYes" style="width: 100%;" onclick="deleteAcc()">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    /* ---------- Header ---------- */
    .page-title-modern {
        font-weight: 700;
        letter-spacing: -0.02em;
        color: #1a2333;
        margin-bottom: 2px;
    }

    .breadcrumb-modern {
        opacity: 0.85;
        font-size: 0.85rem;
    }

    /* ---------- Card ---------- */
    .card-modern {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(20, 30, 60, 0.06);
    }

    .btn-modern {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.55rem 1.1rem;
        box-shadow: 0 4px 10px rgba(66, 103, 178, 0.18);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(66, 103, 178, 0.25);
    }

    /* ---------- Table ---------- */
    .table-modern {
        border-collapse: separate;
        border-spacing: 0 6px;
    }

    .table-modern thead th {
        border: none;
        background-color: #f4f6fb;
        color: #5c6b8a;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 700;
        padding: 12px 10px;
    }

    .table-modern thead th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .table-modern thead th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .table-modern tbody tr {
        background-color: #fff;
        transition: background-color 0.15s ease, box-shadow 0.15s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f8faff;
        box-shadow: 0 2px 10px rgba(20, 30, 60, 0.05);
    }

    .table-modern tbody td {
        border: none;
        border-top: 1px solid #eef1f8;
        border-bottom: 1px solid #eef1f8;
        padding: 14px 10px;
        vertical-align: middle;
    }

    .table-modern tbody td:first-child {
        border-left: 1px solid #eef1f8;
        border-radius: 10px 0 0 10px;
    }

    .table-modern tbody td:last-child {
        border-right: 1px solid #eef1f8;
        border-radius: 0 10px 10px 0;
    }

    .font-weight-semibold {
        font-weight: 600;
        color: #1a2333;
    }

    /* ---------- Gender badge ---------- */
    .badge-gender {
        font-weight: 600;
        padding: 6px 12px;
        font-size: 0.78rem;
    }

    .badge-gender-boy {
        background-color: #e6f0ff;
        color: #2563eb;
    }

    .badge-gender-girl {
        background-color: #ffe6f1;
        color: #db2777;
    }

    .badge-purple {
        background-color: #B266FF;
        color: #fff;
    }

    .badge-outline-primary {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
    }

    /* ---------- Compact chip buttons (Registrasi / Hasil Timbang) ---------- */
    .btn-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: none;
        border-radius: 20px;
        font-size: 0.74rem;
        font-weight: 600;
        padding: 5px 13px;
        line-height: 1.4;
        cursor: pointer;
        transition: background-color 0.15s ease, transform 0.1s ease;
    }

    .btn-chip:active {
        transform: scale(0.97);
    }

    .btn-chip i {
        font-size: 0.95rem;
    }

    .btn-chip-primary {
        background-color: #eef2ff;
        color: #4f46e5;
    }

    .btn-chip-primary:hover {
        background-color: #e0e7ff;
        color: #4338ca;
    }

    .btn-chip-secondary {
        background-color: #fff4e6;
        color: #c2610a;
    }

    .btn-chip-secondary:hover {
        background-color: #ffe9cc;
        color: #9a4a06;
    }

    /* ---------- Buttons (Aksi column) ---------- */
    .btn-modern-sm {
        border-radius: 7px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .btn-icon-modern {
        border-radius: 7px;
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
    }

    /* ---------- Modal (shared) ---------- */
    .modal-content-modern {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }

    .modal-header-soft {
        background-color: #f8faff;
        border-bottom: 1px solid #eef1f8;
        align-items: flex-start;
    }

    .modal-header-soft .modal-title {
        font-weight: 700;
        color: #1a2333;
    }

    .modal-subtitle {
        font-size: 0.78rem;
        color: #8b96ab;
    }

    .modal-header-dark {
        background-color: #081F3E;
    }

    .modal-header-dark .modal-title,
    .modal-header-dark .close {
        color: #fff;
    }

    /* ---------- Registrasi detail grid ---------- */
    .regis-detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .regis-detail-item {
        background-color: #f8faff;
        border: 1px solid #eef1f8;
        border-radius: 10px;
        padding: 12px 14px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .regis-detail-item-full {
        grid-column: 1 / -1;
    }

    .regis-detail-label {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        color: #8b96ab;
    }

    .regis-detail-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1a2333;
    }

    /* ---------- Hasil Timbang table inside modal ---------- */
    .table-modal-timbang thead th {
        background-color: #f4f6fb;
        color: #5c6b8a;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        font-weight: 700;
        border-top: none;
        vertical-align: middle;
    }

    .table-modal-timbang tbody td {
        vertical-align: middle;
        font-size: 0.85rem;
    }

    @media (max-width: 576px) {
        .regis-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Modal hasil timbang diperbesar */
    .modal-xl {
        max-width: 95%;
    }

    .table-modal-timbang tbody td {
        padding: 14px;
        vertical-align: middle;
    }

    .table-modal-timbang .badge {
        padding: 7px 10px;
        font-size: 0.75rem;
    }

</style>
@endpush

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

        // ---------- Registrasi modal ----------
        $(document).on('click', '.btn-regis', function() {
            var $btn = $(this);
            var nama = $btn.data('nama');
            var tglRaw = $btn.data('tgl');
            var bbPb = $btn.data('bb-pb');
            var ibu = $btn.data('ibu');
            var ayah = $btn.data('ayah');
            var lp = $btn.data('lp');

            var tglMoment = moment(tglRaw, 'YYYY-MM-DD');
            var tglDisplay = tglMoment.format('DD-MM-YYYY');

            var refTgl = tglMoment.clone();
            var umurBulan = moment().diff(refTgl, 'months');
            refTgl.add(umurBulan, 'months');
            var umurHari = moment().diff(refTgl, 'days');

            $('#modalRegisLabel').text('Registrasi - ' + nama);
            $('#modalRegisTgl').text(tglDisplay);
            $('#modalRegisUmur').text(umurBulan + ' Bulan, ' + umurHari + ' Hari');
            $('#modalRegisGender').text(String(lp) === '1' ? 'Laki-laki' : 'Perempuan');
            $('#modalRegisBbPb').text(bbPb);
            $('#modalRegisOrtu').text('Ibu ' + ibu + ' dan Bapak ' + ayah);

            $('#modalRegis').modal('show');
        });

        // ---------- Hasil Timbang modal ----------
        $(document).on('click', '.btn-timbang', function() {
            var $btn = $(this);
            var nama = $btn.data('nama');
            var records = $btn.data('timbang');

            $('#modalTimbangLabel').text('Hasil Timbang - ' + nama);

            var $tbody = $('#modalTimbangBody').empty();

            if (!records || records.length === 0) {
                $tbody.append('<tr><td colspan="8" class="text-muted py-4">Belum ada data timbang</td></tr>');
            } else {
                records.forEach(function(d) {
                    var bbColor = d.sd_bb == '-3' ? 'danger' : (d.sd_bb == '-2' ? 'warning' : 'success');
                    var pbColor = d.sd_pb == '-3' ? 'danger' : (d.sd_pb == '-2' ? 'warning' : 'success');

                    var row = '<tr>' +
                        '<td><span class="badge badge-pill badge-light">' + d.bulan_ke + '</span></td>' +
                        '<td><span class="badge badge-pill badge-light">' + d.bulan + '</span></td>' +
                        '<td><span class="badge badge-pill badge-light mr-1">' + d.bb + ' kg</span><span class="badge badge-pill badge-purple">' + (d.bb_status || '-') + '</span></td>' +
                        '<td><span class="badge badge-pill badge-light mr-1">' + d.pb + ' cm</span><span class="badge badge-pill badge-purple">' + (d.pb_status || '-') + '</span></td>' +
                        '<td><span class="badge badge-pill badge-' + bbColor + '">' + d.sd_bb + ' SD</span></td>' +
                        '<td><span class="badge badge-pill badge-' + bbColor + '">' + d.status_bb + '</span></td>' +
                        '<td><span class="badge badge-pill badge-' + pbColor + '">' + d.sd_pb + ' SD</span></td>' +
                        '<td><span class="badge badge-pill badge-' + pbColor + '">' + d.status_pb + '</span></td>' +
                        '</tr>';

                    $tbody.append(row);
                });
            }

            $('#modalTimbang').modal('show');
        });

    });

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
