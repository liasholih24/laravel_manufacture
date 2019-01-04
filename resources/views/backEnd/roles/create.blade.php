@extends('backLayout.app')
@section('title')
New user role
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/iCheck/custom.css') }}
@endsection
@section('content')
<div  class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('role') }}">  Roles
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="{{ url('role') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'role', 'class' => 'form-horizontal']) !!}
{!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
{!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12 ">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
										{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
								{!! Form::label('level', 'Level', ['class' => 'col-sm-1 control-label']) !!}
								<div class="col-sm-5 col-xs-12 {{ $errors->has('status') ? 'has-error' : ''}}">
									<div class="input-group col-sm-12 col-xs-12 ">
										<select class="form-control m-b" name="level">
											<option value="">Choose Level</option>
											<option value="Head Office">Head Office</option>
											<option value="Client">Client</option>
										</select>
									</div>
								</div>

            </div>
						<div class="form-group">
						{!! Form::label('desc', 'Desc', ['class' => 'col-sm-1 control-label']) !!}
							<div class="col-sm-5 col-xs-12  {{ $errors->has('desc') ? 'has-error' : ''}}">
							<textarea name="desc" type="text" class="form-control" placeholder="Description of location. [ Maks. 500 char ]" style="height: auto"></textarea>
						</div>
						{!! Form::label('status', 'Activation', ['class' => 'col-sm-1 control-label']) !!}
						<div class="col-sm-5 col-xs-12 {{ $errors->has('status') ? 'has-error' : ''}}">
							<div class="input-group col-sm-12 col-xs-12 ">
								{{ Form::select('status', ['1' => 'Active','2' => 'Inactive'], null, ['class' => 'form-control','placeholder'=>'Select Status']) }}

							</div>
						</div>
						</div>
						<div class="form-group">
						{!! Form::label('', 'Modules', ['class' => 'col-sm-1 control-label']) !!}
					</div>

					<div class="form-group">
 @foreach($actions as $action)
			        <div class="col-md-4">
			          <?php $first= array_values($action)[0];
			            $firstname =explode(".", $first)[0];
			          ?>
@if ($firstname == "home")
{{Form::label($firstname, $firstname, ['class' => 'form col-md-3 capital_letter'])}}
<div class="col-sm-6 col-xs-12" >
		<input name="permissions[]"  value="{{$firstname}}.dashboard"  type="checkbox" class="i-checks" checked disabled>
</div>

@else
{{Form::label($firstname, $firstname, ['class' => 'form col-md-3 capital_letter'])}}
<div class="col-sm-6 col-xs-12">
		<input name="permissions[]"  value="{{$firstname}}.index" type="checkbox" class="i-checks" checked>

</div>
@endif
</div>
@endforeach
			    </div>
<div class="form-group">
<a href="{{url ('role')}}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

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


{{ HTML::script('assets_back/js/plugins/iCheck/icheck.min.js') }}

<script>
		$(document).ready(function () {
				$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green',
				});
		});
</script>

@endsection
