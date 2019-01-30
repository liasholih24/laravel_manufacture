@extends('backLayout.app')
@section('title')
Standard FC
@stop
@section('desc')
Buat Baru
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
            <a href="{{ url('standarfc') }}"> Standard FC </a>
        </li>
        
        <li class="">
                <a href="#">
                    Buat Baru
                </a>
        </li>
    </ol>
            <a href="{{ url('standarfc') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'standarfc', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('umur', 'Umur', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-2">
                    {!! Form::number('umur0', null, ['class' => 'form-control','placeholder'=>'Min Value','required'=>'required']) !!}   
                </div>
                <div class="col-sm-2">
                    {!! Form::number('umur1', null, ['class' => 'form-control','placeholder'=>'Max Value','required'=>'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('fc', 'FC(%)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-2">
                    {!! Form::number('fc0', null, ['class' => 'form-control','placeholder'=>'Min Value','step'=>'any','required'=>'required']) !!}   
                </div>
                <div class="col-sm-2">
                    {!! Form::number('fc1', null, ['class' => 'form-control','placeholder'=>'Max Value','step'=>'any','required'=>'required']) !!}
                </div>
            </div>

    <div class="form-group">
<a href="{{ url('standarfc') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-plus-circle"></i>  Create
                      </button>
      </a>
    </div>
    </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>

@endsection
