@section('style')
    {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection

@extends('backLayout.app')

@section('title')
    Penjualan
@stop

@section('desc')
    Daftar Penjualan
@stop

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Daftar Penjualan</h5>
                        <a href="#">
                            <button class="btn btn-sm btn-outline btn-primary pull-right" style="margin-top: -7px; margin-left: 5px;" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-print"></i> Cetak Laporan
                            </button>
                        </a>
                        <a href="{{ url('penjualan/create') }}">
                            <button class="btn btn-sm btn-outline btn-success pull-right" style="margin-top: -7px">
                                <i class="fa fa-plus-circle"></i> Tambah Penjualan
                            </button>
                        </a>
                    </div>
                    <div class="ibox-content">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <div class="alert alert-{{ $msg }} alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ Session::get('alert-' . $msg) }}.
                        </div>
                        @endif
                        @endforeach
                        @if(!empty($penjualan[0]))
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tblpenjualan">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Farm</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Customer</th>
                                        <th>Dibuat oleh</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($penjualan as $r)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $r->number }}</td>
                                        <td>{{ empty($r->getlokasi->name) ? "Not Set" : $r->getlokasi->name }}</td>
                                        <td>{{ date('d/m/Y', strtotime($r->date)) }}</td>
                                        <td>{{ $r->desc }}</td>
                                        <td>{{ empty($r->getcustomer->name) ? "" : $r->getcustomer->name }}</td>
                                        <td>{{ empty($r->createdby->first_name) ? "" : $r->createdby->first_name }} {{ empty($r->createdby->last_name) ? "" : $r->createdby->last_name }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('penjualan/' . $r->id . '/edit') }}" class="btn btn-outline btn-warning btn-xs">Ubah</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="jumbotron">
                            <h1>Data Kosong ... </h1>
                            <p>Mohon maaf, tidak ada data penjualan untuk bulan ini.</p>
                            <p><a href="{{ url('penjualan/create') }}" class="btn btn-primary btn-lg" role="button">Tambah Penjualan</a></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-print modal-icon"></i>
                    <h4 class="modal-title">Cetak Laporan Penjualan</h4>
                </div>
                <form action="{{ url('penjualan/cetak/laporan') }}" method="GET" class="form-horizontal" target="_blank">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Lokasi</label>
                            <div class="col-sm-7">
                                <select name="storage_id" class="form-control input-sm" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach($lokasi as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dari</label>
                            <div class="col-sm-7">
                                <input type="date" name="from_date" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Sampai</label>
                            <div class="col-sm-7">
                                <input type="date" name="to_date" class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cetak</button>
                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
    <script>
        $(document).ready(function(){
            var oTable = $('#tblpenjualan').DataTable({
                order: [1, 'asc'],
                columnDefs: [
                    {width: 70, targets: 0},
                    {width: 70, targets: 1},
                    {width: 100, targets: 3},
                    {width: 100, targets: 4}
                ]
            });
        });
    </script>
@endsection
