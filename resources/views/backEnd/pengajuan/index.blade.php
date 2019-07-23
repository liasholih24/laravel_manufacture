@section('style')
    {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection

@extends('backLayout.app')

@section('title')
    Pengajuan
@stop

@section('desc')
    Daftar Pengajuan
@stop

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Daftar Pengajuan</h5>
                        <a href="{{ url('pengajuan/create') }}">
                            <button class="btn btn-sm btn-outline btn-success pull-right" style="margin-top: -7px">
                                <i class="fa fa-plus-circle"></i> Tambah Pengajuan
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
                        @if(!empty($pengajuan[0]))
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tblpengajuan">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Items</th>
                                        <th>Dibuat oleh</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($pengajuan as $r)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $r->number }}</td>
                                        <td>{{ date('d/m/Y', strtotime($r->date)) }}</td>
                                        <td>{{ $r->desc }}</td>
                                        <td width="35%">
                                        <ul>
                                            @foreach ($r->items as $item)
                                                <li>{{ empty($item->item->name)? '' : $item->item->name.  ',Qty:' .$item->qty  }}  {{ $item->satuan->name }}</li>
                                            @endforeach
                                        </ul>
                                        </td>
                                        <td>{{ empty($r->createdby->first_name) ? "" : $r->createdby->first_name }} {{ empty($r->createdby->last_name) ? "" : $r->createdby->last_name }}</td>
                                        <td class="text-center">
                                            @if($r->status==2)
                                            <span class="badge badge-success">Telah diverifikasi</span>
                                            @else
                                            <a href="{{ url('pengajuan/' . $r->id . '/edit') }}" class="btn btn-outline btn-warning btn-xs">Ubah</a>
                                            <a href="{{ url('pengajuan/' . $r->id) }}" class="btn btn-outline btn-primary btn-xs">Verifikasi</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="jumbotron">
                            <h1>Data Kosong ... </h1>
                            <p>Mohon maaf, tidak ada data pengajuan untuk bulan ini.</p>
                            <p><a href="{{ url('pengajuan/create') }}" class="btn btn-primary btn-lg" role="button">Tambah Pengajuan</a></p>
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
            var oTable = $('#tblpengajuan').DataTable({
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
