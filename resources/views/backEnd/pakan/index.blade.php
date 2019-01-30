@section('style')
  {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
@extends('backLayout.app')
@section('title')
Pakan
@stop
@section('desc')
Komposisi & Harga
@stop
@section('desc')

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
            Pakan
        </li>
    </ol>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-warning pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <a href="{{ url('pakan/create') }}">
    <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Add New
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
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>HPP</th>
        <th>Notes</th>
        <th>Created By</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $i = 0 ?>
@foreach($pakan as $item)
<?php $i++ ?>
    <tr>
        <td>{{ $i }}</td>
        <td>{{ $item->name }}</td>
        <td>{!! empty($item->hpp)?"<i>No Data</i>": number_format($item->hpp) !!}</td>
        <td>{!! empty($item->notes)?"<i>No Data</i>": $item->notes !!}</td>
        <td>{{ $item->createdby->first_name }} {{ $item->createdby->last_name }}</td>
        <td>{{$item->created_at}}</td>
        <td>
            <a href="{{ url('pakan/' . $item->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs">Update</a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['pakan', $item->id],
                'style' => 'display:inline',
                'onsubmit' => 'return ConfirmDelete()'
            ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
            {!! Form::close() !!}
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
        $('.dataTables-example').DataTable({
            order: [ 5, 'desc' ],
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });

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
