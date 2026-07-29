@extends('layouts.master')

@php
$topics = $menu['topics'];
$firstTopic = $topics[0];
@endphp

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <a href="{{url('konseling')}}" class="btn btn-primary btn-sm mb-3">
                <i class="mdi mdi-arrow-left mr-1"></i> Kembali ke Konseling
            </a>
            <div class="card konseling-header-card">
                <div class="card-body d-flex align-items-center">
                    <div class="konseling-detail-icon mr-3">
                        <i class="mdi {{$menu['icon']}}"></i>
                    </div>
                    <div>
                        <h2 class="mb-1">{{$menu['title']}}</h2>
                        <p class="text-muted mb-0">Pilih materi di kiri, gambar halaman Buku KIA akan tampil di kanan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 grid-margin">
            <div class="card topic-card">
                <div class="card-body p-3">
                    <h5 class="topic-sidebar-title">Materi</h5>
                    <div class="topic-list" id="topicList">
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
                        Halaman dirender dari PDF menjadi canvas agar tampil seperti gambar. Jika kosong, gunakan tombol <strong>Buka PDF</strong>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .konseling-header-card,
    .topic-card,
    .material-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.08);
    }

    .konseling-detail-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background-color: #e6f0ff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 58px;
    }

    .konseling-detail-icon i {
        color: #081F3E;
        font-size: 32px;
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
        background-color: #eef2ff;
        border-color: #93b4ff;
        color: #1d4ed8;
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
        background-color: #2563eb;
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

    @media (max-width: 991px) {
        .pdf-image-viewer {
            min-height: 520px;
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
            $loading.show();

            if (renderTask) {
                renderTask.cancel();
            }

            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                return pdf.getPage(parseInt(pageNumber, 10));
            }).then(function(page) {
                var viewport = page.getViewport({ scale: 1.45 });
                canvas.width = viewport.width;
                canvas.height = viewport.height;

                renderTask = page.render({
                    canvasContext: context,
                    viewport: viewport
                });

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

        selectTopic($('.topic-button.active').first());
    });
</script>
@endpush
