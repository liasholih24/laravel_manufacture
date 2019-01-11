<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')| Manufacturing Administrator</title>
    {{ HTML::style('assets_back/css/bootstrap.min.css') }}
    {{ HTML::style('assets_back/font-awesome/css/font-awesome.css') }}
    <!-- Toastr style -->
    {{ HTML::style('assets_back/css/plugins/toastr/toastr.min.css') }}
    <!-- Gritter -->
    {{ HTML::style('assets_back/js/plugins/gritter/jquery.gritter.css') }}
    {{ HTML::style('assets_back/css/animate.css') }}
    {{ HTML::style('assets_back/css/style.css') }}
    @yield('style')
</head>