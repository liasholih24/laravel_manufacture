@extends('frontLayout.app')
@section('style')
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('css/stylelgn.css') }}
@stop
@section('title')
Login
@stop
@section('content')
	<div class="big-screen" ><img src="images/login.jpg" class="img-responsive" style=" height: 100vh; width: 70%; position: absolute;">
       	<div style="width: 30%; background-color: #ffffff; height: 100vh; position: relative;" class="pull-right">
	       	<div class="middle-box text-center loginscreen"  style="margin-top: 35%">
		        <div class-="col-md-12" >
		            <h2 style="font-size: 36px"><strong>KS</strong></h2>
		            <h4> Manufacture Application </h4>
		            <br>
		            <!--
		            <p>Login in. To see it in action.</p>
		            -->
		        </div>
            {{ Form::open(array('url' => route('login'), 'class' => 'login-form','files' => true)) }}
            {!! csrf_field() !!}

						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
								@if(Session::has('alert-' . $msg))
								<div class="alert alert-{{ $msg }} alert-dismissable">
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
									{{ Session::get('alert-' . $msg) }}.
								</div>
							@endif
						@endforeach

                <div class="form-group">
                        {!! Form::text('email', null, ['class' => 'form-control','placeholder '=>'E-mail']) !!}
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>

                <div class="form-group">
                    {!! Form::password('password', ['class' => 'form-control','placeholder '=>'Password']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
                <br/>

                    <!--<div class="col-sm-4">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="remember" value="1" /> Remember me
                            <span></span>
                        </label>
                    </div>-->
                    <div class="form-group">

                        <button  type="submit" value="Login" name="Submit" class="btn btn-outline btn-success block full-width m-b">Sign In</button>
                    </div>

            </form>
	            <p class="m-t" ><strong>PT. Salingka Global Indonesia </strong><small>© 2019</small></p>
	        </div>
	    </div>
	</div>
	<div class="small-screen">
		<!--
		<div>

	    	<div class="middle-box text-center loginscreen small-screen">
		        <div class="col-md-12" style="margin: 15% 0;">
		          <img src="http://icon-plus.buzcon.com//assets/img/logo.png" style="width: 85%; margin: 0 auto" class="img-responsive">

					  </div>
		        <div class-="col-md-12" >
		            <h2>Welcome to</h2>
		            <h3>Assets Management System </h3>
		            <br>

		            <p>Login in. To see it in action.</p>

		        </div>

	            <p class="m-t">PT.<strong> Indonesia Comnets Plus </strong><small>© 2017</small></p>
        	</div>-->
    	</div>
	</div>

@endsection
