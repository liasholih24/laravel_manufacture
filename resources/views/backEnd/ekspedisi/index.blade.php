@section('style')
    {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection

@extends('backLayout.app')

@section('title')
    Ekspedisi
@stop

@section('desc')
    Daftar Ekspedisi
@stop

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Daftar Ekspedisi</h5>
                        <a href="{{ url('ekspedisi/create') }}">
                            <button class="btn btn-sm btn-outline btn-success pull-right" style="margin-top: -7px">
                                <i class="fa fa-plus-circle"></i> Tambah Ekspedisi
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
                        @if(!empty($ekspedisi[0]))
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tblekspedisi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($ekspedisi as $r)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $r->name }}</td>
                                        <td>{{ $r->desc }}</td>
                                        <td>
                                            <a href="{{ url('ekspedisi/' . $r->id . '/edit') }}" class="btn btn-outline btn-warning btn-xs">Ubah</a>
                                            <a class="btn btn-outline btn-danger btn-xs" onclick="event.preventDefault(); document.getElementById('delete-form{{ $r->id }}').submit();">Hapus</a>
                                            <form id="delete-form{{ $r->id }}" action="{{ route('ekspedisi.destroy', [$r->id]) }}" method="POST" style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="jumbotron">
                            <h1>Data Kosong ... </h1>
                            <p>Mohon maaf, tidak ada data ekspedisi untuk bulan ini.</p>
                            <p><a href="{{ url('ekspedisi/create') }}" class="btn btn-primary btn-lg" role="button">Tambah Ekspedisi</a></p>
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
            var oTable = $('#tblekspedisi').DataTable({
                order: [0, 'asc']
            });
        });
    </script>
@endsection
