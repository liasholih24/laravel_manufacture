@extends('backLayout.app')
@section('title')
Kandang
@stop
@section('desc')
Kelola Data Kandang
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
{{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
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
                Lokasi
              </a>
          </li>
          </ol>
          <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          @if (Sentinel::getUser()->hasAccess(['lokasi.create']))
          <a href="{{ url('lokasi/create') }}">
          <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add New

          </button>
          </a>
          @endif
        <select class="form-control chosen-select" style="width:200px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
          <option value="{{ url('lokasi')}}">Pilih Farm</option>
          @foreach($filters as $filter)
          <option value="{{ url('lokasi/' . $filter->id . '/filter') }}" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
            {{$filter->name}}
          </option>
          @endforeach
        </select>

    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
     @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ Session::get('alert-' . $msg) }}.
      </div>
      @endif
    @endforeach
    <div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Farm</th>
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
      <td>{{$table->name}}</td>
      <td>{{$table->parent()->first()->name}}</td>
      <td>{!! empty($table->notes)?"<i>Tidak ada Deskripsi</i>":$table->notes !!}</td>
     <td>{{$table->updated_at}}</td>
      <td>{{$table->updatedby->first_name}} {{$table->updatedby->last_name}}</td>
      <td>@if( $table->status == "3")
        <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
        @else
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        @endif</td>
      <td>
        @if (Sentinel::getUser()->hasAccess(['lokasi.edit']))
        <a href="{{ url('lokasi/' . $table->id . '/edit') }}" class="btn btn-outline btn-success btn-xs">Edit</a>
        @endif
        @if (Sentinel::getUser()->hasAccess(['lokasi.show']))
        <a href="{{ url('lokasi/' . $table->id . '') }}" class="btn btn-primary btn-outline btn-xs">View</a>
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
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){

        /* Init DataTables */
        var oTable = $('#editable').DataTable();

  


    });

		var config = {
          '.chosen-select'           : {search_contains: true },
          '.chosen-select-deselect'  : {allow_single_deselect:true},
          '.chosen-select-no-single' : {disable_search_threshold:10},
          '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
          '.chosen-select-width'     : {width:"95%"}
          }
      for (var selector in config) {
          $(selector).chosen(config[selector]);
      }

</script>


@endsection
