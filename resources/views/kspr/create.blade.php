@extends('layouts.master')
@push('css')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<style>
    .form-compact .form-group {
        margin: 0;
        padding: 0;
    }
    .form-compact .col-form-label {
        padding: 2px 4px;
        margin: 0;
        font-size: 14px;
        line-height: 1.2;
    }
    .form-compact .form-control {
        padding: 2px 4px;
        margin: 0;
        font-size: 14px;
        height: auto;
    }
</style>
<style>
    table.risk-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    table.risk-table th,
    table.risk-table td {
        border: 1px solid #000;
        padding: 2px 4px; /* very compact */
        vertical-align: top;
    }
    table.risk-table th {
        text-align: center;
        background: #eee;
    }
    .purple {
        background-color: #d9d2e9; /* light purple highlight like your image */
    }
    .bold {
        font-weight: bold;
    }
</style>
<style>
.tbl-risk { border-collapse: collapse; width: 100%; }
.tbl-risk th, .tbl-risk td { border: 1px solid #855b5e; padding: 6px; text-align: center; }
.bg-rose { background: #e7a2a7; }   /* header & risk columns */
.bg-yellow { background: #fff59d; } /* 6–10 highlight */
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 20px;
    } */
    h2, h3 {
        text-align: center;
        margin: 5px 0;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table, th, td {
        border: 1px solid black;
        padding: 5px;
        vertical-align: top;
    }
    th {
        text-align: center;
        background-color: #f2f2f2;
    }
    input[type="text"], input[type="number"] {
        width: 95%;
        padding: 2px;
        font-size: 12px;
    }
    .section-title {
        font-weight: bold;
        margin-top: 20px;
    }
    .no-border td {
        border: none;
    }
    textarea.form-control::placeholder {
    white-space: pre-line;
    font-family: monospace;
    }
  </style>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2, h3 { text-align: center; margin: 5px 0; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
    td, th { border: 1px solid #000; padding: 6px; vertical-align: top; }
    label { margin-right: 10px; display: inline-block; }
    input[type="text"], textarea, select { width: 95%; padding: 3px; }
    textarea { resize: vertical; }
    .section-title { font-weight: bold; background: #f2f2f2; }
  </style>
  <style>
    body {
        margin: 0;
    }

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
        color: #fff;
    }

    .kspr-form-card,
    .kspr-section-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(20, 30, 60, 0.06);
    }

    .kspr-section-card {
        border: 1px solid #eef1f8;
        box-shadow: none;
    }

    .kspr-form-card .card-body {
        padding: 24px;
    }

    .kspr-save-bar {
        position: sticky;
        top: 70px;
        z-index: 5;
        background-color: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(6px);
        border: 1px solid #eef1f8;
        border-radius: 12px;
        padding: 10px;
        margin-bottom: 16px;
    }

    .kspr-form-card .form-control,
    .kspr-form-card .select2-container .select2-selection--single {
        border: 1px solid #e5e9f2;
        border-radius: 8px;
        background-color: #f8faff;
    }

    .kspr-form-card .form-control:focus {
        border-color: #93b4ff;
        background-color: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .kspr-form-card table,
    .kspr-form-card th,
    .kspr-form-card td {
        border-color: #dbe3f5;
    }

    .kspr-form-card th,
    .kspr-form-card .section-title {
        background-color: #f4f6fb;
        color: #1a2333;
    }

    .kspr-form-card h2,
    .kspr-form-card h3 {
        color: #1a2333;
        font-weight: 700;
    }

    .risk-table th {
        background-color: #f4f6fb !important;
        color: #5c6b8a;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
  </style>
@endpush
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap page-header-modern">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2 class="page-title-modern">Deteksi Dini Ibu Hamil KSPR</h2>
                        <p class="mb-md-0 text-muted">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
                    </div>
                    <div class="d-flex breadcrumb-modern">
                        <i class="mdi mdi-home text-muted"></i>
                        <p class="text-muted mb-0">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 font-weight-bold">KSPR</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/kspr')}}" class="btn btn-primary btn-modern btn-sm mt-2 mt-xl-0">
                            <i class="mdi mdi-arrow-left mr-1"></i> Kembali
                        </a>
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card kspr-form-card">
                <div class="card-body">
                    <form action="{{isset($kspr)?url('/kspr/update/'.$kspr->id):url('/kspr')}}" method="POST" id="formData">
                        <!-- Floating save button (top-right) -->
                        <div class="d-flex justify-content-end kspr-save-bar">
                            <button type="submit" class="btn btn-sm btn-success btn-modern">
                                <i class="mdi mdi-content-save mr-1"></i> Simpan
                            </button>
                        </div>
                        
                    @if(isset($ppa))
                    <div class="ppa">
                         
                        <h2>KARTU SKOR POEDJI ROCHJATI</h2>
                        <h3>PERENCANAAN PERSALINAN AMAN</h3>
                        <br><br>
                            <!-- Persalinan Melahirkan Tanggal -->
                            <p>
                            <strong>Persalinan Melahirkan Tanggal :</strong>
                            <input type="date" name="tanggal_persalinan">
                            </p>
                            <input type="hidden" name="ppa" value="{{isset($kspr_final)? $kspr_final->id: 0}}">
                            <table>
                            <tr>
                                <!-- RUJUK DARI -->
                                <td style="width:50%">
                                <div class="section-title">RUJUK DARI</div>
                                <label><input type="checkbox" name="rujuk_dari[]" value="Sendiri" {{isset($kspr_final) && $kspr_final->rujuk_dari == 'Sendiri'? 'checked': ''}}> 1. Sendiri</label><br>
                                <label><input type="checkbox" name="rujuk_dari[]" value="Dukun" {{isset($kspr_final) && $kspr_final->rujuk_dari == 'Dukun'? 'checked': ''}}> 2. Dukun</label><br>
                                <label><input type="checkbox" name="rujuk_dari[]" value="Bidan" {{isset($kspr_final) && $kspr_final->rujuk_dari == 'Bidan'? 'checked': ''}}> 3. Bidan</label><br>
                                <label><input type="checkbox" name="rujuk_dari[]" value="Puskesmas" {{isset($kspr_final) && $kspr_final->rujuk_dari == 'Puskesmas'? 'checked': ''}}> 4. Puskesmas</label><br><br>

                                <div><strong>Rujukan :</strong></div>
                                <label><input type="checkbox" name="rujukan[]" value="RDB" {{isset($kspr_final) && $kspr_final->rujukan == 'RDB'? 'checked': ''}}> 1. Rujukan Dini Berencana (RDB)</label><br>
                                <label><input type="checkbox" name="rujukan[]" value="RDR" {{isset($kspr_final) && $kspr_final->rujukan == 'RDR'? 'checked': ''}}> 2. Rujukan Dalam Rahim (RDR)</label>
                                </td>

                                <!-- RUJUK KE -->
                                <td style="width:50%">
                                <div class="section-title">RUJUK KE</div>
                                <label><input type="checkbox" name="rujuk_ke[]" value="Bidan" {{isset($kspr_final) && $kspr_final->rujuk_ke == 'Bidan'? 'checked': ''}}> 1. Bidan</label><br>
                                <label><input type="checkbox" name="rujuk_ke[]" value="Puskesmas" {{isset($kspr_final) && $kspr_final->rujuk_ke == 'Puskesmas'? 'checked': ''}}> 2. Puskesmas</label><br>
                                <label><input type="checkbox" name="rujuk_ke[]" value="Rumah Sakit" {{isset($kspr_final) && $kspr_final->rujuk_ke == 'Rumah Sakit'? 'checked': ''}}> 3. Rumah Sakit</label><br><br>

                                <div><strong>Rujukan :</strong></div>
                                <label><input type="checkbox" name="rujukan2[]" value="RTW"> 2. Rujukan Tepat Waktu (RTW)</label><br>
                                <label><input type="checkbox" name="rujukan2[]" value="RT"> 3. Rujukan Terlambat (RT)</label>
                                </td>
                            </tr>
                            </table>

                            <!-- Gawat Obstetrik -->
                            <table>
                            <tr>
                                <td style="width:50%">
                                <div class="section-title">Kel. Faktor Risiko I & II</div>
                                <ol>
                                    @foreach($ppa as $key => $value)
                                    <li><input type="text" name="faktor_risiko[]" value="{{isset($value->masalah)?$value->masalah:''}}"></li>
                                    @endforeach
                                </ol>
                                </td>
                                <td style="width:50%">
                                <div class="section-title">Gawat Darurat Obstetrik</div>
                                <label><input type="checkbox" name="gawat[]" value="Perdarahan antepartum"> 1. Perdarahan antepartum</label><br>
                                <label><input type="checkbox" name="gawat[]" value="Eklamsia"> 2. Eklamsia</label><br>
                                <div><strong>Komplikasi Obstetrik :</strong></div>
                                <label><input type="checkbox" name="komplikasi[]" value="Perdarahan postpartum"> 3. Perdarahan postpartum</label><br>
                                <label><input type="checkbox" name="komplikasi[]" value="Uri tertinggal"> 4. Uri tertinggal</label><br>
                                <label><input type="checkbox" name="komplikasi[]" value="Persalinan lama"> 5. Persalinan Lama</label><br>
                                <label><input type="checkbox" name="komplikasi[]" value="Panas tinggi"> 6. Panas Tinggi</label>
                                </td>
                            </tr>
                            </table>

                            <!-- TEMPAT PENOLONG MACAM PERSALINAN -->
                            <table>
                            <tr>
                                <td><div class="section-title">TEMPAT :</div>
                                <label><input type="checkbox" name="tempat[]" value="Rumah Ibu"> 1. Rumah Ibu</label><br>
                                <label><input type="checkbox" name="tempat[]" value="Rumah Bidan"> 2. Rumah Bidan</label><br>
                                <label><input type="checkbox" name="tempat[]" value="Polindes"> 3. Polindes</label><br>
                                <label><input type="checkbox" name="tempat[]" value="Puskesmas"> 4. Puskesmas</label><br>
                                <label><input type="checkbox" name="tempat[]" value="Rumah Sakit"> 5. Rumah Sakit</label><br>
                                <label><input type="checkbox" name="tempat[]" value="Perjalanan"> 6. Perjalanan</label><br>
                                <label><input type="checkbox" name="tempat[]" value="Lain-lain"> 7. Lain-lain</label>
                                </td>
                                <td><div class="section-title">PENOLONG :</div>
                                <label><input type="checkbox" name="penolong[]" value="Dukun"> 1. Dukun</label><br>
                                <label><input type="checkbox" name="penolong[]" value="Bidan"> 2. Bidan</label><br>
                                <label><input type="checkbox" name="penolong[]" value="Dokter"> 3. Dokter</label><br>
                                <label><input type="checkbox" name="penolong[]" value="Lain-lain"> 4. Lain-lain</label>
                                </td>
                                <td><div class="section-title">MACAM PERSALINAN :</div>
                                <label><input type="checkbox" name="macam[]" value="Normal"> 1. Normal</label><br>
                                <label><input type="checkbox" name="macam[]" value="Tindakan Pervaginam"> 2. Tindakan Pervaginam</label><br>
                                <label><input type="checkbox" name="macam[]" value="Operasi Sesar"> 3. Operasi Sesar</label>
                                </td>
                            </tr>
                            </table>

                            <!-- PASCA PERSALINAN -->
                            <table>
                            <tr>
                                <td style="width:50%">
                                <div class="section-title">PASCA PERSALINAN : IBU</div>
                                <label><input type="radio" name="pasca_ibu" value="Hidup"> 1. Hidup</label><br>
                                <label><input type="radio" name="pasca_ibu" value="Mati"> 2. Mati, dengan penyebab:</label><br>
                                <label><input type="checkbox" name="penyebab[]" value="Perdarahan"> a. Perdarahan</label><br>
                                <label><input type="checkbox" name="penyebab[]" value="Preeklampsia/Eklampsia"> b. Preeklampsia/Eklampsia</label><br>
                                <label><input type="checkbox" name="penyebab[]" value="Partus lama"> c. Partus lama</label><br>
                                <label><input type="checkbox" name="penyebab[]" value="Infeksi"> d. Infeksi</label><br>
                                <label><input type="checkbox" name="penyebab[]" value="Lain-lain"> e. Lain-lain</label>
                                </td>
                                <td>
                                <div class="section-title">TEMPAT KEMATIAN IBU :</div>
                                <label><input type="checkbox" name="tempat_kematian[]" value="Rumah Ibu"> 1. Rumah Ibu</label><br>
                                <label><input type="checkbox" name="tempat_kematian[]" value="Rumah Bidan"> 2. Rumah Bidan</label><br>
                                <label><input type="checkbox" name="tempat_kematian[]" value="Polindes"> 3. Polindes</label><br>
                                <label><input type="checkbox" name="tempat_kematian[]" value="Puskesmas"> 4. Puskesmas</label>
                                </td>
                            </tr>
                            </table>

                            <div class="section-title">PASCA PERSALINAN : BAYI</div>
                            <p>
                            1. Berat Lahir : <input type="text" name="berat_bayi"> gram, 
                            <label><input type="radio" name="jk_bayi" value="Laki-laki"> Laki-laki</label>
                            <label><input type="radio" name="jk_bayi" value="Perempuan"> Perempuan</label>
                            </p>
                            <p>2. Lahir Hidup: APGAR Skor <input type="text" name="apgar"></p>
                            <p>3. Lahir mati, penyebab <input type="text" name="lahir_mati_penyebab"></p>
                            <p>4. Mati Kemudian, Umur <input type="text" name="umur_mati"> hr, penyebab <input type="text" name="penyebab_mati"></p>
                            <p>5. Kelainan bawaan: 
                            <label><input type="radio" name="kelainan" value="Tidak ada"> Tidak ada</label>
                            <label><input type="radio" name="kelainan" value="Ada"> Ada</label>
                            <input type="text" name="kelainan_ket">
                            </p>

                            <!-- NIFAS -->
                            <div class="section-title">KEADAAN IBU SELAMA MASA NIFAS (42 Hari Pasca salin)</div>
                            <label><input type="radio" name="nifas" value="Sehat"> 1. Sehat</label>
                            <label><input type="radio" name="nifas" value="Sakit"> 2. Sakit</label>
                            <label><input type="radio" name="nifas" value="Mati"> 3. Mati, penyebab <input type="text" name="nifas_penyebab"></label>
                            <p>Pemberian ASI : 
                            <label><input type="radio" name="asi" value="Ya"> 1. Ya</label>
                            <label><input type="radio" name="asi" value="Tidak"> 2. Tidak</label>
                            </p>

                            <!-- KB -->
                            <div class="section-title">Keluarga Berencana</div>
                            <label><input type="radio" name="kb" value="Ya"> 1. Ya</label> <input type="text" name="kb_keterangan">
                            / Sterilisasi <input type="text" name="kb_sterilisasi"><br>
                            <label><input type="radio" name="kb" value="Belum tahu"> 2. Belum tahu</label>

                            <!-- Keluarga Miskin -->
                            <div class="section-title">Kategori Keluarga Miskin :</div>
                            <label><input type="radio" name="miskin" value="Ya"> 1. Ya</label>
                            <label><input type="radio" name="miskin" value="Tidak"> 2. Tidak</label>
                    </div>

                    <br/>
                    <hr/>
                    <hr/>
                    <br/>
                    @endif

                    
                    @if(isset($kspr))
                    @php
                        $skor = 2;
                        foreach($kspr_detail as $key => $value){
                            foreach($value as $key1 => $value1){
                                foreach($value1 as $key2 => $value2){
                                    $skor = $skor + (int) $value2;
                                }
                            }
                        }
                    @endphp
                    <h3 class="text-center">PENYULUHAN KEHAMILAN / PERSALINAN AMAN – RUJUKAN TERENCANA</h3>
                    <table class="tbl-risk">
                    <thead>
                        <tr class="bg-rose">
                        <th rowspan="2">JML SKOR</th>
                        <th rowspan="2">KEL RISIKO</th>
                        <th colspan="2">KEHAMILAN</th>
                        <th colspan="5">PERSALINAN DENGAN RISIKO</th>
                        </tr>
                        <tr class="bg-rose">
                        <th>PERAWATAN</th>
                        <th>RUJUKAN</th>
                        <th>TEMPAT</th>
                        <th>PENOLONG</th>
                        <th>RDB</th>
                        <th>RDR</th>
                        <th>RTW</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row: 2 -->
                        @if($skor >= 2 && $skor <= 5)
                        <tr>
                            <td>{{$skor}}</td>
                            <td>KRR</td>
                            <td>BIDAN</td>
                            <td>TIDAK DIRUJUK</td>
                            <td>RUMAH POLINDES</td>
                            <td>BIDAN</td>
                            <td class="bg-rose"><input type="text" name="rdb" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rdb:''}}"></td>
                            <td class="bg-rose"><input type="text" name="rdr" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rdr:''}}"></td>    
                            <td class="bg-rose"><input type="text" name="rtw" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rtw:''}}"></td>
                        </tr>
                        @elseif($skor >= 6 && $skor <= 12)

                        <!-- Row: 6–10 (yellow across first 6 cols; risk cols stay rose) -->
                        <tr>
                        <td class="bg-yellow">{{$skor}}</td>
                        <td class="bg-yellow">KRT</td>
                        <td class="bg-yellow">BIDAN<br>DOKTER</td>
                        <td class="bg-yellow">BIDAN PKM</td>
                        <td class="bg-yellow">POLINDES<br>PKM/RS</td>
                        <td class="bg-yellow">BIDAN<br>DOKTER</td>
                        <td class="bg-rose"><input type="text" name="rdb" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rdb:''}}"></td>
                            <td class="bg-rose"><input type="text" name="rdr" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rdr:''}}"></td>    
                            <td class="bg-rose"><input type="text" name="rtw" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rtw:''}}"></td>
                        </tr>
                        @elseif($skor > 12)
                        <!-- Row: ≥12 (entire row rose) -->
                        <tr class="bg-rose">
                        <td>{{$skor}}</td>
                        <td>KRST</td>
                        <td>DOKTER</td>
                        <td>RUMAH SAKIT</td>
                        <td>RUMAH SAKIT</td>
                        <td>DOKTER</td>
                        <td><input type="text" name="rdb" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rdb:''}}"></td>
                        <td><input type="text" name="rdr" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rdr:''}}"></td>    
                        <td><input type="text" name="rtw" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->rtw:''}}"></td>
                        </tr>
                        @endif
                    </tbody>
                    </table>
                    <br> <br>
                    @endif

                        {{ csrf_field() }}

                        <!-- ============PART 1============= -->

                            <div class="form-row">
                                <div class="col-sm-12 grid-margin stretch-card">
                                    <div class="card kspr-section-card">
                                        <div class="card-body">
                                            <h3 class="text-center">SKRINING / DETEKSI DINI IBU RISIKO TINGGI</h3>
                                            <br>
                                           <div class="row form-compact">
                                                <!-- Left Column -->
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Pilih Dari Data Ibu Hamil</label>
                                                        <div class="col-8">
                                                            <select name="bumil" class="form-control form-control-sm select2">
                                                                <option value="">Pilih Nama Ibu Hamil</option>
                                                                @foreach($list_nama_bumils as $key => $value)
                                                                <option value="{{json_encode($value)}}">{{$value->nama_ibu}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Nama</label>
                                                        <div class="col-8">
                                                            <input type="text" name="nama" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->nama:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Umur Ibu</label>
                                                        <div class="col-8 d-flex align-items-center">
                                                            <input type="number" name="umur" class="form-control form-control-sm" style="max-width:70px;" value="{{isset($kspr)?$kspr->umur:''}}">
                                                            <span>&nbsp;th</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Pendidikan</label>
                                                        <div class="col-8">
                                                            <input type="text" name="pendidikan" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->pendidikan:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Hamil Ke</label>
                                                        <div class="col-8">
                                                            <input type="number" name="hamil_ke" class="form-control form-control-sm" style="max-width:70px;" value="{{isset($kspr)?$kspr->hamil_ke:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Periksa I</label>
                                                        <div class="col-8">
                                                            <input type="text" name="periksa_ke" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->periksa_ke:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Umur Kehamilan</label>
                                                        <div class="col-8 d-flex align-items-center">
                                                            <input type="number" name="umur_kehamilan" class="form-control form-control-sm" style="max-width:70px;" value="{{isset($kspr)?$kspr->umur_kehamilan:''}}">
                                                            <span>&nbsp;minggu</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Right Column -->
                                                <div class="col-6">
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Alamat</label>
                                                        <div class="col-8">
                                                            <input type="text" name="alamat" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->alamat:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Kec./Kab</label>
                                                        <div class="col-8">
                                                            <input type="text" name="kec_kab" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->kec_kab:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Pekerjaan</label>
                                                        <div class="col-8">
                                                            <input type="text" name="pekerjaan" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->pekerjaan:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">HPHT (Hari Pertama Haid Terakhir)</label>
                                                        <div class="col-8">
                                                            <input type="date" name="haid_terlambat" class="form-control form-control-sm" value="{{isset($kspr)?$kspr->haid_terlambat:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">HPL (Hari Perkiraan Lahir)</label>
                                                        <div class="col-8">
                                                            <input type="date" name="perkiraan_persalinan" class="form-control form-control-sm"  value="{{isset($kspr)?$kspr->perkiraan_persalinan:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-4 col-form-label">Di</label>
                                                        <div class="col-8">
                                                            <input type="text" name="di" class="form-control form-control-sm"  value="{{isset($kspr)?$kspr->di:''}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group col-md-12">
                                                <label>Posyandu <span style="color: red;">*</span> </label>
                                                <select name="posyandu_id" class="form-control form-control-sm" required>
                                                    <option value="">Silahkan Pilih!</option>
                                                    @foreach($list_posyandu as $lp)
                                                    <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div> -->

                                            <table class="risk-table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">I</th>
                                                        <th style="width: 3%">II</th>
                                                        <th style="width: 50%">III</th>
                                                        <th colspan="5">IV</th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan="2">KEL F.R.</th>
                                                        <th rowspan="2">NO.</th>
                                                        <th>Masalah / Faktor Resiko</th>
                                                        <th style="width: 5%">SKOR</th>
                                                        <th colspan="4">TRIBULAN</th>
                                                    </tr>
                                                    <tr>

                                                        <th>Skor Awal Ibu Hamil</th>
                                                        <th>2</th>
                                                        <th>I</th>
                                                        <th>II</th>
                                                        <th>III.1</th>
                                                        <th>III.2</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $kelompok = 0;
                                                        function toRoman($number) {
                                                            $map = [
                                                                1 => 'I',
                                                                2 => 'II',
                                                                3 => 'III',
                                                                4 => 'IV',
                                                                5 => 'V',
                                                                6 => 'VI',
                                                                7 => 'VII',
                                                                8 => 'VIII',
                                                                9 => 'IX',
                                                                10 => 'X'
                                                            ];
                                                            return $map[$number] ?? $number;
                                                        }
                                                        
                                                    @endphp
                                                    @foreach($kspr_master as $key => $value)
                                                    @if($value->skor >= 8)
                                                        <tr class="purple">
                                                    @else
                                                        <tr>
                                                    @endif
                                                        @if($value->kelompok != $kelompok)
                                                        <td class="text-center" rowspan="{{$value->total}}">{{toRoman($value->kelompok)}}</td>
                                                        @php
                                                        $kelompok = $value->kelompok;
                                                        @endphp
                                                        @else
                                                        
                                                        @endif
                                                        <td></td>
                                                        <td>{{$value->masalah}}</td>
                                                        <td class="text-center">{{$value->skor}}</td>
                                                        @if((int) $value->skor > 0)
                                                        <td class="text-center">
                                                            <input type="checkbox" 
                                                                name="tribulan[1][]" 
                                                                id="{{$value->skor}}" 
                                                                class="1"
                                                                value='@json($value)' 
                                                                {{ isset($kspr_detail[1][$value->id]) ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" 
                                                                id="{{$value->skor}}" 
                                                                name="tribulan[2][]" 
                                                                class="2"
                                                                value='@json($value)' 
                                                                {{ isset($kspr_detail[2][$value->id]) ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" 
                                                                name="tribulan[3][]"
                                                                id="{{$value->skor}}" 
                                                                class="3"
                                                                value='@json($value)' 
                                                                {{ isset($kspr_detail[3][$value->id]) ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" 
                                                                id="{{$value->skor}}" 
                                                                class="4"
                                                                name="tribulan[4][]" 
                                                                value='@json($value)' 
                                                                {{ isset($kspr_detail[4][$value->id]) ? 'checked' : '' }}>
                                                        </td>
                                                        @else
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                    <tr class="text-center">
                                                        <td colspan="3" class="bold text-left">JUMLAH SKOR</td>
                                                        <td></td>
                                                        <td class="total_tribulan1"></td>
                                                        <td class="total_tribulan2"></td>
                                                        <td class="total_tribulan3"></td>
                                                        <td class="total_tribulan4"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
        $('#formData').validate({
            rules: {
                nama: {
                    required: true
                }
            },
            highlight: function(e) {
                $(e).closest('.form-control').addClass('is-invalid');
            },
            unhighlight: function(e) {
                $(e).closest('.form-control').removeClass('is-invalid');
                $(e).closest('.form-control').addClass('is-valid');
            },
            success: function(e) {
                $(e).closest('.form-control').removeClass('is-invalid');
                $(e).closest('.form-control').addClass('is-valid');
            },
        });
    })

    $('select[name=bumil]').on('change', function(){
        const data_ibu = JSON.parse($(this).val());
        console.log(data_ibu)
        $('input[name=nama]').val(data_ibu?.nama_ibu ?? '-')
        $('input[name=umur]').val(data_ibu?.umur ?? '-')
        $('input[name=pendidikan]').val(data_ibu?.pendidikan ?? '-')
        $('input[name=hamil_ke]').val(data_ibu?.hamil_ke ?? '-')
        $('input[name=periksa_ke]').val(data_ibu?.periksa_ke ?? '1')
        $('input[name=umur_kehamilan]').val(data_ibu?.umur_kehamilan)
        $('input[name=alamat]').val(data_ibu?.alamat ?? '-')
        $('input[name=kec_kab]').val(data_ibu?.kec_kab ?? '-')
        $('input[name=pekerjaan]').val(data_ibu?.pekerjaan ?? '-')
    })


    $('input[type="checkbox"]:checked').each(function () {
    if ($(this).attr('class') == '1') {
        let current = parseInt($('.total_tribulan1').text()) || 0;
        $('.total_tribulan1').text(current + parseInt($(this).attr('id')));
    }
    if ($(this).attr('class') == '2') {
        let current = parseInt($('.total_tribulan2').text()) || 0;
        $('.total_tribulan2').text(current + parseInt($(this).attr('id')));
    }
    if ($(this).attr('class') == '3') {
        let current = parseInt($('.total_tribulan3').text()) || 0;
        $('.total_tribulan3').text(current + parseInt($(this).attr('id')));
    }
    if ($(this).attr('class') == '4') {
        let current = parseInt($('.total_tribulan4').text()) || 0;
        $('.total_tribulan4').text(current + parseInt($(this).attr('id')));
    }
});


    $(document).on('change', 'input[type="checkbox"]', function () {
    let tribulanClass = $(this).attr('class'); 
    let value = parseInt($(this).attr('id')) || 2;

    if (tribulanClass >= 1 && tribulanClass <= 4) {
        let selector = '.total_tribulan' + tribulanClass;
        let current = parseInt($(selector).text()) || 2;

        if ($(this).is(':checked')) {
            $(selector).text(current + value);
        } else {
            $(selector).text(current - value);
        }
    }
});

</script>

@endpush
