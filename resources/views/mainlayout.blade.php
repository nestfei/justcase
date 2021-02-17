<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title','ホームページ')</title>
    <link rel="stylesheet" href="{{ asset("css/ress.css") }}">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>
<body>
<div>

<!--header-->
@include('common.header')

<!--main contents-->
@yield('contents')

<!--footer-->
@include('common.footer')
</div>
<!--javascript-->
@section('js')
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset("js/app.js") }}"></script>
@show
</body>
</html>
