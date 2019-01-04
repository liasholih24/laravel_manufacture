@extends('backLayout.app')
@section('title')
Satuan
@stop
@section('desc')
Tambah Baru
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
@endsection
@section('content')
  <div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
        <style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
        </style>
      <div class="row ibox-title">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('status') }}"> Satuan </a>
        </li>
        
        <li class="">
                <a href="#">
                    Tambah
                </a>
        </li>
        </ol>
            <a href="{{ url('status') }}">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
    <div class="row ibox-content" style="min-height: 65vh; ">
    <div class="col-xs-12 col-sm-12">

        {!! Form::open(['url' => 'satuan', 'class' => 'form-horizontal']) !!}
        {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
        {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}

                <div class="form-group">
                {!! Form::label('code', 'Code*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('code') ? 'has-error' : ''}}">
                    {!! Form::text('code', null, ['class' => 'form-control','placeholder' => 'Kode Satuan.']) !!}
                    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('standard_value', 'Ukuran*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('standard_value') ? 'has-error' : ''}}">
                    {!! Form::number('standard_value', null, ['class' => 'form-control', 'placeholder' => 'Ukuran Standar.','step'=>'any']) !!}
                    {!! $errors->first('standard_value', '<p class="help-block">:message</p>') !!}
                </div>
               
            </div>
           
            <div class="form-group ">
                
                 {!! Form::label('name', 'Name*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Nama Satuan.']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
                 {!! Form::label('basis', 'Basis', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  {{ Form::select('basis', $basises, null, ['class' => 'form-control','placeholder' => 'Pilih Basis']) }}
                  
                  {!! $errors->first('basis', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
             <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('desc', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5">
                     {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskirpsi mengenai satuan [Max: 500 Karakter].']) !!}
                    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
                </div>
                {!! Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  {{ Form::select('status', $activations, null, ['class' => 'form-control']) }}
                  
                  {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
                
            </div>
           

            <div class="form-group">
                <a href="{{ url()->previous() }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Batal</a>
                  <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 10px; ">
                    <i class="fa fa-save"></i>  Simpan
                  </button>
                </a>
              </div>
    {!! Form::close() !!}
    </div>
    </div>
</div>
</div>
</div>

@endsection