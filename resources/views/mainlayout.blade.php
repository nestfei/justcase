<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title','ホームページ')</title>   
</head>
<body>
<div>
<!--header-->
@if(isset($_COOKIE['lastname_cookie']))
	@include('common.header_1')
@else
	@include('common.header_0')
@endif

<!--main contents-->
@yield('contents')

<!--footer-->
@include('common.footer')
</div>

</body>
</html>
