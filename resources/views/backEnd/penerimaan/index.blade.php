@section('style')
    {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection

@extends('backLayout.app')

@section('title')
    Penerimaan
@stop

@section('desc')
    Daftar Penerimaan
@stop

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Daftar Penerimaan</h5>
                        <a href="{{ url('penerimaan/create') }}">
                            <button class="btn btn-sm btn-outline btn-success pull-right" style="margin-top: -7px">
                                <i class="fa fa-plus-circle"></i> Tambah Penerimaan
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
                        @if(!empty($penerimaan[0]))
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tblpenerimaan">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Dibuat oleh</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($penerimaan as $r)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $r->number }}</td>
                                        <td>{{ date('d/m/Y', strtotime($r->date)) }}</td>
                                        <td>{{ $r->desc }}</td>
                                        <td>{{ empty($r->createdby->first_name) ? "" : $r->createdby->first_name }} {{ empty($r->createdby->last_name) ? "" : $r->createdby->last_name }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('penerimaan/' . $r->id . '/edit') }}" class="btn btn-outline btn-warning btn-xs">Ubah</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="jumbotron">
                            <h1>Data Kosong ... </h1>
                            <p>Mohon maaf, tidak ada data penerimaan untuk bulan ini.</p>
                            <p><a href="{{ url('penerimaan/create') }}" class="btn btn-primary btn-lg" role="button">Tambah Penerimaan</a></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
    <script>
        $(document).ready(function(){
            var oTable = $('#tblpenerimaan').DataTable({
                order: [0, 'desc'],
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
