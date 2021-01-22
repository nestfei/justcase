<div>
<a href="{{url('homePage')}}">JUST CASE</a>
<a href="#">商品一覧</a>
@if(isset($_COOKIE['lastname_cookie']))
	<!--ログイン中-->
	<!--マイページリンク-->
	ようこそ<a href="{{url('myPage')}}">@yield('lastname','ゲスト')さん</a>
	<!--お気に入りリンク-->
	<a href="{{url('wishPage')}}">お気に入り</a>
	<!--買い物カートリンク-->
	<a href="{{url('cartPage')}}">買い物カート</a>
@else
	<!--ログインしていない場合-->
	ようこそゲストさん
	<a href="{{url('loginPage')}}">ログイン</a>
	<a href="{{url('registerPage')}}">新規登録</a>
@endif
<!--検索欄-->
<form action="{{url('searchProducts')}}" method="post" class="search">
	{{csrf_field()}}
	<input type="text" name="search" value="{{old('search')}}" placeholder="可愛い">
	<input type="submit" value="検索">
</form>

</div>