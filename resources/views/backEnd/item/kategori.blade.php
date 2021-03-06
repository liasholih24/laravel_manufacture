@extends('backLayout.app')
@section('title')
Kategori Barang
@stop
@section('desc')
Kelola Kategori Barang 
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css') }}
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
{{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
<style>
.select2-selection .select2-selection--single{
border: 1px solid #f8ac59 !important;
}
</style>
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
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                <strong>Kategori Barang</strong>
              </a>
          </li>
         </ol>
          @if (Sentinel::getUser()->hasAccess(['item.create']))
          <a href="{{ url('item/0/create') }}">
          <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Tambah Kategori
          </button>
          </a>
          @endif
          <a href="{{ url('item') }}">
          <button class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
              <i class="fa fa-list" style="margin-right: 5px"></i>
                  Data Barang
          </button>
          </a>
     

    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    @if(session()->has('alert-success'))
        <div class="alert alert-success">
            {{ session()->get('alert-success') }}
        </div>
    @endif
    <div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Updated At</th>
        <th>Updated By</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
  <?php $i = 0?>
  @foreach($tables as $table)
  <?php $i++ ?>
  <tr>
      <td>{{$i}}</td>
      <td>{{$table->code}}</td>
      <td>{{$table->name}}</td>
      <td>{!! empty($table->note)?"<i>No Description</i>":$table->note !!}</td>
      <td>{{$table->updated_at}}</td>
      <td>{{$table->createdby->first_name}} {{$table->createdby->last_name}}</td>
      <td>
        @if (Sentinel::getUser()->hasAccess(['item.edit']))
        <a href="{{ url('item/' . $table->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs">Edit</a>
        @endif

        {!! Form::open([
                'method'=>'DELETE',
                'url' => ['item', $table->id],
                'style' => 'display:inline',
                'onsubmit' => 'return ConfirmDelete()'
            ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
        {!! Form::close() !!}
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
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
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
        /* Init DataTables */
        var oTable = $('#editable').DataTable(
          {order: [ 4, 'desc' ]}
        );

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
