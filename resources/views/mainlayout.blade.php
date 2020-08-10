<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title','ホームページ')</title>   
</head>
<body>
<div>
<!--header-->
<!--@include('common.header')-->

<!--main contents-->
@yield('contents')

<!--footer-->
@include('common.footer')
</div>

</body>
</html>
