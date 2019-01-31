@section('style')
  {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
@extends('backLayout.app')
@section('title')
Roles
@stop
@section('desc')
Modul untuk mengelola pengguna dalam sistem
@stop
@section('content')
<!-- -->
<div class="wrapper wrapper-content">
	<div class="row detail_content3">
	     <div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
            <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="active">
            Roles
        </li>
    </ol>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-warning pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    @if (Sentinel::getUser()->hasAccess(['role.create']))
    <a href="{{ url('role/create') }}"><button data-url="roles" data-url2="roles" data-param="list" data-url3="add" data-lang="" class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Add New Role
    </button>
    @endif
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
<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
<tr>
    <th>No.</th>
    <th>Name</th>
    <th>Description</th>
    <th>Last Updated</th>
    <th>Updated By</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php $i = 0 ?>
@foreach($roles as $item)
<?php $i++ ?>
<tr class="gradeX">
    <td>{{ $i }}</td>
    <td>{{ $item->name }} </td>
    <td>{!! empty($item->desc)? "<i>No Description</i>" : $item->desc !!}</td>
    <td>{{ $item->updated_at }}</td>
    <td>{!! empty($item->updated_by)? " " : $item->updatedby->first_name !!} {!! empty($item->updated_by)? " " : $item->updatedby->last_name !!} </td>
    
    <td>
      @if (Sentinel::getUser()->hasAccess(['role.show']))
      <a href="{{url('role/' . $item->id . '/show')}}" class="btn btn-xs btn-primary btn-outline">View</a>
      @endif
      @if($item->id != 1)
      @if (Sentinel::getUser()->hasAccess(['role.edit']))
      <a href="{{ url('role/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs btn-outline ">Edit</a>
      @endif
      @endif

    </td>
</tr>
@endforeach
</tbody>
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
        var oTable = $('#editable').DataTable({order: [ 3, 'desc' ]});




    });



    function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }
</script>


@endsection
