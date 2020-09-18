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
@include('common.header')

<!--main contents-->
@yield('contents')

<!--footer-->
@include('common.footer')
</div>

</body>
</html>
