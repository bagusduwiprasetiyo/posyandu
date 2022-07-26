@extends('layouts.master')
@section('content')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Laporan Hasil Kegiatan</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Laporan</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <!-- <a href="{{url('/puswus/create')}}" class="btn btn-light bg-white mr-3 mt-2 mt-xl-0">
                            Tambah Pus/Wus
                        </a> -->
                        <!-- <button class="btn btn-primary mt-2 mt-xl-0">Download report</button> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="overflow-x: scroll;">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <?php
                            if (session()->has('kader')) {
                                $list_posyandu = DB::select(DB::raw("select * from list_posyandu where id = " . session()->get('kader')->posyandu_id));
                            } else {
                                $list_posyandu = DB::table('list_posyandu')->get();
                            }
                            ?>
                            <div class="form-row">
                                <div class="form-group col-sm-3">
                                    <h6 class="mt-3">Tampilkan Data Posyandu Dari : </h6>
                                    <select id="posyandu_id" name="posyandu_id" class="form-control selectpicker mt-3" data-show-subtext="true" data-live-search="true" required>
                                        @if($id_posyandu != 0)
                                        <option value="0">-- Semua Posyandu --</option>
                                        @foreach($list_posyandu as $lp)
                                        @if($id_posyandu == $lp->id)
                                        <option value="{{$lp->id}}" selected>{{$lp->nama}}</option>
                                        @else
                                        <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                        <option value="0" selected>-- Semua Posyandu --</option>
                                        @foreach($list_posyandu as $lp)
                                        <option value="{{$lp->id}}">{{$lp->nama}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <h6 class="mt-3">Tampilkan Data Tahun : </h6>

                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" id="dateyear" class="form-control form-control-sm" style="background-color: #F3F3F3;" placeholder="Pilih Tahun" value="{{$tahun}}">

                                </div>
                                <div class="offset-sm-10 mt-3">
                                    <button id="cetak" class="btn btn-primary"><i class="mdi mdi-printer menu-icon"></i> Cetak Laporan</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <form action="#" style="overflow-x: scroll; ">
                        @csrf
                        <table class="" style="font-size: 8pt; text-align: center; margin-right: 50px;" border="1" cellpadding="8">
                            <thead>
                                <tr>

                                    <th rowspan="3">NO</th>
                                    <th rowspan="3">BULAN</th>
                                    <th rowspan="3" style="writing-mode: vertical-lr; transform: scale(-1);">JML IBU HAMIL</th>
                                    <th rowspan="3" style="writing-mode: vertical-lr; transform: scale(-1);">DIPERIKSA</th>
                                    <th rowspan="3" style="writing-mode: vertical-lr; transform: scale(-1);">FE TAB(TABLET BESI)</th>
                                    <th rowspan="3" style="writing-mode: vertical-lr; transform: scale(-1);">JML IBU MENYUSUI</th>
                                    <th rowspan="2" colspan="2">
                                        IMUNISASI
                                        <br>
                                        TT IBU
                                        <br>
                                        HAMIL
                                    </th>
                                    <th colspan="8">
                                        JML ASEPTOR KB
                                    </th>
                                    <th colspan="12">
                                        PENIMBANGAN BALITA
                                    </th>
                                    <th colspan="10">
                                        JUMLAH BAYI YANG DIIMUNISASI
                                    </th>
                                    <th colspan="4">
                                        BAYI YANG
                                        <br>
                                        MENDERITA DIARE
                                    </th>
                                    <th rowspan="3">
                                        KETERANGAN
                                    </th>
                                </tr>
                                <tr>

                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">KONDOM</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">PIL</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">IMPLANT</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">MOP</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">MOW</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">UID</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">SUNTIK</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">LAIN-LAIN</th>
                                    <th colspan="2">
                                        JML
                                        <br>
                                        BALITA
                                        <br>
                                        (S)
                                    </th>
                                    <th colspan="2">
                                        JML
                                        <br>
                                        BALITA YG
                                        <br>
                                        MEMILIKI
                                        <br>
                                        KMS (K)
                                    </th>
                                    <th colspan="2">
                                        DITIMBANG
                                        <br>
                                        (D)
                                    </th>
                                    <th colspan="2">
                                        JML YG
                                        <br>
                                        NAIK (N)
                                    </th>
                                    <th colspan="2">
                                        JML YG
                                        <br>
                                        MENDAPAT
                                        <br>
                                        VIT A
                                    </th>
                                    <th colspan="2">
                                        JML YG
                                        <br>
                                        MENDAPAT
                                        <br>
                                        PMT
                                    </th>
                                    <th style="writing-mode: vertical-lr; transform: scale(-1);" rowspan="2">
                                        HB-0
                                    </th>
                                    <th style="writing-mode: vertical-lr; transform: scale(-1);" rowspan="2">
                                        BCG
                                    </th>
                                    <th colspan="3">DPT</th>
                                    <th colspan="4">POLIO</th>
                                    <th rowspan="2" style="writing-mode: vertical-lr; transform: scale(-1);">CAMPAK</th>
                                    <th colspan="2">JUMLAH</th>
                                    <th colspan="2">
                                        YANG
                                        <br>
                                        MENDAPAT
                                        <br>
                                        ORALIT
                                    </th>
                                </tr>
                                <tr>
                                    <th>I</th>
                                    <th>II</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>I</th>
                                    <th>II</th>
                                    <th>III</th>
                                    <th>I</th>
                                    <th>II</th>
                                    <th>III</th>
                                    <th>IV</th>
                                    <th>L</th>
                                    <th>P</th>
                                    <th>L</th>
                                    <th>P</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_laporan as $key => $lp)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$nama_bulan[$key]}}</td>
                                    <td>{{$lp['jml_bumil']}}</td>
                                    <td>{{$lp['bumil_timbang']}}</td>
                                    <td>{{$lp['bumil_td']}}</td>
                                    <td>{{$lp['bumil_menyusui']}}</td>
                                    <td>{{$lp['bumil_tt_1']}}</td>
                                    <td>{{$lp['bumil_tt_2']}}</td>
                                    <td>{{$lp['alkon']['Kondom']}}</td>
                                    <td>{{$lp['alkon']['Pil']}}</td>
                                    <td>{{$lp['alkon']['Implant']}}</td>
                                    <td>{{$lp['alkon']['MOP']}}</td>
                                    <td>{{$lp['alkon']['MOW']}}</td>
                                    <td>{{$lp['alkon']['UID']}}</td>
                                    <td>{{$lp['alkon']['Suntik']}}</td>
                                    <td>{{$lp['alkon']['Lain-lain']}}</td>
                                    <td>{{$lp['bayi_s']['l']}}</td>
                                    <td>{{$lp['bayi_s']['p']}}</td>
                                    <td>{{$lp['bayi_k']['l']}}</td>
                                    <td>{{$lp['bayi_k']['p']}}</td>
                                    <td>{{$lp['bayi_timbang']['l']}}</td>
                                    <td>{{$lp['bayi_timbang']['p']}}</td>
                                    <td>{{$lp['bayi_naik']['l']}}</td>
                                    <td>{{$lp['bayi_naik']['p']}}</td>
                                    <td>{{$lp['bayi_vit_a']['l']}}</td>
                                    <td>{{$lp['bayi_vit_a']['p']}}</td>
                                    <td>{{$lp['bayi_pmt']['l']}}</td>
                                    <td>{{$lp['bayi_pmt']['p']}}</td>
                                    <td>{{$lp['bayi_imun']['hbo']['l']}}/{{$lp['bayi_imun']['hbo']['p']}}</td>
                                    <td>{{$lp['bayi_imun']['bcg']['l']}}/{{$lp['bayi_imun']['bcg']['p']}}</td>

                                    <td>{{$lp['bayi_imun']['dpt']['i']['l']}}/{{$lp['bayi_imun']['dpt']['i']['p']}}</td>
                                    <td>{{$lp['bayi_imun']['dpt']['ii']['l']}}/{{$lp['bayi_imun']['dpt']['ii']['p']}}</td>
                                    <td>{{$lp['bayi_imun']['dpt']['iii']['l']}}/{{$lp['bayi_imun']['dpt']['iii']['p']}}</td>

                                    <td>{{$lp['bayi_imun']['polio']['i']['l']}}/{{$lp['bayi_imun']['polio']['i']['p']}}</td>
                                    <td>{{$lp['bayi_imun']['polio']['ii']['l']}}/{{$lp['bayi_imun']['polio']['ii']['p']}}</td>
                                    <td>{{$lp['bayi_imun']['polio']['iii']['l']}}/{{$lp['bayi_imun']['polio']['iii']['p']}}</td>
                                    <td>{{$lp['bayi_imun']['polio']['iiii']['l']}}/{{$lp['bayi_imun']['polio']['iiii']['p']}}</td>

                                    <td>{{$lp['campak']}}</td>
                                    <td>{{$lp['diare']['l']}}</td>
                                    <td>{{$lp['diare']['p']}}</td>
                                    <td>{{$lp['oralit']['l']}}</td>
                                    <td>{{$lp['oralit']['p']}}</td>
                                    <td style="height: 50px; font-size: 7pt; max-height: 50px;">
                                        <input type="hidden" name="posyandu" value="{{$id_posyandu  }}">
                                        <textarea name="keterangan_laporan[{{$lp['bulan']}}]" style="width: 100%; height: 100%;" maxlength="22">{{$lp['keterangan']}}</textarea>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </form>
                    <br>
                    <button class="btn btn-sm btn-success" id="simpan">simpan</button>

                    <br><br><br><br><br><br>
                    <!-- <table id=" tableData" class="table table-hover text-center table-xs">
                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Nama Suami</th>
                                <th>Lila</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Hapus data?</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white; padding: 4px;">
                <div class="row">
                    <div class="col-sm-6">
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="deleteAcc()">Ya</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
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
    })

    $('#simpan').on('click', function() {
        $.post("{{url('laporan/keterangan')}}", $('form').serialize(),
            function(data, textStatus, jqXHR) {
                notif(data.status, data.message, "{{URL::current()}}")
            },
            "JSON"
        );
    })

    $('#dateyear').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    })

    $('#dateyear').on('change', function() {
        window.location.href = "{{url('laporan_kegiatan_posyandu')}}" + '/' + $('#posyandu_id').val() + '/' +
            $(this).val()
    })
    $('#posyandu_id').on('change', function() {
        window.location.href = "{{url('laporan_kegiatan_posyandu')}}" + '/' + $(this).val() + '/' +
            $('#dateyear').val()
    })

    $('#cetak').on('click', function() {
        // var newWin = window.open('', 'Print-Window');
        // newWin.document.open();
        // newWin.document.write(
        //     `<html><body onload="window.print()">${$('form').html()}</html>`
        // )
        // newWin.document.close()
        // setTimeout(() => {
        //     newWin.close()
        // }, 1000);
        window.open("{{url('print/hasil_kegiatan/'.$id_posyandu.'/'.$tahun)}}")
    })
</script>
@endpush

@push('css')
<style>
    .ui-datepicker-calendar {
        display: none;
    }

    .ui-datepicker-month {
        display: none;
    }

    .ui-datepicker-prev {
        display: none;
    }

    .ui-datepicker-next {
        display: none;
    }
</style>
@endpush