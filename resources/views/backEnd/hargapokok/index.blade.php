@section('style')
  {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
@endsection
@extends('backLayout.app')
@section('title')
HPP Telur
@stop
@section('desc')
Harga Pokok Penjualan 
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
        HPP Telur
        </li>
    </ol>
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline btn-warning pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <a href="{{ url('hargapokok/create') }}">
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
        <th>Tgl.Perhitungan</th>
        <th>HPP Telur</th>
        <th>HPP Telur Super</th>
        <th>HPP Telur Bagus</th>
        <th>HPP Telur Putih</th>
        <th>HPP Telur Retak</th>
        <th>HPP Telur Cair</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $i = 0 ?>
@foreach($hargapokok as $item)
<?php $i++ ?>
    <tr>
        <td>{{ $item->id }}</td>
        <td><a href="{{ url('hargapokok', $item->id) }}">{{ $item->tgl_hpp }}</a></td>
        <td>{!! empty($item->hpp)? "<i>Not Set</i>" : $item->hpp!!}</td>
        <td>{!! empty($item->hpp_super)? "<i>Not Set</i>" : $item->hpp_super !!}</td>
        <td>{!! empty($item->hpp_bagus)? "<i>Not Set</i>" : $item->hpp_bagus !!}</td>
        <td>{!! empty($item->hpp_putih)? "<i>Not Set</i>": $item->hpp_putih !!}</td>
        <td>{!! empty($item->hpp_retak)? "<i>Not Set</i>": $item->hpp_retak !!}</td>
        <td>{!! empty($item->hpp_cair)? "<i>Not Set</i>": $item->hpp_cair !!}</td>
        <td>
            <a href="{{ url('hargapokok/' . $item->id . '/edit') }}" class="btn btn-outline btn-primary btn-xs">Update</a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['hargapokok', $item->id],
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
            order: [ 1, 'desc' ],
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'HPP Telur'},
                {extend: 'pdf', title: 'HPP Telur'},

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
