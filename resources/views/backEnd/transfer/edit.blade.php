@extends('backLayout.app')
@section('title')
Edit Transfer
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
            <a href="{{ url('transfer') }}">  Transfer
        </li>
        /
        <li class="">
                <a href="#">
                    Edit Transfer
                </a>
        </li>
    </ol>
            <a href="{{ url('transfer') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
  {!! Form::model($transfer, [
      'method' => 'PATCH',
      'url' => ['transfer', $transfer->id],
      'class' => 'form-horizontal'
  ]) !!}

                        <div class="form-group {{ $errors->has('gdg_from') ? 'has-error' : ''}}">
                {!! Form::label('gdg_from', 'Gdg From: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('gdg_from', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('gdg_from', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('gdg_to') ? 'has-error' : ''}}">
                {!! Form::label('gdg_to', 'Gdg To: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('gdg_to', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('gdg_to', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('qty_kg') ? 'has-error' : ''}}">
                {!! Form::label('qty_kg', 'Qty Kg: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('qty_kg', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('qty_kg', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('keterangan') ? 'has-error' : ''}}">
                {!! Form::label('keterangan', 'Keterangan: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('created_by') ? 'has-error' : ''}}">
                {!! Form::label('created_by', 'Created By: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('created_by', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('updated_by') ? 'has-error' : ''}}">
                {!! Form::label('updated_by', 'Updated By: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('updated_by', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('updated_by', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">

      <a href="{{ url('transfer') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

            <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                              <i class="fa fa-save"></i>  Update
                            </button>
    </div>
    </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>
@endsection
