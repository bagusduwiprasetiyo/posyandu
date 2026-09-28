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
  .page-title-modern { font-weight: 700; letter-spacing: -0.02em; color: #1a2333; margin-bottom: 2px; }
  .breadcrumb-modern { opacity: 0.85; font-size: 0.85rem; }
  .btn-modern { border-radius: 8px; font-weight: 600; padding: 0.55rem 1.1rem; box-shadow: 0 4px 10px rgba(66, 103, 178, 0.18); transition: transform 0.15s ease, box-shadow 0.15s ease; }
  .btn-modern:hover { transform: translateY(-1px); box-shadow: 0 6px 14px rgba(66, 103, 178, 0.25); color: #fff; }
  .bumil-form-card { border: none; border-radius: 14px; box-shadow: 0 2px 16px rgba(20, 30, 60, 0.06); }
  .bumil-form-card .card:not(.bumil-form-card) { border: 1px solid #eef1f8; border-radius: 12px; box-shadow: none; }
  .bumil-form-card .form-control { border: 1px solid #e5e9f2; border-radius: 8px; background-color: #f8faff !important; }
  .bumil-form-card .form-control:focus { border-color: #93b4ff; background-color: #fff !important; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
  .bumil-form-card .card-title { font-weight: 700; color: #1a2333; }
  .bumil-form-card table th { background-color: #f4f6fb; color: #5c6b8a; }
</style>
@endpush

@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap page-header-modern">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">

            <h2 class="page-title-modern">Data Ibu Hamil</h2>
            <p class="mb-md-0 text-muted">Sistem Informasi Posyandu (Pos Pelayanan Terpadu).</p>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap breadcrumb-modern">
            <i class="mdi mdi-home text-muted"></i>
            <p class="text-muted mb-0">&nbsp;/&nbsp;Ibu Hamil&nbsp;/&nbsp;</p>
            <p class="text-primary mb-0 font-weight-bold">Edit Data</p>
          </div>

        </div>
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <div>
            <a href="{{url('/bumil')}}" class="btn btn-primary btn-modern btn-sm mt-2 mt-xl-0">
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
      <div class="card bumil-form-card">
        <div class="card-body">



          <form action="{{url('/bumil/')}}/{{$bumils->id}}/update" method="POST" id="formData">
            {{ csrf_field() }}
            @method('PUT')
            <!-- ============PART 1============= -->

            <div id="part_1">
              <div class="form-row">
                <div class="col-md-6">
                  <!-- <div class="form-row">
                    <div class="form-group col-md-9">
                      <input type="hidden" name="bumils_id" value="{{$bumils->id}}">
                      <label>Pilih Pasien <span style="color: red;">*</span></label>
                      <select class="form-control selectpicker" data-live-search="true" disabled>
                        <option value="{{ $bumils->pasien_id }}" selected>{{ $bumils->nama }}</option>
                      </select>
                      <p style="color: red;" id="pasien_id_required" hidden="true">pilih pasien !</p>
                      <input type="hidden" name="pasien_id" value="{{$bumils->pasien_id}}">
                    </div>
                    <div class="form-group col-sm-2 umur_pasien">
                      <label>Umur</label>
                      <input style="background-color: #F3F3F3;" type="text" name="umur_pasien" class="form-control form-control-sm" value="{{$bumils->umur}}">
                    </div>
                  </div> -->
                  <div class="form-row nama_ibu">
                    <div class="form-group col-md-8 ">
                      <label>Nama Ibu <span style="color: red;">*</span></label>
                      <input style="background-color: #F3F3F3;" type="text" name="nama_ibu" class="form-control form-control-sm" required value="{{$bumils->nama_ibu}}">
                    </div>
                    <div class="form-group col-md-4 ">
                      <label>Umur Ibu<span style="color: red;">*</span></label>
                      <input style="background-color: #F3F3F3;" type="number" name="umur" class="form-control form-control-sm" required value="{{$bumils->umur}}">
                    </div>
                    <div class="form-group col-md-6 ">
                      <label>Nama Suami <span style="color: red;">*</span></label>
                      <input style="background-color: #F3F3F3;" type="text" name="nama_suami" class="form-control form-control-sm" required value="{{$bumils->nama_suami}}">
                    </div>

                    <div class="form-group col-md-6">
                      <label>Posyandu <span style="color: red;">*</span> </label>
                      <select name="posyandu_id" class="form-control form-control-sm" required>
                        <option value="">Silahkan Pilih!</option>
                        @foreach($list_posyandu as $lp)
                        @if($lp->id == $bumils->posyandu_id)
                        <option selected="true" value="{{$lp->id}}">{{$lp->nama}}</option>
                        @else
                        <option value="{{$lp->id}}">{{$lp->nama}}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-sm-12">
                    <label>KLP Dasa Wisma</label>
                    <input style="background-color: #F3F3F3;" type="text" name="klp_dasa_wisma" class="form-control form-control-sm" value="{{$bumils->klp_dasa_wisma}}">
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Data Ibu Hamil</h4>
                      <br>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Hamil Ke- <span style="color: red;">*</span></label>
                          <input style="background-color: #F3F3F3;" type="text" name="hamil_ke" class="form-control form-control-sm" required value="{{$bumils->hamil_ke}}">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Lila <span style="color: red;">*</span></label>
                          <input style="background-color: #F3F3F3;" type="text" name="lila" class="form-control form-control-sm" value="{{$bumils->lila}}" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label>PMT Pemulihan</label>
                          <input style="background-color: #F3F3F3;" type="text" name="pmt_pemulihan" class="form-control form-control-sm" value="{{$bumils->pmt_pemulihan}}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">

                        <h4 class="card-title">Pendaftaran Ibu Hamil</h4>
                        <br>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label>Tanggal Pendaftaran <span style="color: red;">*</span></label>
                            <input style="background-color: #F3F3F3;" type="date" name="tanggal" class="form-control form-control-sm" required value="{{$bumils->tanggal}}">
                          </div>
                          <div class="form-group col-md-2">
                            <label>Umur Kelahiran <span style="color: red;">*</span></label>
                            <input style="background-color: #F3F3F3;" type="text" name="umur_kelahiran" class="form-control form-control-sm" required placeholder="minggu" value="{{$bumils->umur_kelahiran}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <br><br>
                  <button type="button" class="btn btn-sm btn-primary selanjutnya" onclick="next(1)" style="width: 100%;">Selanjutnya</button>
                </div>
              </div>
            </div>

            <!-- ==========PART 2========= -->


            <div id="part_2" hidden="true">

              <div class="form-row">
                <div class="col-md-7 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Tablet Tambah Darah</h4>
                      <br>
                      <div class="card">
                        <div class="card-body">

                          <h4 class="card-title">Pemberian tablet tambah darah</h4>

                          <div class="row">
                            <div class="col-sm-12">
                              <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="tablet_tambah_darah()">+</button>

                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <table class="table table-hover table-sm table-bordered" id="tablet_tambah_darah">
                              @php
                              $i = 1;
                              @endphp
                              @foreach($dt_bumil_td as $d)
                              @php
                              $randNumber = rand(10, 100);
                              @endphp
                              <tr class="tmb_darah tmb_darah_{{$randNumber}}">
                                <td style="width: 10px;">
                                  <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_tablet('{{$randNumber}}')">
                                    <i class="mdi mdi-delete-forever"></i>
                                  </button>
                                </td>
                                <td class="title_tmb_darah">
                                  <div class="input-group">
                                    <div class="input-group-append">
                                      <button type="button" class="btn btn-sm btn-light">Tablet ke -</button>
                                    </div>
                                    <input type="number" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="tablet ke " name="status_tambah_darah[{{$randNumber}}]" max="3" min="1" value="{{$d->status}}" required></input>
                                  </div>
                                </td>
                                <td>
                                  <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3" name="tanggal_tambah_darah[{{$randNumber}}]" value="{{$d->tanggal}}"></input>
                                </td>
                              </tr>
                              @php
                              $i++;
                              @endphp
                              @endforeach
                            </table>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card" style="height: 150px;">

                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Kapsul Yodium</h4>

                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="kapsul_yodium" value="ya" {{$bumils->kapsul_yodium == '1' ? 'checked' : ''}}>
                          telah diberi
                          <i class="input-helper"></i></label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-7 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Imunisasi TT</h4>
                      <br>
                      <div class="card">
                        <div class="card-body">

                          <h4 class="card-title">Pemberian imunisasi TT</h4>

                          <div class="row">
                            <div class="col-sm-12">
                              <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="imunisasiTT()">+</button>

                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <table class="table table-hover table-sm table-bordered" id="imunisasi_tt">
                              @php
                              $i = 1;
                              @endphp
                              @foreach($dt_bumil_tt as $d)
                              @php
                              $randNumber = rand(10, 100);
                              @endphp
                              <tr class="imunisasi_tt imunisasi_tt_{{$randNumber}}">
                                <td style="width: 10px;">
                                  <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_imunisasi_tt('{{$randNumber}}')">
                                    <i class="mdi mdi-delete-forever"></i>
                                  </button>
                                </td>
                                <td class="title_imunisasi_tt">
                                  <div class="input-group">
                                    <div class="input-group-append">
                                      <button type="button" class="btn btn-sm btn-light">Imunisasi -</button>
                                    </div>
                                    <input type="text" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="Imunisasi Ke " name="status_imunisasi_tt[{{$randNumber}}]" max="3" min="1" value="{{$d->status}}" required></input>
                                  </div>
                                </td>
                                <td>
                                  <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3" name="imunisasi_tt[{{$randNumber}}]" required value="{{$d->tanggal}}"></input>
                                </td>
                              </tr>
                              @php
                              $i++;
                              @endphp
                              @endforeach
                            </table>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-3">
                  <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(1)">Kembali</button>
                </div>
                <div class="form-group col-md-3">
                  <button type="button" class="btn btn-sm btn-primary selanjutnya_2" style="width: 100%;" onclick="next(2)">Selanjutnya</button>
                </div>
              </div>
            </div>

            <!-- ===========PART 3============ -->

            <div id="part_3" hidden="true">
              <div class="form-row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Hasil Penimbangan</h4>
                      <br>
                      <div class="card">
                        <div class="card-body">

                          <h4 class="card-title">Bulan</h4>

                          <div class="row">
                            <div class="col-sm-12">
                              <button type="button" class="btn btn-light btn-sm" style="width: 100%; background-color: #F3F3F3" onclick="" data-toggle="modal" data-target="#modalPenimbangan">+ Tambah Bulan</button>

                            </div>
                          </div>
                          <br>
                          <div class="row" style="overflow-x: scroll;">

                            @php
                            $i = 1;
                            @endphp

                            <table class="table table-hover table-sm table-bordered" id="bulan_timbang" style="min-width: 400px;">

                              @foreach($dt_bumil_timbang as $d)
                              @php
                              $arrBulan = rand(10, 100);
                              @endphp

                              <tr class="bulan_timbang bulan_timbang_{{$arrBulan}}">
                                <td style="width: 10px;">
                                  <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_bulan_timbang('{{$arrBulan}}')">
                                    <i class="mdi mdi-delete-forever"></i>
                                  </button>
                                </td>
                                <td style="width: 20%;">
                                  <div class="input-group">
                                    <div class="input-group-append">
                                      <button type="button" class="btn btn-sm btn-light">Bulan ke</button>
                                    </div>
                                    <input type="number" name="bulan_ke[{{$arrBulan}}]" max="60" min="1" value="{{$d->bulan_ke}}" required style="background-color: #F3F3F3" class="form-control form-control-sm"></input>
                                  </div>
                                </td>
                                <td>{{$d->bulan}}</td>
                                <td>
                                  <div class="input-group-append">
                                    <button type="button" class="btn btn-sm btn-light">BB</button>
                                    <input type="hidden" name="bulan_timbang[{{$arrBulan}}]" value="{{$d->bulan}}">
                                    <input type="text" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="berat badan" name="berat_badan[{{$arrBulan}}]" required value="{{$d->berat_badan}}">
                                    <button type="button" class="btn btn-sm btn-light">kg</button>
                                  </div>
                                </td>
                                <td>
                                  <div class="input-group-append">
                                    <button type="button" class="btn btn-sm btn-light">Tensi</button>
                                    <input type="text" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="tekanan darah" required name="tekanan_darah[{{$arrBulan}}]" value="{{$d->tekanan_darah}}">
                                    <button type="button" class="btn btn-sm btn-light">mmHg</button>
                                  </div>
                                </td>
                                <td style="width: 10%;">
                                  <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3" required name="tanggal_timbang[{{$arrBulan}}]" value="{{$d->tanggal}}">
                                </td>
                              </tr>
                              @php
                              $i++;
                              @endphp
                              @endforeach
                            </table>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Data Persalinan</h4>
                      <br>
                      <div class="row">
                        <div class="form-group col-sm-8">
                          <label class="col-sm-12 col-form-label">Tanggal
                            Persalinan</label>
                          <input style="background-color: #F3F3F3;" type="date" name="tanggal_persalinan" class="form-control form-control-sm" value="{{$bumils->tanggal_persalinan}}">
                        </div>
                        <div class="form-group col-sm-12">
                          <label class="col-sm-12 col-form-label">Ditolong
                            oleh</label>
                          <div class="col-sm-6">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="ditolong_oleh" value="1" {{$bumils->persalinan == '1' ? 'checked': ''}}>
                                Nakes
                                <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="ditolong_oleh" value="2" {{$bumils->persalinan == '2' ? 'checked': ''}}>
                                Dukun
                                <i class="input-helper"></i></label>
                            </div>
                          </div>

                        </div>
                        <div class="form-group col-sm-12">
                          <div class="col-sm-12">
                            <label class="col-sm-12">Resiko</label>
                            <input style="background-color: #F3F3F3;" type="text" name="resiko" class="form-control form-control-sm" value="{{$bumils->resiko}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Menyusui</h4>
                      <br>
                      <div class="form-group col-md-12">
                        <div class="form-group row">
                          <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Tanggal Menyusui</label>
                            <input style="background-color: #F3F3F3;" type="date" name="menyusui" class="form-control form-control-sm" value="{{$bumils->menyusui}}">
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Berhenti Menyusui</label>
                            <input style="background-color: #F3F3F3;" type="date" name="berhenti_menyusui" class="form-control form-control-sm" value="{{$bumils->berhenti_menyusui}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(2)">Kembali</button>
                </div>
                <div class="form-group col-md-3">
                  <button type="button" class="btn btn-sm btn-primary selanjutnya_2" style="width: 100%;" onclick="next(3)">Tambahkan</button>
                </div>
              </div>
            </div>
            <div id="part_4" hidden="true">
              <div class="form-row">

                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Data Bayi</h4>
                      <div class="form-group">
                        <label class="col-sm-12 col-form-label">Nama Bayi</label>
                        <input style="background-color: #F3F3F3;" type="text" name="nama_bayi" class="form-control form-control-sm" value="{{$bumils->nama_bayi}}">
                      </div>

                      <div class="form-row">
                        <div class="card col-sm-6">
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Bayi Hidup</label>
                                <div class="col-sm-12">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="bayi" value="1" {{$bumils->bayi == '1' ? 'checked': ''}}>
                                      < 2000 gr <i class="input-helper"></i>
                                    </label>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="bayi" value="2" {{$bumils->bayi == '2' ? 'checked': ''}}>
                                      2000-2500 gr
                                      <i class="input-helper"></i></label>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="bayi" value="3" {{$bumils->bayi == '3' ? 'checked': ''}}>
                                      normal
                                      <i class="input-helper"></i></label>
                                  </div>
                                </div>
                                <div class="col-sm-12">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="bayi" value="4" {{$bumils->bayi == '4' ? 'checked': ''}}>
                                      > 4000 gr
                                      <i class="input-helper"></i></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card col-sm-6">
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Bayi Meninggal</label>
                                <input style="background-color: #F3F3F3;" type="date" name="bayi_meninggal" class="form-control form-control-sm" value="{{$bumils->bayi_meninggal}}">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="card-title">Data Ibu</h4>
                      <br>

                      <div class="form-row">
                        <div class="card col-sm-12">
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Ibu Meninggal</label>
                                <input style="background-color: #F3F3F3;" type="date" name="ibu_meninggal" class="form-control form-control-sm" value="{{$bumils->ibu_meninggal}}">
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Keterangan</label>
                                <input style="background-color: #F3F3F3;" type="text" name="keterangan" class="form-control form-control-sm" value="{{$bumils->keterangan}}">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <button type="button" class="btn btn-sm btn-danger" style="width: 100%;" onclick="back(3)">Kembali</button>
                </div>
                <div class="form-group col-md-3">
                  <button type="submit" class="btn btn-sm btn-success selanjutnya_2" style="width: 100%;">Tambahkan</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalPenimbangan" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content" style="background-color: #081F3E;">
      <div class="modal-header">
        <p class="modal-title" id="modalConfirmTitle" style="color: white;">Tambah data?</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container-fluid" style="background-color: white;">
        <div class="row">
          <div class="col-sm-12 mt-2">
            @php
            $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            @endphp

            <select name="bulan" class="form-control selectpicker" data-live-search="true">
              <option value="">- pilih Bulan Penimbangan -</option>
              @foreach ($namaBulan as $n)
              <option value="{{ $n }}">{{ $n }}</option>
              @endforeach
            </select>



          </div>
          <div class="col-sm-6 mt-4">
            <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
          </div>
          <div class="col-sm-6  mt-4">
            <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="bulanTimbang()">Ya</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script>
  jQuery(document).ready(function($) {
    // $('.selectpicker').selectpicker();

    $('#formData').validate({
      rules: {
        nik: {
          required: true,
          minlength: 16,
          maxlength: 16
        },
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

    $('#formData').on('submit', function(e) {
      e.preventDefault();
      $('button[type=submit]').prop('disabled', true);

      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(m) {
          if (m == 'success') {
            Toast.fire({
              icon: 'success',
              title: 'Berhasil Disimpan'
            });
            setTimeout(function() {
              window.location.href = "{{url('/bumil')}}";
            }, 950);
          } else {
            ToastError.fire({
              icon: 'error',
              title: 'Gagal Disimpan',
            });

            console.log(m)
          }
        }
      });


    });

    $('input[name=hamil_ke], input[name=lila], input[name=umur_kelahiran]').on('keyup', function() {
      $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
    });

    $('input[name=nama_ibu], input[name=tempat_lahir], input[name=nama_suami], input[name=alamat], input[name=alamat_domisili], input[name=kecamatan], input[name=kebupaten], input[name=kota]').on('keyup', function() {

      capital = $(this).val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
        return letter.toUpperCase();
      });

      $(this).val(capital);

    });

  });

  function next(i) {

    if (i == 1) {

      if ($('select[name=pasien_id]').val() != '') {

        if ($('#formData').valid()) {

          $('#part_1').attr('hidden', true);

          $('#part_2').attr('hidden', false).show('slow');
        }

        $('#pasien_id_required').attr('hidden', true).hide('slow');

      } else {
        $('#pasien_id_required').attr('hidden', false).show('slow');
      }

    }

    if (i == 2) {
      if ($('#formData').valid()) {
        $('#part_2').hide('slow', function() {
          $(this).attr('hidden', true);
        });

        $('#part_3').attr('hidden', false).show('slow');
      }

    }


    if (i == 3) {

      if ($('#formData').valid()) {
        $('#part_3').hide('slow', function() {
          $(this).attr('hidden', true);
        });

        $('#part_4').attr('hidden', false).show('slow');
      }
    }

  }


  function back(i) {

    if (i == 1) {

      $('#part_2').hide('slow', function() {
        $(this).attr('hidden', true);
      });

      $('#part_1').attr('hidden', false).show('slow');

    }

    if (i == 2) {

      $('#part_3').hide('slow', function() {
        $(this).attr('hidden', true);
      });

      $('#part_2').attr('hidden', false).show('slow');

    }

    if (i == 3) {

      $('#part_4').hide('slow', function() {
        $(this).attr('hidden', true);
      });

      $('#part_3').attr('hidden', false).show('slow');

    }

  }


  function tablet_tambah_darah() {

    let randData = Math.floor(Math.random() * 10);

    var tmbLength = $('.tmb_darah').length;

    if (tmbLength < 3) {
      var val = `
                  <tr class="tmb_darah tmb_darah_` + randData + `">
                  <td style="width: 10px;">
                  <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_tablet(` + randData + `)">
                  <i class="mdi mdi-delete-forever"></i>
                  </button>
                  </td>

                  <td class="title_tmb_darah">
                  <div class="input-group">
                  <div class="input-group-append">
                  <button type="button" class="btn btn-sm btn-light">Tablet ke -</button>
                  </div>
                  <input type="number" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="tablet ke " name="status_tambah_darah[` + randData + `]" max="3" min="1" value="` + (tmbLength + 1) + `" required></input>
                  </div>
                  </td>
                  <td>
                  <input type="date" class="form-control form-control-sm"  style="background-color: #F3F3F3" name="tanggal_tambah_darah[` + randData + `]" required></input>
                  </td>
                  </tr>`;

      $('#tablet_tambah_darah').append(val);

    }

  }


  function delete_tablet(i) {

    $('.tmb_darah_' + i).remove();

  }


  function imunisasiTT() {

    let randData = Math.floor(Math.random() * 10);

    var tmbLength = $('.imunisasi_tt').length;

    if (tmbLength < 5) {
      var val = `<tr class="imunisasi_tt imunisasi_tt_` + randData + `">
                  <td style="width: 10px;">
                  <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_imunisasi_tt(` + randData + `)">
                  <i class="mdi mdi-delete-forever"></i>
                  </button>
                  </td>
                  <td class="title_imunisasi_tt" >
                  <div class="input-group">
                  <div class="input-group-append">
                  <button type="button" class="btn btn-sm btn-light">Imunisasi -</button>
                  </div>
                  <input type="text" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="Imunisasi Ke " name="status_imunisasi_tt[` + randData + `]" max="3" min="1" value="` + (tmbLength + 1) + `" required></input>
                  </div>
                  </td>
                  <td>
                  <input type="date" style="background-color: #F3F3F3" class="form-control form-control-sm" name="imunisasi_tt[` + randData + `]" required></input>
                  </td>
                  </tr>`;

      $('#imunisasi_tt').append(val);

    }

  }


  function delete_imunisasi_tt(i) {

    $('.imunisasi_tt_' + i).remove();

  }


  function bulanTimbang() {

    var bulan = $('select[name=bulan]').val();

    let arrBulan = $('.bulan_timbang').length;

    if ($('select[name=bulan]').val() != '') {

      $('#bulan_timbang').append(`
      <tr class="bulan_timbang bulan_timbang_` + arrBulan + `">
                <td style="width: 10px;">
                <button type="button" class="btn btn-sm" style="font-size: 2px;" onclick="delete_bulan_timbang(` + arrBulan + `)">
                <i class="mdi mdi-delete-forever"></i>
                </button>
                </td>
                <td style="width: 20%;">
                <div class="input-group">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">Bulan ke </button>
                </div>
                <input type="number" name="bulan_ke[` + arrBulan + `]" max="60" min="1" value="` + (arrBulan + 1) + `" required style="background-color: #F3F3F3" class="form-control form-control-sm"></input>
                </div> 
                </td>
                <td>` + bulan + `</td>
                <td>
                <input type="hidden" name="bulan_timbang[` + arrBulan + `]" value="` + bulan + `">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">BB</button>
                <input type="text" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="berat badan" name="berat_badan[` + arrBulan + `]" required>
                    <button type="button" class="btn btn-sm btn-light">kg</button>
                </div>
                </td>
                <td>
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-light">Tensi</button>
                <input type="text" class="form-control-sm form-control" style="background-color: #F3F3F3" placeholder="tekanan darah" required name="tekanan_darah[` + arrBulan + `]">
                    <button type="button" class="btn btn-sm btn-light">mmHg</button>
                </div>
                
                </td>
                <td style="width: 10%;">
                <input type="date" class="form-control-sm form-control" style="background-color: #F3F3F3" required name="tanggal_timbang[` + arrBulan + `]">
                </td>
                </tr>
                    `);


      $('#modalPenimbangan').modal('hide');
      $('select[name=bulan]').prop('selectedIndex', -1);
    }

  }


  function delete_bulan_timbang(i) {

    $('.bulan_timbang_' + i).remove();

  }
</script>
@endpush
