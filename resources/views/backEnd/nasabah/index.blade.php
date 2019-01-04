@section('style')
  {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
@extends('backLayout.app')
@section('title')
Nasabah
@stop
@section('desc')
Kelola Data Nasabah
@stop
@section('content')
<div class="wrapper wrapper-content">
	<div class="row detail_content3">
	     <div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
            <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="active">
            Nasabah
        </li>
    </ol>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-primary pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <a href="{{ url('nasabah/create') }}">
    <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Tambah Baru
    </button>
  </a>
</div>
<div class="row ibox-content" style="min-height: 65vh; ">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ Session::get('alert-' . $msg) }}.
      </div>
      @endif
    @endforeach
	<div class="col-xs-12 col-sm-12">
    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="nasabah_table">
<thead>
    <tr>
        <th>ID</th>
        <th>No. Rekening</th>
        <th>Nama Nasabah</th>
        <th>Unit</th>
        <th>Last Update</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $i = 0 ?>
@foreach($nasabah as $item)
<?php $i++ ?>
    <tr data-id="1{{$item->id}}">
        <td>{{ $item->id }}</td>
        <td><a href="{{ url('nasabah', $item->id) }}">{{ $item->norek }}</a></td>
        <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
        <td>{{ empty($item->getgroup->name)?"": $item->getgroup->name}}</td>
        <td>{{$item->updated_at}}</td>
        <td>{!! empty($item->updatedby->first_name)?"": $item->updatedby->first_name!!} {!! empty($item->updatedby->last_name)?"": $item->updatedby->last_name!!}</td>
        <td>
              @if( $item->status == "3")
        <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
        @else
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        @endif
        </td>
        <td>
    @if (Sentinel::getUser()->hasAccess(['nasabah.destroy']))
    <a href="{{ url('nasabah/' . $item->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs">Edit</a>
    @endif 
    @if (Sentinel::getUser()->hasAccess(['nasabah.show']))
    <a href="{{ url('nasabah/' . $item->id . '') }}" class="btn btn-outline btn-primary btn-xs">View</a>
    @endif    
        </td>
    </tr>
@endforeach
</tfoot>
</table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('script')

{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){


         /* Init DataTables */
        var oTable = $('#nasabah_table').DataTable(
          {order: [ 1, 'asc' ]}
        );

        $('#submit').click(function(){
        $('#formfield').submit();
        });

    });


</script>
@endsection
