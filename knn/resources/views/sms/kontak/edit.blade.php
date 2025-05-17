@extends('layouts.master')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">

            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>Edit Kontak Baru</h2>
                        <p class="mb-md-0">Sistem Informasi Posyandu Kemuning Lor.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">SMS Gateway</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <div>
                        <a href="{{url('/sms/kontak')}}" class="btn btn-primary mr-3 mt-2 mt-xl-0">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('sms/edit/kontak')}}" method="post" id="form-no-hp">
                        @csrf
                        <input type="hidden" name="id" value="{{isset($kontak->id)? $kontak->id : ''}}">
                        <div class="form-row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <button type="button" class="btn btn btn-secondary btn-change-name" id="manual">Pilih Nama</button>
                                            </div>
                                        </div>
                                        <div class="form-row fr-1">
                                            <div class="form-group col-md-12 select-name" hidden="true">
                                                <label>Nama Ibu Hamil<span style="color: red;">*</span></label>
                                                <select name="bumil" class="form-control form-control-sm select2" required>
                                                    <option value="0">Pilih Ibu Hamil</option>
                                                    @foreach($data['bumil'] as $bumil)
                                                    <option value="{{$bumil->id}}">{{$bumil->nama_ibu}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group col-md-12 manual-name">
                                                <label>Nama Ibu Hamil<span style="color: red;">*</span></label>
                                                <input style="background-color: #F3F3F3;" type="text" name="nama_bumil" class="form-control form-control-sm" value="{{isset($kontak->nama)? $kontak->nama : ''}}">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label>Nomor Handphone<span style="color: red;">*</span></label>
                                                <input style="background-color: #F3F3F3;" type="text" name="no_hp" class="form-control form-control-sm" required value="{{isset($kontak->no_hp)? $kontak->no_hp : ''}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Posyandu<span style="color: red;">*</span></label>
                                            <select name="posyandu" class="form-control" required>
                                                @foreach($posyandu as $pos)
                                                @if($kontak->posyandu_id == $pos->id)
                                                <option value="{{$pos->id}}" selected>{{$pos->nama}}</option>
                                                @else
                                                <option value="{{$pos->id}}">{{$pos->nama}}</option>
                                                @endif
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                            </div>
                                        </div>
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
<div class="modal fade" id="modalalkon" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" style="background-color: #081F3E;">
            <div class="modal-header">
                <p class="modal-title" id="modalConfirmTitle" style="color: white;">Edit data alkon</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container-fluid" style="background-color: white;">
                <div class="row">
                    <div class="col-sm-12 mt-2">
                        <select name="selectalkon" class="form-control selectpicker" data-live-search="true">
                            <option value="">- Pilih Jenis Alkon -</option>

                        </select>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 100%;"> Batal</button>
                    </div>
                    <div class="col-sm-6  mt-4">
                        <button class="btn btn-success btn-sm" id="modalConfirmYes" style="width: 100%;" onclick="addalkon('add')">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/js/moment.js')}}"></script>
<script>
    $('.select2').select2();

    function trigSelect() {
        $('.select2').select2();
    }

    $('.btn-change-name').on('click', function() {
        if ($(this).attr('id') == 'automatic') {
            $('.manual-name').show('slow').attr('hidden', false);
            $('.select-name').hide('slow').attr('hidden', true);
            $('select[name=bumil] option:first').prop('selected', true).trigger('change');
            $('input[name=nama_bumil]').val('');
            $(this).attr('id', 'manual');
            $(this).text('Pilih Nama');
            $(this).removeClass('btn-secondary');
            $(this).addClass('btn-dark');
        } else {
            $('.manual-name').hide('slow').attr('hidden', true);
            $('.select-name').show('slow').attr('hidden', false);
            $(this).attr('id', 'automatic');
            $(this).text('Tulis Nama');
            $(this).removeClass('btn-dark');
            $(this).addClass('btn-secondary');
            $('select[name=bumil] option:first').prop('selected', true).trigger('change');
            $('input[name=nama_bumil]').val('');
        }

        trigSelect();
    })
    $('input[name=no_hp]').keyup(function(e) {
        if (/\D/g.test(this.value)) {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });

    $('#form-no-hp').on('submit', (e) => {
        if ($('select[name=bumil]').val() == 0 && $('select[name=bumil]').is(':visible')) {
            e.preventDefault();
        }
    })
</script>

@endpush