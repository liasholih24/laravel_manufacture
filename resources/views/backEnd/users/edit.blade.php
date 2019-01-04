@extends('backLayout.app')
@section('title')
Pengguna
@stop
@section('desc')
Edit
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
   <ol class="breadcrumb col-sm-5 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('user') }}"> Pengguna
        </li>
        /
        <li class="">
                <a href="#">
                    Edit
                </a>
        </li>
    </ol>
            <a href="{{route('user.index')}}">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {{ Form::model($user, array('method' => 'PATCH', 'url' => route('user.update', $user->id), 'class' => 'form-horizontal', 'files' => true)) }}
    {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}

    <div class="form-group">
      {!! Form::label('first_name', 'Nama Depan*', ['class' => 'col-md-2 control-label']) !!}
      <div class="col-sm-4 {{ $errors->has('first_name') ? 'has-error' : ''}}">
         {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
         {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
      </div>
      
     {!! Form::label('role','Roles', ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4 {{ $errors->has('role') ? 'has-error' : ''}}">
         {!! Form::select('role', $roles, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Select Role']) !!}
         {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
     </div>
    </div>
    <div class="form-group">
     {!! Form::label('last_name', 'Nama Belakang' , ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4">
         {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
         {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
     </div>
     {!! Form::label('unit_id','Unit Kerja', ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4 {{ $errors->has('unit_id') ? 'has-error' : ''}}">
         {!! Form::select('unit_id', $units, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Unit Kerja']) !!}
         {!! $errors->first('unit_id', '<p class="help-block">:message</p>') !!}
     </div>
    </div>
    <div class="form-group">
      {!! Form::label('email', 'Username', ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4 {{ $errors->has('email') ? 'has-error' : ''}}">
         {!! Form::text('email', null, ['class' => 'form-control']) !!}
         {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
     </div>
       
      {!! Form::label('mobile_id', 'App Permission', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4 {{ $errors->has('mobile_id') ? 'has-error' : ''}}">
    {{ Form::select('mobile_id', ['0' => 'Web Apps Only','1' => 'Mobile Apps Only'], null, ['class' => 'form-control','placeholder'=>'Select App Permission ']) }}
  {!! $errors->first('mobile_id', '<p class="help-block">:message</p>') !!}
    </div>
  </div>
    <div class="form-group">
      {!! Form::label('password', 'Password', ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4">
         {!! Form::password('password', ['class' => 'form-control']) !!}
         {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
     </div>
     {!! Form::label('status','Status', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::select('status', $statuses, null, ['class' => 'form-control select2_demo_1']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
      
     {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
    </div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
  {!! Form::label('image', 'Image', ['class' => 'col-md-2 control-label']) !!}
 <div class="col-sm-4">
	 <div class="btn-group">
			 <label title="Upload image file" for="inputImage" class="btn btn-primary">
					 <input type="file" accept="image/*" name="file" id="inputImage" class="hide">
					 Upload new image
			 </label>
	 </div>
     {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
 </div>

 {!! Form::label('image', 'Preview Image', ['class' => 'col-md-2 control-label']) !!}
<div class="col-sm-4">
	<img id="imagePreview" style="max-height:200px;" src="{{$user->url_image?asset($user->url_image):""}}">
		{!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

</div>

								<div class="hr-line-dashed"></div>

<div class="form-group">
  @if (Sentinel::getUser()->hasAccess(['user.edit']))
  <a href="{{route('user.index')}}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; ">
            <i class="fa fa-plus-circle"></i>  Update
      </button>
  </a>
  @endif
</div>

      </div>
    </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>

@endsection
@section('script')


{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}


<script>
jQuery(document).ready(function() {
		$(".select2_demo_1").select2();
		function readURL(input) {

		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#imagePreview').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#inputImage").change(function(){
		    readURL(this);
		});
		});
</script>

@endsection
