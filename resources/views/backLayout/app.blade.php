<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('backLayout.header')
<body>
	<div id="wrapper">
		@include('backLayout.NavBar')
		<div id="page-wrapper" class="gray-bg dashbard-1">
			@include('backLayout.NavBarTop')
			<div class="row wrapper border-bottom white-bg page-heading">
				<div id="bread" class="col-lg-9">
					<h2> @yield('title') <small> - @yield('desc')  </small></h2>
					<ol class="breadcrumb">
						<li class=""><a href="{{route('home.dashboard')}}">Dashboard</a></li>
						<li class="active"><a href="#"><b>@yield('title')</b></a></li>
					</ol>
				</div>
			</div>
			@yield('content')
			@include('backLayout.footer')
		</div>
	</div>
    <!-- Mainly scripts -->
 
    {{ HTML::script('assets_back/js/jquery-2.1.1.js') }}
    {{ HTML::script('assets_back/js/bootstrap.min.js') }}
    {{ HTML::script('assets_back/js/plugins/metisMenu/jquery.metisMenu.js') }}
    {{ HTML::script('assets_back/js/plugins/jeditable/jquery.jeditable.js') }}
    {{ HTML::script('assets_back/js/plugins/slimscroll/jquery.slimscroll.min.js') }}
    <!-- Peity -->
    {{ HTML::script('assets_back/js/plugins/peity/jquery.peity.min.js') }}
	{{ HTML::script('assets_back/js/demo/peity-demo.js') }}
    <!-- Custom and plugin javascript -->
    {{ HTML::script('assets_back/js/inspinia.js') }}
    {{ HTML::script('assets_back/js/plugins/pace/pace.min.js') }}
    <!-- jQuery UI -->
    {{ HTML::script('assets_back/js/plugins/jquery-ui/jquery-ui.min.js') }}
    <!-- GITTER -->
    {{ HTML::script('assets_back/js/plugins/gritter/jquery.gritter.min.js') }}
    <!-- Sparkline -->
    {{ HTML::script('assets_back/js/plugins/sparkline/jquery.sparkline.min.js') }}
    <!-- Sparkline demo data  -->
    {{ HTML::script('assets_back/js/demo/sparkline-demo.js') }}
    <!-- Toastr -->
    {{ HTML::script('assets_back/js/plugins/toastr/toastr.min.js') }}
	@yield('script')
</body>
</html>