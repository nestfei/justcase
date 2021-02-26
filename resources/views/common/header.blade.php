<header class="Header">
  <div class="Logo Header__logo">
    <a class="Logo__link" href="{{url('homePage')}}">
      <img class="Logo__img" src="{{ asset("images/logo.svg") }}" alt="Just case">
    </a>
  </div>
  <nav class="Header__nav">
    <div class="Site-links">
      <a class="Site-links__link" id="search_products_open">商品一覧</a>
      <a class="Site-links__link" href="#">このサイトについて</a>
      <a class="Site-links__link" href="#">お問い合わせ</a>
    </div>
    <!--カテゴリー-->
    @include('common.category')
  </nav>
  <!--検索欄-->
  <form class="Search Header__search" action="{{url('searchProducts')}}" method="post">
    {{csrf_field()}}
    <input class="Search__input" type="text" name="search" value="{{old('search')}}" placeholder="キーワードを入力してください">
  </form>
  <ul class="Personal-nav">
    <li class="Personal-nav__item--auth" id="js-toggle-auth">
      <img class="Personal-nav__img" src="{{ asset("images/icons/user_icon.svg") }}" alt="認証">
      <div class="Personal-nav__auth">
        @if(isset($_COOKIE['lastname_cookie']))
        <!--ログイン中-->
        <!--マイページリンク-->
        <a class="Personal-nav__link" href="{{url('myPage')}}">マイページ</a>
        <!--ログアウトボタン-->
        <a class="Personal-nav__link" href="{{url('logout')}}">ログアウト</a>
        @else
        <!--ログインしていない場合-->
        <a class="Personal-nav__link" href="{{url('loginPage')}}">ログイン</a>
        <a class="Personal-nav__link" href="{{url('registerPage')}}">新規登録</a>
        @endif
      </div>
    </li>
    <li class="Personal-nav__item">
      <!--買い物カートリンク-->
      <a href="{{url('wishPage')}}">
        <img class="Personal-nav__img" src="{{ asset("images/icons/favorite.svg")}}" alt="お気に入り">
      </a>
    </li>
    <li class="Personal-nav__item">
      <!--お気に入りリンク-->
      <a href="{{url('cartPage')}}">
        <img class="Personal-nav__img" src="{{ asset("images/icons/cart.svg")}}" alt="カートへ">
      </a>
    </li>
  </ul>

</header>