@extends('backLayout.app')
@section('title')
Edit Brand
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
            <a href="{{ url('brand') }}">  Brand
        </li>
        /
        <li class="">
                <a href="#">
                    Edit Brand
                </a>
        </li>
    </ol>
            <a href="{{ url('brand') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
            {!! Form::model($brand, [
                'method' => 'PATCH',
                'url' => ['brand', $brand->id],
                'class' => 'form-horizontal'
            ]) !!}

            <div class="form-group">
        {!! Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']) !!}
        <div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama [Max: 50 Katakter]']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
       
            </div>
            <div class="form-group">
            {!! Form::label('note', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                    {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']) !!}
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">

      <a href="{{ url('brand') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

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
