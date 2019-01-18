@section('style')
    {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection

@extends('backLayout.app')

@section('title')
    Customer
@stop

@section('desc')
    Daftar Customer
@stop

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Daftar Customer</h5>
                        <a href="{{ url('customer/create') }}">
                            <button class="btn btn-sm btn-outline btn-success pull-right" style="margin-top: -7px">
                                <i class="fa fa-plus-circle"></i> Tambah Customer
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
                        @if(!empty($customer[0]))
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tblcustomer">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Kontak</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($customer as $r)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $r->name }}</td>
                                        <td>{{ $r->address }}</td>
                                        <td>{{ $r->contact }}</td>
                                        <td>
                                            <a href="{{ url('customer/' . $r->id . '/edit') }}" class="btn btn-outline btn-warning btn-xs">Ubah</a>
                                            <a class="btn btn-outline btn-danger btn-xs" onclick="event.preventDefault(); document.getElementById('delete-form{{ $r->id }}').submit();">Hapus</a>
                                            <form id="delete-form{{ $r->id }}" action="{{ route('customer.destroy', [$r->id]) }}" method="POST" style="display: none">
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
                            <p>Mohon maaf, tidak ada data customer untuk bulan ini.</p>
                            <p><a href="{{ url('customer/create') }}" class="btn btn-primary btn-lg" role="button">Tambah Customer</a></p>
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
            var oTable = $('#tblcustomer').DataTable({
                order: [0, 'asc']
            });
        });
    </script>
@endsection
