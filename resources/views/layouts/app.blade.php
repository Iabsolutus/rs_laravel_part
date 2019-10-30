<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0", false);
header("Cache-Control: max-age=0", false);
header("Pragma: no-cache");
?>



<!DOCTYPE html>
<html lang="ru">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>RS</title>

    <!-- Bootstrap core CSS -->
    {{--<link href="/assets/css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<!-- Custom styles for this template -->--}}
    {{--<link rel="stylesheet" href="/assets/css/all.css" type="text/css">--}}
    {{--<link href="/assets/css/navbar-fixed-top.css" rel="stylesheet">--}}
    {{--<link href="/assets/css/style.css" rel="stylesheet">--}}
    <link href="/css/all.css" rel="stylesheet">


    <script type="text/javascript" src="/assets/js/jquery-3.0.0.min.js"></script>
    {{--<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>--}}
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/map.js" type="text/javascript"></script>
    {{--<script src="/js/all.js" type="text/javascript"></script>--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

@yield('menu')

@yield('content')


</body>
</html>