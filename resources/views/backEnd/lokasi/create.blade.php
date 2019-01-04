@extends('backLayout.app')
@section('title')
Lokasi
@stop
@section('desc')
Add New
@stop
@section('style')
 {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
@endsection
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
            <a href="{{ url('status') }}"> Lokasi
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="{{ url('status') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
	<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'lokasi', 'class' => 'form-horizontal']) !!}
		{!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
		{!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
		<div class="form-group">
			{!! Form::label('kategori', 'Wilayah', ['class' => 'col-sm-1 control-label']) !!}
			<div class="col-sm-5 {{ $errors->has('category') ? 'has-error' : ''}}">
				<select class="form-control chosen-select" name="kategori">
					<option value="uncategories">Pilih Wilayah</option>
					@foreach($statuses  as $status)
					@foreach($status->getDescendantsAndSelf(array('id','parent_id','name','depth'))->toHierarchy() as $relation)
					@if($relation->depth==0)
					<option value="{{$relation->id}}">{{$relation->name}}</option>
					@elseif($relation->depth==1)
						<option value="{{$relation->id}}">
							&nbsp;&nbsp; - {{$relation->name}}
						</option>
					@endif
					@endforeach
					@endforeach

				</select>
					{!! $errors->first('kategori', '<p class="help-block">:message</p>') !!}
			</div>
			{!! Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']) !!}
			<div class="col-sm-5 {{ $errors->has('status') ? 'has-error' : ''}}">
				{{ Form::select('status', $activations, null, ['class' => 'form-control chosen-select']) }}
					{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
<div class="form-group">
	{!! Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']) !!}
	<div class="col-sm-5 {{ $errors->has('code') ? 'has-error' : ''}}">
			{!! Form::text('code', null, ['class' => 'form-control','placeholder'=>'Kode/Singkatan.']) !!}
			{!! $errors->first('code', '<p class="help-block">:message</p>') !!}
	</div>
	{!! Form::label('type', 'Type', ['class' => 'col-sm-1 control-label']) !!}
			<div class="col-sm-5 {{ $errors->has('type') ? 'has-error' : ''}}">
				{{ Form::select('type', $types, null, ['class' => 'form-control chosen-select','placeholder'=>'Pilih Type']) }}
					{!! $errors->first('type', '<p class="help-block">:message</p>') !!}
			</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']) !!}
	<div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
			{!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Nama Lokasi/Wilayah.']) !!}
			{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
	</div>
	{!! Form::label('address', 'Alamat*', ['class' => 'col-sm-1 control-label']) !!}
	<div class="col-sm-5 {{ $errors->has('address') ? 'has-error' : ''}}">
			{!! Form::text('address', null, ['class' => 'form-control','placeholder'=>'Alamat Lokasi/Wilayah.']) !!}
			{!! $errors->first('address', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group">
{!! Form::label('notes', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                  {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']) !!}
                  {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
</div>

    <div class="form-group">
<a href="{{ url('status') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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
@section('script')
 {{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
<script>
var csrf = $('meta[name="csrf-token"]').attr('content');
 jQuery(document).ready(function() {
var config = {
          '.chosen-select'           : {search_contains: true },
          '.chosen-select-deselect'  : {allow_single_deselect:true},
          '.chosen-select-no-single' : {disable_search_threshold:10},
          '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
          '.chosen-select-width'     : {width:"95%"}
          }
      for (var selector in config) {
          $(selector).chosen(config[selector]);
      }
        });
		
</script>

@endsection
