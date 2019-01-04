@extends('backLayout.app')
@section('title')
Status
@stop
@section('desc')
Kelola Status
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css') }}
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
@section('content')
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
  <style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
                        </style>
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-8 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                Status
              </a>
          </li>
          </ol>
          <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          @if (Sentinel::getUser()->hasAccess(['status.create']))
          <a href="{{ url('status/create') }}">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add Status

          </button>
          </a>
          @endif
        <select class="select2_demo_1 form-control" style="width:200px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
          <option value="{{ url('status')}}">Select Status</option>
          @foreach($filters as $filter)
          <option value="{{ url('status/' . $filter->id . '/filter') }}" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
            {{$filter->name}}
          </option>
          @endforeach
        </select>

    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    <div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Last Update</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
  <?php $i = 0?>
  @foreach($tables as $table)
  <?php $i++ ?>
  <tr>
      <td>{{$i}}</td>
      <td>{!! empty($table->code)?"<i>Kode tidak terdefinisi</i>": $table->code !!}</td>
      <td>{{$table->name}}</td>
      <td>{{$table->parent()->first()->name}}</td>
      <td>{!! empty($table->desc)?"<i>Tidak ada deskripsi</i>":$table->desc !!}</td>
     <td>{{$table->updated_at}}</td>
      <td>{{$table->updatedby->first_name}} {{$table->updatedby->last_name}}</td>
      <td>
       @if( $table->status == "3")
        <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
        @else
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        @endif
      </td>
      <td>
        @if (Sentinel::getUser()->hasAccess(['status.show']))
        <a href="{{ url('status/' . $table->id . '/show') }}" class="btn btn-primary btn-outline btn-xs">View</a>
        @endif
        @if( $table->parent_id != "1")
        @if (Sentinel::getUser()->hasAccess(['status.edit']))
        <a href="{{ url('status/' . $table->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs">Edit</a>
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

@endsection

@section('script')


{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){


        /* Init DataTables */
        var oTable = $('#editable').DataTable();



    });


		$(".select2_demo_1").select2();
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
