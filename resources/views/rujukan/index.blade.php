@extends('layouts.master')

@php
$firstTopic = $topics[0];
$sicantikUrl = 'https://g1200n.puskesmasrambipuji.my.id/';
@endphp

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card rujukan-header-card">
                <div class="card-body d-flex align-items-center">
                    <div class="rujukan-icon mr-3">
                        <i class="mdi mdi-ambulance"></i>
                    </div>
                    <div>
                        <h2 class="mb-1">Rujukan</h2>
                        <p class="text-muted mb-0">Materi rujukan dan tanda bahaya dari Buku KIA. Pilih topik di kiri.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs rujukan-tabs mb-3" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="gizi-buruk-tab" data-toggle="tab" href="#gizi-buruk" role="tab" aria-controls="gizi-buruk" aria-selected="false">Bayi Gizi Buruk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="stunting-tab" data-toggle="tab" href="#stunting" role="tab" aria-controls="stunting" aria-selected="false">Bayi Stunting</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="bumil-risti-tab" data-toggle="tab" href="#bumil-risti" role="tab" aria-controls="bumil-risti" aria-selected="false">Bumil Risiko Tinggi</a>
        </li>
        <li class="nav-item ml-auto">
            <a class="nav-link active" id="materi-tab" data-toggle="tab" href="#materi" role="tab" aria-controls="materi" aria-selected="true">Materi Rujukan</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="materi" role="tabpanel" aria-labelledby="materi-tab">
            <div class="row">
        <div class="col-lg-3 grid-margin">
            <div class="card topic-card">
                <div class="card-body p-3">
                    <h5 class="topic-sidebar-title">Materi Rujukan</h5>
                    <div class="topic-list">
                        @foreach($topics as $index => $topic)
                        @php
                        $pdfUrl = str_replace(' ', '%20', asset('file/'.$topic['pdf']));
                        @endphp
                        <button type="button"
                            class="topic-button {{$index == 0 ? 'active' : ''}}"
                            data-title="{{$topic['title']}}"
                            data-summary="{{$topic['summary']}}"
                            data-pdf="{{$pdfUrl}}"
                            data-page="{{$topic['page']}}">
                            <span class="topic-number">{{str_pad($index + 1, 2, '0', STR_PAD_LEFT)}}</span>
                            <span>{{$topic['title']}}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 grid-margin stretch-card">
            <div class="card material-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-3">
                        <div>
                            <h3 class="mb-2" id="topicTitle">{{$firstTopic['title']}}</h3>
                            <p class="topic-summary mb-0" id="topicSummary">{{$firstTopic['summary']}}</p>
                        </div>
                        <a href="{{str_replace(' ', '%20', asset('file/'.$firstTopic['pdf']))}}#page={{$firstTopic['page']}}" target="_blank" class="btn btn-outline-primary btn-sm mt-3 mt-md-0" id="openPdfButton">
                            <i class="mdi mdi-open-in-new mr-1"></i> Buka PDF
                        </a>
                    </div>

                    <div class="pdf-image-viewer">
                        <div class="pdf-loading" id="pdfLoading">Memuat gambar materi...</div>
                        <canvas id="pdfCanvas"></canvas>
                    </div>
                    <div class="pdf-note mt-3">
                        Halaman dirender dari PDF menjadi canvas seperti gambar. Jika kosong, gunakan tombol <strong>Buka PDF</strong>.
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>

        <div class="tab-pane fade" id="gizi-buruk" role="tabpanel" aria-labelledby="gizi-buruk-tab">
            <div class="card material-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-4">
                        <div>
                            <h3 class="mb-2">Bayi Gizi Buruk</h3>
                            <p class="topic-summary mb-0">Bayi dengan penimbangan terakhir di bawah -3 SD BB/PB atau BB/TB.</p>
                        </div>
                        <a href="{{url('/api/rujukan/bayi-gizi-buruk')}}" target="_blank" class="btn btn-outline-primary btn-sm mt-3 mt-md-0">
                            <i class="mdi mdi-code-json mr-1"></i> API JSON
                        </a>
                    </div>

                    <div class="risk-toolbar mb-3">
                        <div class="risk-stat-card danger">
                            <span>Total Kasus</span>
                            <strong>{{count($bayiGiziBuruk)}}</strong>
                        </div>
                        <div class="risk-search-wrap">
                            <i class="mdi mdi-magnify"></i>
                            <input type="text" class="form-control risk-search" data-target="#tableBayiGiziBuruk" placeholder="Cari nama, posyandu, orang tua...">
                        </div>
                    </div>

                    <div class="table-responsive risk-table-wrap">
                        <table class="table risk-table text-center" id="tableBayiGiziBuruk">
                            <thead>
                                <tr>
                                    <th>Nama Bayi</th>
                                    <th>Orang Tua</th>
                                    <th>Posyandu</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>BB</th>
                                    <th>PB/TB</th>
                                    <th>Batas -3 SD</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bayiGiziBuruk as $bayi)
                                <tr>
                                    <td class="text-left">
                                        <strong>{{$bayi->nama}}</strong>
                                        <small>ID: {{$bayi->bayi_id}}</small>
                                    </td>
                                    <td>{{$bayi->nama_ibu}}</td>
                                    <td>{{$bayi->posyandu ?: '-'}}</td>
                                    <td><span class="risk-chip muted">{{$bayi->jenis_kelamin}}</span></td>
                                    <td>{{$bayi->umur_bulan}} bulan, {{$bayi->umur_hari}} hari</td>
                                    <td><strong>{{$bayi->berat_badan}}</strong> kg</td>
                                    <td>{{$bayi->tinggi_badan}} cm</td>
                                    <td>{{$bayi->batas_gizi_buruk}} kg</td>
                                    <td><span class="risk-chip danger">{{$bayi->status_rujukan}}</span></td>
                                    <td>
                                        <a href="{{$sicantikUrl}}" target="_blank" class="btn btn-danger btn-sm">Rujuk</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-muted">Tidak ada bayi gizi buruk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="stunting" role="tabpanel" aria-labelledby="stunting-tab">
            <div class="card material-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-4">
                        <div>
                            <h3 class="mb-2">Bayi Stunting</h3>
                            <p class="topic-summary mb-0">Bayi dengan penimbangan terakhir kategori pendek atau sangat pendek berdasarkan PB/U atau TB/U.</p>
                        </div>
                        <a href="{{url('/api/rujukan/bayi-stunting')}}" target="_blank" class="btn btn-outline-primary btn-sm mt-3 mt-md-0">
                            <i class="mdi mdi-code-json mr-1"></i> API JSON
                        </a>
                    </div>

                    <div class="risk-toolbar mb-3">
                        <div class="risk-stat-card warning">
                            <span>Total Kasus</span>
                            <strong>{{count($bayiStunting)}}</strong>
                        </div>
                        <div class="risk-search-wrap">
                            <i class="mdi mdi-magnify"></i>
                            <input type="text" class="form-control risk-search" data-target="#tableBayiStunting" placeholder="Cari nama, posyandu, orang tua...">
                        </div>
                    </div>

                    <div class="table-responsive risk-table-wrap">
                        <table class="table risk-table text-center" id="tableBayiStunting">
                            <thead>
                                <tr>
                                    <th>Nama Bayi</th>
                                    <th>Orang Tua</th>
                                    <th>Posyandu</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>PB/TB</th>
                                    <th>Z-score PB/U - TB/U</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bayiStunting as $bayi)
                                <tr>
                                    <td class="text-left">
                                        <strong>{{$bayi->nama}}</strong>
                                        <small>ID: {{$bayi->bayi_id}}</small>
                                    </td>
                                    <td>{{$bayi->nama_ibu}}</td>
                                    <td>{{$bayi->posyandu ?: '-'}}</td>
                                    <td><span class="risk-chip muted">{{$bayi->jenis_kelamin}}</span></td>
                                    <td>{{$bayi->umur_bulan}} bulan, {{$bayi->umur_hari}} hari</td>
                                    <td>{{$bayi->tinggi_badan}} cm</td>
                                    <td><span class="risk-chip {{$bayi->sd_pb == '-3' ? 'danger' : 'warning'}}">{{$bayi->sd_pb}}</span></td>
                                    <td><span class="risk-chip {{$bayi->sd_pb == '-3' ? 'danger' : 'warning'}}">{{$bayi->status_pb}}</span></td>
                                    <td>
                                        <a href="{{$sicantikUrl}}" target="_blank" class="btn btn-danger btn-sm">Rujuk</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-muted">Tidak ada bayi stunting.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="bumil-risti" role="tabpanel" aria-labelledby="bumil-risti-tab">
            <div class="card material-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-4">
                        <div>
                            <h3 class="mb-2">Bumil Risiko Tinggi</h3>
                            <p class="topic-summary mb-0">Ibu hamil risiko tinggi berdasarkan skor KSPR.</p>
                        </div>
                        <a href="{{url('/api/rujukan/bumil-risiko-tinggi')}}" target="_blank" class="btn btn-outline-primary btn-sm mt-3 mt-md-0">
                            <i class="mdi mdi-code-json mr-1"></i> API JSON
                        </a>
                    </div>

                    <div class="risk-toolbar mb-3">
                        <div class="risk-stat-card warning">
                            <span>Total Kasus</span>
                            <strong>{{count($bumilRisikoTinggi)}}</strong>
                        </div>
                        <div class="risk-search-wrap ml-auto">
                            <i class="mdi mdi-magnify"></i>
                            <input type="text" class="form-control risk-search" data-target="#tableBumilRisti" placeholder="Cari nama, posyandu, alasan...">
                        </div>
                    </div>

                    <div class="table-responsive risk-table-wrap">
                        <table class="table risk-table text-center" id="tableBumilRisti">
                            <thead>
                                <tr>
                                    <th>Nama Ibu</th>
                                    <th>Posyandu</th>
                                    <th>Umur</th>
                                    <th>Hamil Ke</th>
                                    <th>Skor KSPR</th>
                                    <th>Kategori</th>
                                    <th>Alasan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bumilRisikoTinggi as $bumil)
                                <tr data-source="{{$bumil->sumber_risiko}}">
                                    <td class="text-left">
                                        <strong>{{$bumil->nama_ibu}}</strong>
                                        <small>{{$bumil->bumil_id ? 'BUMIL ID: '.$bumil->bumil_id : 'KSPR ID: '.$bumil->kspr_screening_id}}</small>
                                    </td>
                                    <td>{{$bumil->posyandu ?: '-'}}</td>
                                    <td>{{$bumil->umur ?: '-'}}</td>
                                    <td>{{$bumil->hamil_ke ?: '-'}}</td>
                                    <td><strong>{{$bumil->skor_kspr ?: '-'}}</strong></td>
                                    <td>{!! $bumil->kategori_kspr ? '<span class="risk-chip '.($bumil->kategori_kspr == 'KRST' ? 'danger' : 'warning').'">'.$bumil->kategori_kspr.'</span>' : '-' !!}</td>
                                    <td class="text-left">{{$bumil->alasan}}</td>
                                    <td>
                                        <a href="{{$sicantikUrl}}" target="_blank" class="btn btn-danger btn-sm">Rujuk</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-muted">Tidak ada bumil risiko tinggi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .rujukan-header-card,
    .topic-card,
    .material-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.08);
    }

    .rujukan-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background-color: #ffe6e6;
        color: #c01818;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 58px;
        font-size: 32px;
    }

    .rujukan-tabs .nav-link {
        font-weight: 700;
        color: #374151;
        border: none;
        border-radius: 10px 10px 0 0;
    }

    .rujukan-tabs .nav-link.active {
        color: #c01818;
        background-color: #fff1f2;
    }

    .topic-sidebar-title {
        font-weight: 700;
        margin-bottom: 12px;
        color: #1a2333;
    }

    .topic-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .topic-button {
        border: 1px solid #eef1f8;
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        display: flex;
        gap: 10px;
        align-items: center;
        text-align: left;
        color: #374151;
        font-weight: 600;
        font-size: 0.86rem;
        cursor: pointer;
        transition: background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease;
    }

    .topic-button:hover,
    .topic-button.active {
        background-color: #fff1f2;
        border-color: #fca5a5;
        color: #c01818;
    }

    .topic-number {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background-color: #f3f4f6;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex: 0 0 28px;
    }

    .topic-button.active .topic-number {
        background-color: #c01818;
        color: #fff;
    }

    .topic-summary {
        color: #6b7280;
        max-width: 760px;
        line-height: 1.55;
    }

    .pdf-image-viewer {
        position: relative;
        min-height: 640px;
        background-color: #f8faff;
        border: 1px solid #eef1f8;
        border-radius: 14px;
        overflow: auto;
        text-align: center;
        padding: 18px;
    }

    #pdfCanvas {
        max-width: 100%;
        height: auto;
        background-color: #fff;
        box-shadow: 0 8px 28px rgba(15, 23, 42, 0.14);
        border-radius: 6px;
    }

    .pdf-loading {
        position: absolute;
        top: 16px;
        left: 16px;
        z-index: 1;
        background-color: #081F3E;
        color: #fff;
        border-radius: 999px;
        padding: 6px 14px;
        font-size: 0.8rem;
    }

    .pdf-note {
        color: #6b7280;
        font-size: 0.85rem;
    }

    .risk-toolbar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        background: linear-gradient(135deg, #f8faff 0%, #fff 100%);
        border: 1px solid #eef1f8;
        border-radius: 14px;
        padding: 12px;
    }

    .risk-stat-card {
        min-width: 130px;
        border-radius: 12px;
        padding: 10px 14px;
        color: #fff;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.12);
    }

    .risk-stat-card span {
        display: block;
        font-size: 0.72rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .risk-stat-card strong {
        display: block;
        font-size: 1.6rem;
        line-height: 1.1;
    }

    .risk-stat-card.danger {
        background: linear-gradient(135deg, #dc2626, #fb7185);
    }

    .risk-stat-card.warning {
        background: linear-gradient(135deg, #d97706, #fbbf24);
    }

    .risk-search-wrap {
        position: relative;
        min-width: 260px;
        flex: 1;
    }

    .risk-search-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        z-index: 1;
    }

    .risk-search {
        border: 1px solid #e5e7eb;
        border-radius: 999px;
        padding-left: 36px;
        height: 40px;
        box-shadow: none;
    }

    .risk-filter {
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #475569;
        border-radius: 999px;
        padding: 8px 14px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.15s ease;
    }

    .risk-filter:hover,
    .risk-filter.active {
        border-color: #f59e0b;
        color: #92400e;
        background: #fffbeb;
    }

    .risk-table-wrap {
        border: 1px solid #eef1f8;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    }

    .risk-table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .risk-table thead th {
        background: #fee2e2;
        color: #991b1b;
        border: none;
        font-size: 0.74rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        vertical-align: middle;
        white-space: nowrap;
    }

    .risk-table tbody td {
        border-top: 1px solid #eef1f8;
        vertical-align: middle;
        background: #fff;
    }

    .risk-table tbody tr:hover td {
        background: #f8faff;
    }

    .risk-table td small {
        display: block;
        color: #94a3b8;
        margin-top: 2px;
        font-size: 0.7rem;
    }

    .risk-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 0.72rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .risk-chip.danger {
        color: #991b1b;
        background: #fee2e2;
    }

    .risk-chip.warning {
        color: #92400e;
        background: #fef3c7;
    }

    .risk-chip.muted {
        color: #334155;
        background: #e2e8f0;
    }

    @media (max-width: 991px) {
        .pdf-image-viewer {
            min-height: 520px;
        }

        .risk-search-wrap {
            min-width: 100%;
        }
    }
</style>
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

        var $title = $('#topicTitle');
        var $summary = $('#topicSummary');
        var $openPdf = $('#openPdfButton');
        var $loading = $('#pdfLoading');
        var canvas = document.getElementById('pdfCanvas');
        var context = canvas.getContext('2d');
        var renderTask = null;

        function renderPdfPage(pdfUrl, pageNumber) {
            $loading.text('Memuat gambar materi...').show();
            if (renderTask) renderTask.cancel();

            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                return pdf.getPage(parseInt(pageNumber, 10));
            }).then(function(page) {
                var viewport = page.getViewport({ scale: 1.45 });
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                renderTask = page.render({ canvasContext: context, viewport: viewport });
                return renderTask.promise;
            }).then(function() {
                $loading.hide();
            }).catch(function(error) {
                if (error && error.name === 'RenderingCancelledException') return;
                $loading.text('Gagal memuat gambar materi.').show();
            });
        }

        function selectTopic($button) {
            $('.topic-button').removeClass('active');
            $button.addClass('active');

            var pdfUrl = $button.data('pdf');
            var page = $button.data('page');
            $title.text($button.data('title'));
            $summary.text($button.data('summary'));
            $openPdf.attr('href', pdfUrl + '#page=' + page);
            renderPdfPage(pdfUrl, page);
        }

        $('.topic-button').on('click', function() {
            selectTopic($(this));
        });

        function applyRiskFilter(tableSelector) {
            var $table = $(tableSelector);
            var query = $('.risk-search[data-target="' + tableSelector + '"]').val();
            var activeFilter = $('.risk-filter.active[data-target="' + tableSelector + '"]').data('filter');

            query = query ? query.toString().toLowerCase() : '';
            activeFilter = activeFilter ? activeFilter.toString() : '';

            $table.find('tbody tr').each(function() {
                var $row = $(this);
                var textMatch = !query || $row.text().toLowerCase().indexOf(query) !== -1;
                var filterMatch = !activeFilter || ($row.data('source') || '').toString().indexOf(activeFilter) !== -1;
                $row.toggle(textMatch && filterMatch);
            });
        }

        $('.risk-search').on('keyup', function() {
            applyRiskFilter($(this).data('target'));
        });

        $('.risk-filter').on('click', function() {
            var $button = $(this);
            $('.risk-filter[data-target="' + $button.data('target') + '"]').removeClass('active');
            $button.addClass('active');
            applyRiskFilter($button.data('target'));
        });

        selectTopic($('.topic-button.active').first());
    });
</script>
@endpush
