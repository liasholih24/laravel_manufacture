@extends('backLayout.app')
@section('title')
Standard Grower 
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
   <ol class="breadcrumb col-sm-5 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('standargrower') }}"> Standar Grower</a>
        </li>
        
        <li class="">
                <a href="#">
                Buat Baru
                </a>
        </li>
    </ol>
            <a href="{{ url('standargrower') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'standargrower', 'class' => 'form-horizontal']) !!}

            <div class="form-group {{ $errors->has('standar') ? 'has-error' : ''}}">
                {!! Form::label('standar', 'Standard', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                {!! Form::select('standar', 
                                    ['Standard HY-LINE'=>'Standard HY-LINE'
                                    , 'Standard HY-SEX'=>'Standard HY-SEX'
                                    , 'Standard HY-ISA' => 'Standard HY-ISA'
                                    ], null, ['class' => 'form-control','placeholder'=>'Pilih Standard','required'=>'required']) !!}
                   
                    {!! $errors->first('standar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('umur') ? 'has-error' : ''}}">
                {!! Form::label('umur', 'Umur', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::number('umur', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('umur', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('pkg', 'Pakan (Gram)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-2">
                    {!! Form::number('pkg0', null, ['class' => 'form-control','placeholder'=>'Min Value','step'=>'any','required'=>'required']) !!}   
                </div>
                <div class="col-sm-2">
                    {!! Form::number('pkg1', null, ['class' => 'form-control','placeholder'=>'Max Value','step'=>'any','required'=>'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('bbg', 'Berat Badan (Gram)', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-2">
                    {!! Form::number('bbg0', null, ['class' => 'form-control','placeholder'=>'Min Value','step'=>'any','required'=>'required']) !!}   
                </div>
                <div class="col-sm-2">
                    {!! Form::number('bbg1', null, ['class' => 'form-control','placeholder'=>'Max Value','step'=>'any','required'=>'required']) !!}
                </div>
            </div>


    <div class="form-group">
<a href="{{ url('standargrower') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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
