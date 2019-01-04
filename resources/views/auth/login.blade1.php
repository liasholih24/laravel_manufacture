@extends('frontLayout.app')
@section('title')
Login
@stop

@section('content')
<!-- BEGIN : LOGIN PAGE 5-2 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 login-container bs-reset">
            <img class="login-logo login-6" width="200px" src="iconplus_logo.png" />
            <div class="login-content">
                <h1>Assets Management System</h1>
                <p> Login untuk mengakses aplikasi. Harap hubungi administrator jika belum mendapatkan akses login.</p>
                {{ Form::open(array('url' => route('login'), 'class' => 'login-form','files' => true)) }}
                {!! csrf_field() !!}
                    @if (Session::has('message'))
                     <div class="alert alert-danger alert-{{(Session::get('status')=='error')?'danger':Session::get('status')}} " alert-dismissable fade in id="sessions-hide">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <strong>{{Session::get('status')}}!</strong> {!! Session::get('message') !!}
                      </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-6">
                            {!! Form::text('email', null, ['class' => 'form-control','placeholder '=>'E-mail']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                       </div>
                        <div class="col-xs-6">
                          {!! Form::password('password', ['class' => 'form-control','placeholder '=>'Password']) !!}
                         {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="rememberme mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" name="remember" value="1" /> Remember me
                                <span></span>
                            </label>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button class="btn blue" name="Submit" value="Login" type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-5 bs-reset">
                        <ul class="login-social">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div
                    <div class="col-xs-7 bs-reset">
                        <div class="login-copyright text-right">
                            <p>2017 &copy; PT. Indonesia Comnets Plus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 bs-reset">
            <div class="login-bg"> </div>
        </div>
    </div>
</div>
<!-- END : LOGIN PAGE 5-2 -->
@endsection
