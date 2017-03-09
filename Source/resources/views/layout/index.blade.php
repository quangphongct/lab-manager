<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{asset('/')}}">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/my.css" rel="stylesheet">  

    
    <script src="js/my.js"></script>

</head>

<body>
	<div class="container">
	<div class="well well-sm">
    
    @include('layout.header')

    @yield('main')

    @include('layout.footer')
    </div> <!-- /well -->
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    @yield('script')

</body>

</html>

<!-- this script got from www.htmlbestcodes.com-Coded by: Krishna Eydat -->

