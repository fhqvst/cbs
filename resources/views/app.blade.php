<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php #TODO: Add title ?> </title>

    <!-- bower:css -->
    <link rel='stylesheet' href='/bower_components/ionicons/css/ionicons.css' />
    <!-- endbower -->

    <!-- CSS -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- JS -->

    <!-- Fonts -->
	{{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
		<!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
	<![endif]-->

    <!-- bower:js -->
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/smoothstate/src/jquery.smoothState.js"></script>
    <script src="/bower_components/pace/pace.js"></script>
    <!-- endbower -->
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script src="{{ asset('/js/highstock.js') }}"></script>
    <script src="{{ asset('/js/bundle.js') }}"></script>
    <script src="{{ asset('/js/all.js') }}"></script>

    @if ( Config::get('app.debug') )
        <script type="text/javascript">
            document.write('<script src="//localhost:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
        </script>
    @endif

</head>
<body>

    <div class="background"></div>

    <div id="site">


        @include('header')

        @yield('content')

        @include('footer')

        @include('modal')

    </div>



</body>
</html>
