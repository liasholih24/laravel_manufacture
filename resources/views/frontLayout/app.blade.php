<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="Asset Manajemen System" name="whatisthis" />
<meta content="Lia Siti Sholihah @liastoliha" name="author" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>@yield('title')| Management of Inventory System</title>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
{{ HTML::style('assets_back/global/plugins/font-awesome/css/font-awesome.min.css') }}
{{ HTML::style('assets_back/global/plugins/simple-line-icons/simple-line-icons.min.css') }}
{{ HTML::style('assets_back/global/plugins/bootstrap/css/bootstrap.min.css') }}
{{ HTML::style('assets_back/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
{{ HTML::style('assets_back/global/plugins/select2/css/select2.min.css') }}
{{ HTML::style('assets_back/global/plugins/select2/css/select2-bootstrap.min.css') }}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
{{ HTML::style('assets_back/global/css/components.min.css') }}
{{ HTML::style('assets_back/global/css/plugins.min.css') }}
{{ HTML::style('assets_back/global/css/animate.css') }}
{{ HTML::style('assets_back/global/css/style.css') }}
<!-- END THEME GLOBAL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES
{{ HTML::style('assets_back/pages/css/login-5.min.css') }}
END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="favicon.ico" /> </head>
@yield('style')
</head>
<body class="gray-bg">
		<!-- BEGIN : LOGIN PAGE 5-2 -->
		  @yield('content')
		<!-- END : LOGIN PAGE 5-2 -->
 <!-- BEGIN CORE PLUGINS -->
{{ HTML::script('assets_back/global/plugins/jquery.min.js') }}
{{ HTML::script('assets_back/global/plugins/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('assets_back/global/plugins/js.cookie.min.js') }}
{{HTML::script('assets_back/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}
{{ HTML::script('assets_back/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}
{{ HTML::script('assets_back/global/plugins/jquery.blockui.min.js') }}
{{ HTML::script('assets_back/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
 <!-- END CORE PLUGINS -->

{{ HTML::script('assets_back/global/plugins/jquery-validation/js/jquery.validate.min.js') }}
{{ HTML::script('assets_back/global/plugins/jquery-validation/js/additional-methods.min.js') }}
{{ HTML::script('assets_back/global/plugins/select2/js/select2.full.min.js') }}
{{ HTML::script('assets_back/global/plugins/backstretch/jquery.backstretch.min.js') }}

 <!-- BEGIN THEME LAYOUT SCRIPTS -->
 {{ HTML::script('assets_back/layouts/layout/scripts/layout.min.js') }}
 {{ HTML::script('assets_back/layouts/layout/scripts/demo.min.js') }}
 {{ HTML::script('assets_back/layouts/global/scripts/quick-sidebar.min.js') }}
 <!-- END THEME LAYOUT SCRIPTS -->
@yield('script')
 </body>
