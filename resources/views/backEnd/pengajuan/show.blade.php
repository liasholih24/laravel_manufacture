@extends('backLayout.app')

@section('title')
    Pengajuan
@stop

@section('desc')
    Verifikasi Pengajuan
@stop

@section('style')
    {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
    {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
    {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
    {{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
    <style>
        .select2-container .select2-selection--single {
            height: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Verifikasi Pengajuan</h5>
                        <a href="{{ url('pengajuan') }}" class="btn btn-sm btn-outline btn-primary pull-right" style="margin-top: -7px">
                            <i class="fa fa-arrow-circle-o-left"></i> Kembali
                        </a>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ url('pengajuan/'.$pengajuan->id.'/verifikasi') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nomor</label>
                                <div class="col-sm-3">
                                    <input type="text" name="number" class="form-control input-sm" value="{{ $pengajuan->number }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Lokasi</label>
                                <div class="col-sm-3">
                                    <select name="storage_id" class="select-lokasi form-control input-sm" disabled>
                                        <option value=""></option>
                                        @foreach($lokasi as $r)
                                        <option value="{{ $r->id }}" @if($r->id==$pengajuan->storage_id) selected @endif>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-3">
                                    <input id="tanggal" type="text" name="date" class="form-control input-sm" value="{{ date('Y-m-d', strtotime($pengajuan->date)) }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-8">
                                    <textarea name="desc" class="form-control input-sm" rows="3" disabled>{{ $pengajuan->desc }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Rincian</label>
                                <div class="col-sm-10">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th width="20%">Qty</th>
                                                <th width="20%">Satuan</th>
                                                <th width="50px">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <?php $i = 0; ?>
                                            @foreach($detail as $d)
                                            <tr id="tr{{$i}}">
                                                <td>
                                                    <select name="item_id[]" onchange="pilihItem({{$i}})" class="select-item form-control input-sm" disabled>
                                                        <option value=""></option>
                                                        @foreach($item as $r)
                                                        <option value="{{ $r->id }}" @if($d->item_id==$r->id) selected @endif>{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="item_id[]" value="{{ $d->item_id }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="qty[]" class="form-control input-sm" value="{{ $d->qty }}" autocomplete="off" required>
                                                </td>
                                                <td>
                                                    <select name="satuan_id[]" class="select-satuan form-control input-sm" disabled>
                                                        <option value=""></option>
                                                        @foreach($satuan as $r)
                                                        <option value="{{ $r->id }}" @if($d->satuan_id==$r->id) selected @endif>{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="satuan_id[]" value="{{ $d->satuan_id }}">
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger" onclick="hapusBaris({{$i}})"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php $i++ ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-outline btn-primary" type="submit"><i class="fa fa-check-circle"></i> Verifikasi</button>
                                    <a href="{{ url('pengajuan') }}" class="btn btn-outline btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
    {{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
    {{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}
    {{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}
    <script>
        $(document).ready(function () {
            
        });
        $("#tanggal").datepicker({
            startDate : '-0m',
            format :  'yyyy-mm-dd',
            keyboardNavigation : false,
            forceParce: false,
            todayBtn: 'linked',
            todayHighlight :  true,
            daysOfWeekDisabled : [0],
        });
        $('.select-item').select2({
            placeholder: 'Pilih Item'
        });
        $('.select-lokasi').select2({
            placeholder: 'Pilih Lokasi'
        });
        $('.select-satuan').select2({
            placeholder: 'Pilih Satuan'
        });
        var nomor = {{$i}};
        $('#tambah-baris').on('click', function() { 
            $('#tbody').append('<tr id="tr' + nomor + '">' +
                '<td>' +
                    '<select name="item_id[]" onchange="pilihItem(' + nomor + ')" class="form-control input-sm select-item" required>' +
                        '<option value=""></option>' +
                        @foreach($item as $r)
                        '<option value="{{ $r->id }}">{{ $r->name }}</option>' +
                        @endforeach
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<input type="number" name="qty[]" class="form-control input-sm" autocomplete="off" required>' +
                '</td>' +
                '<td>' +
                    '<select name="satuan_id[]" class="form-control input-sm select-satuan" required>' +
                        '<option value=""></option>' +
                        @foreach($satuan as $r)
                        '<option value="{{ $r->id }}">{{ $r->name }}</option>' +
                        @endforeach
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<button class="btn btn-sm btn-danger" onclick="hapusBaris(' + nomor + ')"><i class="fa fa-trash"></i></button>' +
                '</td>' +
            '</tr>');
            $('.select-item').select2({
                placeholder: 'Pilih Item'
            });
            $('.select-satuan').select2({
                placeholder: 'Pilih Satuan'
            });
            nomor++;
            return false;
        });
        function pilihItem(baris) {
            var param = $('#tr' + baris + ' select[name="item_id[]"]').val();
            $.get("/pengajuan/item/" + param, function(data, status){
                $('#tr' + baris + ' input[name="qty[]"]').prop('min', data.minstock);
                $('#tr' + baris + ' input[name="qty[]"]').prop('max', data.maxstock);
            });
        }
        function hapusBaris(baris) {
            $('#tr' + baris).remove();
            return false;
        }
    </script>
@endsection
