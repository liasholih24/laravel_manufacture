@extends('backLayout.app')

@section('title')
    Pembelian
@stop

@section('desc')
    Tambah Pembelian
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
                        <h5>Tambah Pembelian</h5>
                        <a href="{{ url('penerimaan') }}" class="btn btn-sm btn-outline btn-primary pull-right" style="margin-top: -7px">
                            <i class="fa fa-arrow-circle-o-left"></i> Kembali
                        </a>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ url('penerimaan') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nomor</label>
                                <div class="col-sm-3">
                                    <input type="text" name="number" class="form-control input-sm" placeholder="Nomor">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Lokasi</label>
                                <div class="col-sm-3">
                                    <select name="storage_id" class="select-lokasi form-control input-sm" required>
                                        <option value=""></option>
                                        @foreach($lokasi as $r)
                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Pengajuan</label>
                                <div class="col-sm-3">
                                    <select name="pengajuan_id" class="select-pengajuan form-control input-sm" onchange="changePengajuan()">
                                        <option value=""></option>
                                        @foreach($pengajuan as $r)
                                        <option value="{{ $r->id }}">{{ $r->number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-3">
                                    <input id="tanggal" type="text" name="date" class="form-control input-sm" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-8">
                                    <textarea name="desc" class="form-control input-sm" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Rincian</label>
                                <div class="col-sm-10">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th width="12%">Pemasok</th>
                                                <th width="12%">Qty</th>
                                                <th width="12%">Ball</th>
                                                <th width="12%">Satuan</th>
                                                <th width="20%">Harga</th>
                                                <th width="50px">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <tr id="tr0">
                                                <td>
                                                    <select name="item_id[]" class="select-item form-control input-sm" required>
                                                        <option value=""></option>
                                                        @foreach($item as $r)
                                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="supplier_id[]" class="select-supplier form-control input-sm">
                                                        <option value=""></option>
                                                        @foreach($supplier as $r)
                                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="qty[]" class="form-control input-sm" autocomplete="off" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="ball[]" class="form-control input-sm" autocomplete="off" required>
                                                </td>
                                                <td>
                                                    <select name="satuan_id[]" class="select-satuan form-control input-sm" required>
                                                        <option value=""></option>
                                                        @foreach($satuan as $r)
                                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="price[]" class="form-control input-sm" autocomplete="off" required>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger" onclick="hapusBaris(0)"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">
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
                                    <button class="btn btn-outline btn-primary" type="submit"><i class="fa fa-plus-circle"></i> Simpan</button>
                                    <a href="{{ url('penerimaan') }}" class="btn btn-outline btn-danger"><i class="fa fa-times-circle"></i> Batal</a>
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
              format :  'yyyy-mm-dd',
              todayBtn: 'linked',
              todayHighlight :  true,
        });
        $('.select-item').select2({
            placeholder: 'Pilih Item'
        });
        $('.select-lokasi').select2({
            placeholder: 'Pilih Lokasi'
        });
        $('.select-pengajuan').select2({
            placeholder: 'Pilih Pengajuan',
            allowClear: true
        });
        $('.select-supplier').select2({
            placeholder: 'Pilih Pemasok',
            allowClear: true
        });
        $('.select-satuan').select2({
            placeholder: 'Pilih Satuan'
        });
        var nomor = 1;
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
                    '<select name="supplier_id[]" class="form-control input-sm select-supplier">' +
                        '<option value=""></option>' +
                        @foreach($supplier as $r)
                        '<option value="{{ $r->id }}">{{ $r->name }}</option>' +
                        @endforeach
                    '</select>' +
                '</td>' +
                '<td>' +
                    '<input type="text" name="qty[]" class="form-control input-sm" autocomplete="off" required>' +
                '</td>' +
                '<td>' +
                    '<input type="text" name="ball[]" class="form-control input-sm" autocomplete="off" required>' +
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
                    '<input type="text" name="price[]" class="form-control input-sm" autocomplete="off" required>' +
                '</td>' +
                '<td>' +
                    '<button class="btn btn-sm btn-danger" onclick="hapusBaris(' + nomor + ')"><i class="fa fa-trash"></i></button>' +
                '</td>' +
            '</tr>');
            $('.select-item').select2({
                placeholder: 'Pilih Item'
            });
            $('.select-supplier').select2({
                placeholder: 'Pilih Pemasok',
                allowClear: true
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
        function changePengajuan() {
            var param = $('select[name="pengajuan_id"]').val();
            $.get("pengajuan/" + param, function(data, status){
                $('#tbody').empty();
                if (data.length == 0) {
                    $('#tambah-baris').prop('disabled', false);
                }
                else {
                    for (i=0; i<data.length; i++) {
                        $('#tbody').append('<tr id="tr' + i + '">' +
                            '<td>' +
                                '<select name="item_id[]" class="form-control input-sm select-item" readonly required>' +
                                    '<option value="' + data[i].id + '" selected>' + data[i].name + '</option>' +
                                '</select>' +
                            '</td>' +
                            '<td>' +
                                '<select name="supplier_id[]" class="form-control input-sm select-supplier">' +
                                    '<option value=""></option>' +
                                    @foreach($supplier as $r)
                                    '<option value="{{ $r->id }}">{{ $r->name }}</option>' +
                                    @endforeach
                                '</select>' +
                            '</td>' +
                            '<td>' +
                                '<input type="text" name="qty[]" class="form-control input-sm" autocomplete="off" value="' + data[i].qty + '" required>' +
                            '</td>' +
                            '<td>' +
                                '<input type="text" name="ball[]" class="form-control input-sm" autocomplete="off" value="" required>' +
                            '</td>' +
                            '<td>' +
                                '<select name="satuan_id[]" class="form-control input-sm select-satuan" required>' +
                                    '<option value="' + data[i].satuan_id + '" selected>' + data[i].satuan + '</option>' +
                                '</select>' +
                            '</td>' +
                            '<td>' +
                                '<input type="text" name="price[]" class="form-control input-sm" autocomplete="off" required>' +
                            '</td>' +
                            '<td>' +
                                '<button class="btn btn-sm btn-danger" onclick="hapusBaris(' + i + ')" disabled><i class="fa fa-trash"></i></button>' +
                            '</td>' +
                        '</tr>');
                        $('.select-item').select2({
                            placeholder: 'Pilih Item',
                            readonly: true
                        });
                        $('.select-supplier').select2({
                            placeholder: 'Pilih Pemasok',
                            allowClear: true
                        });
                    }
                    $('#tambah-baris').prop('disabled', true);
                }
            });
            return false;
        }
    </script>
@endsection
