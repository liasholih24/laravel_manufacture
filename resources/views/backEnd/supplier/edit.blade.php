@extends('backLayout.app')
@section('title')
Edit Supplier
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
            <a href="{{ url('supplier') }}">  Supplier
        </li>
        /
        <li class="">
                <a href="#">
                    Edit Supplier
                </a>
        </li>
    </ol>
            <a href="{{ url('supplier') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
        {!! Form::model($supplier, [
            'method' => 'PATCH',
            'url' => ['supplier', $supplier->id],
            'class' => 'form-horizontal'
        ]) !!}
  {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
  <div class="form-group">
        {!! Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama [Max: 50 Katakter]','required' =>'required']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
        
        {!! Form::label('notes', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-5 col-xs-12">
            {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']) !!}
            {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
        </div>
       
    </div>
    <div class="form-group">
    {!! Form::label('telp', 'Telepon*', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('telp', null, ['class' => 'form-control', 'placeholder' => 'No Telp/HP', 'required' =>'required']) !!}
                    {!! $errors->first('telp', '<p class="help-block">:message</p>') !!}
                </div>
    {!! Form::label('telp2', 'Telepon', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('telp2', null, ['class' => 'form-control', 'placeholder' => 'No Telp/HP']) !!}
        {!! $errors->first('telp2', '<p class="help-block">:message</p>') !!}
    </div>
    </div>
    <div class="form-group">
    
    
    {!! Form::label('pic', 'PIC*', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('pic', null, ['class' => 'form-control','placeholder' => 'Penanggung Jawab', 'required' =>'required']) !!}
            {!! $errors->first('pic', '<p class="help-block">:message</p>') !!}
        </div>
    {!! Form::label('pic2', 'PIC', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('pic2', null, ['class' => 'form-control','placeholder' => 'Penanggung Jawab']) !!}
            {!! $errors->first('pic2', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-1 control-label">Pajak/Non Pajak</label>
        <div class="col-sm-5">
            <select name="pajak" class="form-control">
                <option value="Pajak">Pajak</option>
                <option value="Non Pajak" @if($supplier->pajak=='Non Pajak') selected @endif>Non Pajak</option>
            </select>
        </div>
    </div>

    <div class="form-group">

      <a href="{{ url('supplier') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

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
