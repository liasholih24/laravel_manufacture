@section('style')
  {{ HTML::style('assets_back/css/plugins/summernote/summernote.css') }}
@endsection
@extends('backLayout.app')
@section('title')
Create new Post
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
            <a href="{{ url('posts') }}"> Post
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="{{ url('posts') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'posts', 'class' => 'form-horizontal','files'=>'true']) !!}

            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', 'Title: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
							{!! Form::label('title', 'Content: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
									{!! Form::textarea('content', null, ['class' => 'input-block-level', 'id'=>'content']) !!}
                    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : ''}}">
                {!! Form::label('thumbnail', 'Thumbnail: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
									<div class="image-crop">
										<img id="imagePreview" style="max-height:200px">
									</div>
									{{-- <h4>Thumbnail</h4> --}}
									<p>
											Unggah thumbnail
									</p>
									<div class="btn-group">
											<label title="Upload image file" for="inputImage" class="btn btn-primary">
													<input type="file" accept="image/*" name="image" id="inputImage" class="hide">
													Upload thumbnail
											</label>
									</div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('author') ? 'has-error' : ''}}">
                {!! Form::label('author', 'Author: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
										{!! Form::text(null,Sentinel::getUser()->first_name.' ' .Sentinel::getUser()->last_name, ['class' => 'form-control','readonly']) !!}
                    {!! Form::hidden('author',Sentinel::getUser()->id, ['class' => 'form-control','readonly']) !!}
                    {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('date_posted') ? 'has-error' : ''}}">
                {!! Form::label('date_posted', 'Date Posted: ', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                  <input type="datetime-local" name="date_posted" class="form-control" value="{{date("Y-m-d\TH:i")}}" readonly>
                    {!! $errors->first('date_posted', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
      <a href="{{ url('posts') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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
	{{ HTML::script('assets_back/js/plugins/summernote/summernote.min.js') }}
	<script type="text/javascript">
		$(document).ready(function() {
				 $('#content').summernote();
		 var postForm = function() {
				var content = $('textarea[name="content"]').html($('#summernote').code());
			}
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
