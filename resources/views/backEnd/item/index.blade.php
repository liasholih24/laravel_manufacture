@extends('backLayout.app')
@section('title')
Referensi Barang
@stop
@section('desc')
Kelola Data Barang 
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
                <strong>Data Barang</strong>
              </a>
          </li>
         </ol>
          <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          @if (Sentinel::getUser()->hasAccess(['item.create']))
          <a href="{{ url('item/1/create') }}">
          <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Tambah
          </button>
          </a>
          @endif
          <a href="{{ url('kategori') }}">
          <button class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
              <i class="fa fa-list" style="margin-right: 5px"></i>
                  Kategori Barang
          </button>
          </a>
          <select class="form-control chosen-select" style="max-width:265px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
						<option value="{{ url('item')}}">Pilih Kategori</option>
						@foreach($filters as $filter)
						<option value="{{ url('item/' . $filter->id . '/filter') }}" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
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
        <th>Kode</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Brand</th>
        <th>Satuan</th>
        <th>Updated By</th>
        <th>Updated At</th>
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
      <td>{{$table->parent->name}}</td>
      <td>{!! empty($table->brand->name)? "<i>No Brand</i>" : $table->brand->name !!}</td>
      <td>{{$table->getsatuan->name}}</td>
      <td>{!! empty($table->updatedby->first_name)?"": $table->updatedby->first_name!!} {!! empty($table->updatedby->last_name)?"": $table->updatedby->last_name!!}</td>
      <td>
      {{$table->created_at}}
      </td>
      <td>
        @if (Sentinel::getUser()->hasAccess(['item.show']))
        <a href="{{ url('item/' . $table->id . '/show') }}" class="btn btn-primary btn-outline btn-xs">View</a>
        @endif

        @if (Sentinel::getUser()->hasAccess(['item.edit']))
        <a href="{{ url('item/' . $table->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs">Edit</a>
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
          {order: [ 7, 'desc' ]}
        );

$('#submit').click(function(){
  //  alert('submitting');
    $('#formfield').submit();
});

    });

		$(".select2_demo_1").select2();

</script>


@endsection
