<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title','ホームページ')</title> 
	<!--一時的なstyle-->
	<style>
		img{
			height: 100px;
		}
	</style>
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
