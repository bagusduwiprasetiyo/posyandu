@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap page-header-modern">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2 class="page-title-modern">Konseling</h2>
                        <p class="mb-md-0 text-muted">Pilih materi konseling berdasarkan Buku KIA bagian ibu.</p>
                    </div>
                    <div class="d-flex breadcrumb-modern">
                        <i class="mdi mdi-home text-muted"></i>
                        <p class="text-muted mb-0">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 font-weight-bold">Konseling</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
    $menus = [
        ['title' => 'Ibu Hamil', 'icon' => 'mdi-human-pregnant', 'color' => '#e6f0ff', 'accent' => '#2563eb', 'text' => 'Informasi kesehatan selama masa kehamilan.', 'url' => 'konseling/ibu-hamil', 'tag' => 'Kehamilan'],
        ['title' => 'Ibu Bersalin', 'icon' => 'mdi-hospital-building', 'color' => '#fff3b0', 'accent' => '#b8860b', 'text' => 'Persiapan dan tanda persalinan aman.', 'url' => 'konseling/ibu-bersalin', 'tag' => 'Persalinan'],
        ['title' => 'Ibu Nifas', 'icon' => 'mdi-heart-pulse', 'color' => '#ffd6d6', 'accent' => '#dc2626', 'text' => 'Perawatan ibu setelah melahirkan.', 'url' => 'konseling/ibu-nifas', 'tag' => 'Pemulihan'],
        ['title' => 'Ibu Menyusui', 'icon' => 'mdi-baby', 'color' => '#d8f8df', 'accent' => '#16a34a', 'text' => 'Panduan menyusui dan ASI.', 'url' => 'konseling/ibu-menyusui', 'tag' => 'Menyusui'],
        ['title' => 'Keluarga Berencana', 'icon' => 'mdi-human-male-female', 'color' => '#ffe6f1', 'accent' => '#db2777', 'text' => 'Pilihan dan edukasi keluarga berencana.', 'url' => 'konseling/keluarga-berencana', 'tag' => 'Perencanaan'],
        ['title' => 'Kelas Ibu Hamil', 'icon' => 'mdi-school', 'color' => '#e9ffd9', 'accent' => '#65a30d', 'text' => 'Kegiatan belajar bersama ibu hamil.', 'url' => 'konseling/kelas-ibu-hamil', 'tag' => 'Edukasi'],
        ['title' => 'Bayi 0 - 6 Bulan', 'icon' => 'mdi-baby', 'color' => '#e0f2fe', 'accent' => '#0284c7', 'text' => 'Perawatan bayi baru lahir sampai 6 bulan.', 'url' => 'konseling/bayi-0-6-bulan', 'tag' => 'Bayi'],
        ['title' => 'Bayi 6 - 12 Bulan', 'icon' => 'mdi-food-apple', 'color' => '#fff7ed', 'accent' => '#ea580c', 'text' => 'MPASI, pemantauan tumbuh kembang, dan stimulasi.', 'url' => 'konseling/bayi-6-12-bulan', 'tag' => 'MPASI'],
        ['title' => 'Anak 12 - 24 Bulan', 'icon' => 'mdi-teddy-bear', 'color' => '#f3e8ff', 'accent' => '#7e22ce', 'text' => 'Kesehatan dan perkembangan anak usia 1-2 tahun.', 'url' => 'konseling/anak-12-24-bulan', 'tag' => 'Balita'],
        ['title' => 'Anak 2 - 6 Tahun', 'icon' => 'mdi-human-child', 'color' => '#dcfce7', 'accent' => '#15803d', 'text' => 'Stimulasi, gizi, keamanan, dan kesehatan anak.', 'url' => 'konseling/anak-2-6-tahun', 'tag' => 'Pra Sekolah'],
    ];
    @endphp

    <div class="konseling-search-panel mb-3">
        <div class="konseling-search-wrap">
            <i class="mdi mdi-magnify konseling-search-icon"></i>
            <input
                type="text"
                id="konselingSearch"
                class="konseling-search-input"
                placeholder="Cari materi konseling..."
                autocomplete="off">
            <button type="button" id="konselingSearchClear" class="konseling-search-clear" aria-label="Bersihkan pencarian">
                <i class="mdi mdi-close"></i>
            </button>
        </div>
    </div>

    <div class="row" id="konselingGrid">
        @foreach($menus as $index => $menu)
        <div class="col-sm-6 col-lg-4 col-xl-3 mb-3 stretch-card konseling-item" data-title="{{ strtolower($menu['title'].' '.$menu['tag']) }}" style="animation-delay: {{ $index * 60 }}ms;">
            <a href="{{url($menu['url'])}}" class="card konseling-card text-decoration-none w-100">
                <span class="konseling-tag" style="background-color: {{$menu['color']}}; color: {{$menu['accent']}};">{{$menu['tag']}}</span>
                <div class="card-body p-3">
                    <div class="konseling-icon" style="background-color: {{$menu['color']}};">
                        <i class="mdi {{$menu['icon']}}" style="color: {{$menu['accent']}};"></i>
                    </div>
                    <h4 class="konseling-title">{{$menu['title']}}</h4>
                    <p class="konseling-text">{{$menu['text']}}</p>
                    <span class="konseling-action">
                        Lihat Materi
                        <i class="mdi mdi-arrow-right konseling-arrow"></i>
                    </span>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <div id="konselingEmpty" class="konseling-empty" hidden>
        <i class="mdi mdi-file-search-outline"></i>
        <p class="mb-0">Tidak ada materi yang cocok dengan pencarian Anda.</p>
        <button type="button" id="konselingResetSearch" class="konseling-reset-btn">Reset pencarian</button>
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

    /* ---------- Search box ---------- */
    .konseling-search-panel {
        background-color: #fff;
        border: 1px solid #eef1f8;
        border-radius: 12px;
        padding: 12px;
        box-shadow: 0 3px 14px rgba(15, 23, 42, 0.04);
    }

    .konseling-search-wrap {
        position: relative;
        width: 420px;
        max-width: 100%;
    }

    .konseling-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa5ba;
        font-size: 1.15rem;
        pointer-events: none;
    }

    .konseling-search-input {
        width: 100%;
        border: 1px solid #e5e9f2;
        background-color: #f8faff;
        border-radius: 9px;
        padding: 9px 38px 9px 40px;
        font-size: 0.86rem;
        color: #1a2333;
        outline: none;
        transition: border-color 0.15s ease, box-shadow 0.15s ease, background-color 0.15s ease;
    }

    .konseling-search-input::placeholder {
        color: #9aa5ba;
    }

    .konseling-search-input:focus {
        border-color: #93b4ff;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .konseling-search-clear {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #9aa5ba;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .konseling-search-clear:hover {
        background-color: #eef1f8;
        color: #4b5563;
    }

    .konseling-search-wrap.has-value .konseling-search-clear {
        display: flex;
    }

    /* ---------- Cards ---------- */
    .konseling-item {
        opacity: 0;
        animation: konselingFadeIn 0.45s ease forwards;
    }

    @keyframes konselingFadeIn {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .konseling-card {
        position: relative;
        border: 1px solid #eef1f8;
        border-radius: 13px;
        color: #1f2937;
        box-shadow: 0 3px 14px rgba(15, 23, 42, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        overflow: hidden;
    }

    .konseling-card:hover,
    .konseling-card:focus-visible {
        color: #1f2937;
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.1);
        border-color: #dbe3f5;
    }

    .konseling-card:focus-visible {
        outline: 2px solid #2563eb;
        outline-offset: 2px;
    }

    .konseling-card:active {
        transform: translateY(-1px) scale(0.99);
    }

    .konseling-tag {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 0.62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 3px 8px;
        border-radius: 20px;
    }

    .konseling-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        transition: transform 0.25s ease;
    }

    .konseling-card:hover .konseling-icon {
        transform: scale(1.08) rotate(-4deg);
    }

    .konseling-icon i {
        font-size: 26px;
    }

    .konseling-title {
        font-weight: 700;
        margin-bottom: 6px;
        font-size: 1rem;
        color: #1a2333;
    }

    .konseling-text {
        color: #6b7280;
        min-height: 38px;
        margin-bottom: 10px;
        font-size: 0.82rem;
        line-height: 1.45;
    }

    .konseling-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #2563eb;
        font-weight: 700;
        font-size: 0.78rem;
    }

    .konseling-arrow {
        transition: transform 0.2s ease;
    }

    .konseling-card:hover .konseling-arrow {
        transform: translateX(4px);
    }

    /* ---------- Empty state ---------- */
    .konseling-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 60px 20px;
        color: #8b96ab;
    }

    .konseling-empty i {
        font-size: 44px;
        margin-bottom: 12px;
        color: #c3cbdc;
    }

    .konseling-reset-btn {
        margin-top: 14px;
        border: 1px solid #dbe3f5;
        background-color: #fff;
        color: #2563eb;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 8px 18px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }

    .konseling-reset-btn:hover {
        background-color: #eef2ff;
    }

    @media (max-width: 767px) {
        .konseling-search-wrap {
            width: 100%;
        }
    }
</style>
@endpush

@push('js')
<script>
    jQuery(document).ready(function($) {
        var $search = $('#konselingSearch');
        var $searchWrap = $('.konseling-search-wrap');
        var $items = $('.konseling-item');
        var $empty = $('#konselingEmpty');
        var $grid = $('#konselingGrid');

        function filterMenus(query) {
            query = query.trim().toLowerCase();
            var visibleCount = 0;

            $items.each(function() {
                var $item = $(this);
                var matches = query === '' || $item.data('title').toString().indexOf(query) !== -1;
                $item.toggle(matches);
                if (matches) visibleCount++;
            });

            $searchWrap.toggleClass('has-value', query.length > 0);
            $grid.toggle(visibleCount > 0);
            $empty.attr('hidden', visibleCount > 0);
        }

        $search.on('input', function() {
            filterMenus($(this).val());
        });

        $('#konselingSearchClear, #konselingResetSearch').on('click', function() {
            $search.val('').trigger('focus');
            filterMenus('');
        });
    });
</script>
@endpush
