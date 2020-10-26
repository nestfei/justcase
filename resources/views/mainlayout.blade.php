<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title','ホームページ')</title> 
	<!--一時的なstyle-->
	<style>
		img{
			height: 150px;
		}
		.search{
			display: inline;
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
<!--javascript-->
@section('js')
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@show
</body>
</html>
