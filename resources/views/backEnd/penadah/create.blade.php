@extends('backLayout.app')
@section('title')
Penadah
@stop
@section('desc')
Tambah Baru
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
            <a href="{{ url('penadah') }}"> Penadah
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="{{ url('penadah') }}">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'penadah', 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
    {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}

                <div class="form-group">
                {!! Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('code') ? 'has-error' : ''}}">
                    {!! Form::text('code', null, ['class' => 'form-control','placeholder'=>'Kode/Singkatan.']) !!}
                    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Nama Penadah']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                {!! Form::label('phone', 'No.Telepon', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('phone', null, ['class' => 'form-control','placeholder'=>'No.Telepon']) !!}
                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('pic', 'PIC', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('pic', null, ['class' => 'form-control','placeholder'=>'Nama PIC']) !!}
                    {!! $errors->first('pic', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group ">
                {!! Form::label('address', 'Alamat', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12 {{ $errors->has('address') ? 'has-error' : ''}}">
                  {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Alamat [Max: 500 Katakter]']) !!}
                  {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('notes', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12 {{ $errors->has('notes') ? 'has-error' : ''}}">
                  {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']) !!}
                  {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
                </div>               
            </div>
            <div class="form-group ">
            {!! Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    {{ Form::select('status', $activations, null, ['class' => 'form-control chosen-select']) }}
                  </div>
                  {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



    <div class="form-group">
<a href="{{ url('penadah') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 20px; ">
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
