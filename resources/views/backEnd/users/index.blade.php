@extends('backLayout.app')
@section('title')
Users
@stop
@section('style')

{{ HTML::style('assets_back/css/plugins/select2/select2.min.css') }}
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
{{ HTML::style('assets_back/css/plugins/select2/select2-bootstrap.min.css')}}
@endsection
@section('content')
<div class="wrapper wrapper-content">
	<div class="row detail_content3">

<div class="col-lg-12 detail_content2" style="background-color: white">
			 <style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
			 </style>
            <div class="row ibox-title">
              <ol class="breadcrumb col-sm-8 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
                    <li class="active">
                        User
                    </li>
                  
                </ol>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-warning pull-right">
                    <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
                </a>
                @if (Sentinel::getUser()->hasAccess(['user.create']))
                <a href="{{ url('user/create') }}"><button class="btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
                    <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Add New User
                </button>
                </a>
                @endif
              <div class="col-sm-2" style="position:absolute;margin-left:780px;">
                <select class="select2_demo_1"  style="margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
                @foreach($roles as $role)
                  <option value="{{ url('user') }}">Select Roles</option>
                  <option value="{{ url('user/'.$role->id.'/role') }}" <?php if ($role->id == $id) echo ' selected="selected"'; ?>>{{$role->name}}</option>
                  @endforeach
              </select>
              </div>
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
          <th>Username</th>
          <th>Roles</th>
          <th>Last Updated</th>
					<th>Updated By</th>
					<th>Status</th>
          <th>Actions</th>

      </tr>
  </thead>
  <tbody>
			<?php $x = 0 ?>
      @foreach($users as $user)
			<?php $x++?>
          <tr>
            <td>{{$x}}</td>
              <td><a href="{{route('user.show', $user->id)}}">{{$user->first_name}} {{$user->last_name}}</a></td>
              <td>{{$user->email}}</td>
              <td>{!! empty($user->roles()->first())?"<b>No Roles</b>":$user->roles()->first()->name !!} </td>
							<td>{{$user->created_at}}</td>
							<td>{{$user->updatedby->first_name}} {{$user->updatedby->last_name}}</td>
							<td>@if( $user->status == 3)
							<a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
							@elseif($user->status == 2)
							<a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
							@endif</td>
							<td>

                  @if (Sentinel::getUser()->hasAccess(['user.show']))
                  <a href="{{route('user.show', $user->id)}}" class="btn btn-primary btn-outline btn-xs">View</a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['user.edit']))
                  <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary btn-outline btn-xs">Edit</a>
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
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){


        /* Init DataTables */
        var oTable = $('#editable').DataTable(
					{
  				"columnDefs": [
    		{ "searchable": false, "targets": 7 }
  		]
		}
				);

        /* Apply the jEditable handlers to the table */



    });

		$(".select2_demo_1").select2({
                theme: 'bootstrap',
                width: '100%'
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
