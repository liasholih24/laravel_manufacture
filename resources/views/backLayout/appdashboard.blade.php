<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<body id="wrapper">
  @include('backLayout.header')
  <!-- PAGE CONTAINER -->
  <!-- BEGIN CONTAINER -->

		    <!-- Navbar -->
	         @include('backLayout.NavBar')
	      <!-- /Navbar -->

        <!-- BEGIN CONTENT -->
          <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Navbar top -->
          @include('backLayout.NavBarTop')
        <!-- End Navbar top -->
        <!-- beadcurms-->
    
        <!-- Begin Page -->
          @yield('content')
        <!-- End Page -->

  @include('backLayout.footer')

</div>
          <!-- END CONTENT -->
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
