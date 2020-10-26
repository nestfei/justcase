<div>
<a href="{{url('homePage')}}">JUST CASE</a>
@if(isset($_COOKIE['lastname_cookie']))
	<!--ログイン中-->
	<!--マイページリンク-->
	ようこそ<a href="#">@yield('lastname','ゲスト')さん</a>
	<!--気に入りリンク-->
	<a href="{{url('wishPage')}}">お気に入り</a>
@else
	<!--ログインしていない-->
	ようこそゲストさん
	<a href="{{url('loginPage')}}">ログイン</a>
	<a href="{{url('registerPage')}}">新規登録</a>
@endif
<!--検索欄-->
<form action="{{url('searchProducts')}}" method="post" class="search">
	{{csrf_field()}}
	<input type="text" name="search" value="{{old('search')}}">
	<input type="submit" value="検索">
</form>

</div>