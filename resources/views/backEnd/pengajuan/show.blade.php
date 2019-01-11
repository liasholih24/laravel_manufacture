@extends('backLayout.app')
@section('title')
Transfer
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
            <li class="">
                <a href="{{ url('%%routeGroup%%%%crudName%%') }}">  Transfer
            </li>
            /
            <li class="">
                    <a href="#">
                        Edit Transfer
                    </a>
            </li>
        </ol>
                <a href="{{ url('%%routeGroup%%%%crudName%%') }}">
                <button class="btn btn-sm btn-outline btn-warning pull-right">
                <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
                </button>
                </a>
        </div>
    <div class="row ibox-content" style="min-height: 65vh; ">
    	<div class="col-xs-12 col-sm-12">
        <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover dataTables-example">
          <thead>
              <tr>
                  <th>ID.</th> <th>Gdg From</th><th>Gdg To</th><th>Qty Kg</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>{{ $transfer->id }}</td> <td> {{ $transfer->gdg_from }} </td><td> {{ $transfer->gdg_to }} </td><td> {{ $transfer->qty_kg }} </td>
              </tr>
          </tbody>
      </table>
      </div>
      </div>
    </div>
    </div>
@endsection
