@extends('backLayout.app')

@section('title')
    Mutasi
@stop

@section('desc')
    Ubah Mutasi
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
                        <h5>Ubah Mutasi</h5>
                        <a href="{{ url('transfer') }}" class="btn btn-sm btn-outline btn-primary pull-right" style="margin-top: -7px">
                            <i class="fa fa-arrow-circle-o-left"></i> Kembali
                        </a>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ url('transfer/'.$mutasi->id) }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nomor</label>
                                <div class="col-sm-3">
                                    <input type="text" name="number" class="form-control input-sm" value="{{ $mutasi->number }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-3">
                                    <input id="tanggal" type="text" name="date" class="form-control input-sm" value="{{ date('Y-m-d', strtotime($mutasi->date)) }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dari</label>
                                <div class="col-sm-3">
                                    <select name="gdg_from" class="select-storage form-control input-sm" required>
                                        <option value=""></option>
                                        @foreach($storage as $r)
                                        <option value="{{ $r->id }}" @if($r->id==$mutasi->gdg_from) selected @endif>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ke</label>
                                <div class="col-sm-3">
                                    <select name="gdg_to" class="select-storage form-control input-sm" required>
                                        <option value=""></option>
                                        @foreach($storage as $r)
                                        <option value="{{ $r->id }}" @if($r->id==$mutasi->gdg_to) selected @endif>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-8">
                                    <textarea name="keterangan" class="form-control input-sm" rows="3" required>{{ $mutasi->keterangan }}</textarea>
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
                                                    <select name="item_id[]" class="select-item form-control input-sm" required>
                                                        <option value=""></option>
                                                        @foreach($item as $r)
                                                        <option value="{{ $r->id }}" @if($d->item_id==$r->id) selected @endif>{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="qty[]" class="form-control input-sm" value="{{ $d->qty }}" autocomplete="off" required>
                                                </td>
                                                <td>
                                                    <select name="satuan_id[]" class="select-satuan form-control input-sm" required>
                                                        <option value=""></option>
                                                        @foreach($satuan as $r)
                                                        <option value="{{ $r->id }}" @if($d->satuan_id==$r->id) selected @endif>{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger" onclick="hapusBaris({{$i}})"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php $i++ ?>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">
                                                    <button id="tambah-baris" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-outline btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Simpan Perubahan</button>
                                    <a href="{{ url('transfer') }}" class="btn btn-outline btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
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
        $('.select-storage').select2({
            placeholder: 'Pilih Penyimpanan'
        });
        $('.select-satuan').select2({
            placeholder: 'Pilih Satuan'
        });
        var nomor = {{$i}};
        $('#tambah-baris').on('click', function() { 
            $('#tbody').append('<tr id="tr' + nomor + '">' +
                '<td>' +
                    '<select name="item_id[]" class="form-control input-sm select-item" required>' +
                        '<option value=""></option>' +
                        @foreach($item as $r)
                        '<option value="{{ $r->id }}">{{ $r->name }}</option>' +
                        @endforeach
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<input type="text" name="qty[]" class="form-control input-sm" autocomplete="off" required>' +
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
        function hapusBaris(baris) {
            $('#tr' + baris).remove();
            return false;
        }
    </script>
@endsection
