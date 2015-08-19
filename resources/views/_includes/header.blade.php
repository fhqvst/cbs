<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CBSx</title>

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

</head>
<body>

<div class="background"></div>

<div id="site">

<div class="colors">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<header class="topbar">

    <div class="container">
        <div class="row">

            <div class="topbar__logotype">
                <h1 class="logotype">CBSx</h1>
            </div>
            <div class="topbar__navigation">
                <nav>
                    @if(Auth::check())
                        <a href="/">Hem</a>
                        <a href="/market">Marknaden</a>
                        <a href="/account">Konto</a>
                        <a href="/logout">Logga ut</a>
                    @else
                        <a href="/register">Registrera</a>
                        <a href="/login">Logga in</a>
                    @endif
                </nav>
            </div>

        </div>
    </div>

</header>
<div class="subnav">

</div>
