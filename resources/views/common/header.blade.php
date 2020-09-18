<a href="{{url('homePage')}}">JUST CASE</a>
@if(isset($_COOKIE['lastname_cookie']))
	ようこそ<a href="#">@yield('lastname','ゲスト')さん</a>
@else
	ようこそゲストさん
	<a href="{{url('loginPage')}}">ログイン</a>
	<a href="{{url('registerPage')}}">新規登録</a>
@endif
<form action="{{url('searchProducts')}}" method="post">
	{{csrf_field()}}
	<input type="text" name="search" value="{{old('search')}}">
	<input type="submit" value="検索">
</form>