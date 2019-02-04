@extends('backLayout.app')
@section('title')
Pengguna
@stop
@section('desc')
Kelola Data Pengguna
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
{{ HTML::style('assets_back/css/plugins/select2/select2-bootstrap.min.css')}}
<style>
#imagePreview  {
  position: absolute !important;
}
</style>
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
                    Tambah Baru
                </a>
        </li>
    </ol>
            <a href="{{ url('organization') }}">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {{ Form::open(array('url' => route('user.store'), 'class' => 'form-horizontal','files' => true)) }}
    {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
    {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}

    <div class="form-group">
    {!! Form::label('role','Roles', ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4 {{ $errors->has('role') ? 'has-error' : ''}}">
         {!! Form::select('role', $roles, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Select Role']) !!}
         {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
     </div>
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


     </div>
    <div class="form-group">
      {!! Form::label('first_name', 'Nama Depan*', ['class' => 'col-md-2 control-label']) !!}
      <div class="col-sm-4 {{ $errors->has('first_name') ? 'has-error' : ''}}">
         {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
         {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
      </div>
      {!! Form::label('image', 'Preview Image', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-4">
            <img id="imagePreview" style="max-height:200px;">
            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        </div>
    
      
     
    </div>
    <div class="form-group">
     {!! Form::label('last_name', 'Nama Belakang' , ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4">
         {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
         {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
     </div>


	  
    </div>
    <div class="form-group">
      {!! Form::label('email', 'Username', ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4 {{ $errors->has('email') ? 'has-error' : ''}}">
         {!! Form::text('email', null, ['class' => 'form-control']) !!}
         {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
     </div>
       
    
  </div>
    <div class="form-group">
      {!! Form::label('password', 'Password', ['class' => 'col-md-2 control-label']) !!}
     <div class="col-sm-4">
         {!! Form::password('password', ['class' => 'form-control']) !!}
         {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
     </div>
     
    </div>
    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
      
     {!! Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
    </div>


                <div class="hr-line-dashed"></div>

<div class="form-group">
  @if (Sentinel::getUser()->hasAccess(['user.create']))
  <a href="{{route('user.index')}}" class="detail2 btn btn-md btn-outline btn-default pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 10px; ">
            <i class="fa fa-plus-circle"></i>  Simpan
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
		$(".select2_demo_1").select2({
                theme: 'bootstrap',
                width: '100%'
                });
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
