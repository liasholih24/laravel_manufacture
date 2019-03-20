@extends('backLayout.app')
@section('title')
Create new Status
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
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
            <a href="{{ url('status') }}"> Status
        </li>
        /
        <li class="">
                <a href="#">
                    Tambah Baru
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
    {!! Form::open(['url' => 'status', 'class' => 'form-horizontal']) !!}
		{!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
		{!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
		
		<div class="form-group">
			{!! Form::label('kategori', 'Kategori', ['class' => 'col-sm-1 control-label']) !!}
			<div class="col-sm-5 {{ $errors->has('category') ? 'has-error' : ''}}">
				<!--
				<select class="form-control select2_demo_1" name="kategori">
					<option value="uncategories">Pilih Kategori</option>
					@foreach($statuses  as $status)
					@foreach($status->getDescendantsAndSelf(array('id','parent_id','name','depth'))->toHierarchy() as $relation)
					@if($relation->depth==0)
					<option value="{{$relation->id}}">{{$relation->name}}</option>
					@elseif($relation->depth==1)
						<option value="{{$relation->id}}">
							&nbsp;&nbsp; - {{$relation->name}}
						</option>
					@elseif($relation->depth==2)
						<option value="{{$relation->id}}">
							&nbsp;&nbsp;&nbsp; -- {{$relation->name}}
						</option>
						@elseif($relation->depth==3)
							<option value="{{$relation->id}}">
								&nbsp;&nbsp;&nbsp; --- {{$relation->name}}
							</option>
					@endif
					@endforeach
					@endforeach

				</select>
			-->


				<select class="form-control select2_demo_1" name="kategori">
					<option value="uncategories">Pilih Kategori</option>
					@foreach($statuses  as $status)
						<option value="{{$status->id}}">
						 {{$status->name}}
						</option>
					@endforeach
				</select>
			
					{!! $errors->first('kategori', '<p class="help-block">:message</p>') !!}
			</div>
			{!! Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']) !!}
			<div class="col-sm-5 {{ $errors->has('status') ? 'has-error' : ''}}">
				{{ Form::select('status', $activations, null, ['class' => 'form-control select2_demo_1']) }}
					{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
			</div>
		</div>
<div class="form-group">
	{!! Form::label('code', 'Kode* ', ['class' => 'col-sm-1 control-label']) !!}
	<div class="col-sm-5 {{ $errors->has('code') ? 'has-error' : ''}}">
			{!! Form::text('code', null, ['class' => 'form-control']) !!}
			{!! $errors->first('code', '<p class="help-block">:message</p>') !!}
	</div>
	{!! Form::label('name', 'Nama* ', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5 {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('desc', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
    <div class="col-sm-5 {{ $errors->has('desc') ? 'has-error' : ''}}">
            {!! Form::text('desc', null, ['class' => 'form-control']) !!}
            {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
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

{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}

<script>
var csrf = $('meta[name="csrf-token"]').attr('content');
 jQuery(document).ready(function() {


		$(".select2_demo_1").select2();
		});
</script>

@endsection
