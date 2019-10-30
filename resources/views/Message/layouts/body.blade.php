<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $route_name }}</title>
    <link href="{{ asset('css/Message/body.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="body">
<div class="navigation">
    @yield('navigation')
</div>
<div class="content">
    @yield('content')
</div>
</div>
</body>
</html>