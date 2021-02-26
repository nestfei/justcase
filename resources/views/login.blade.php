@extends('mainlayout')

@section('title','ログイン')

@section('contents')
<div class="Login">
  <h1 class="Contents-title">ログイン</h1>
  @include('common.validator')
	{{session('login_error')}}
	<form class="Login__form" method="post" action="{{url('loginDao')}}">
    <h2 class="Login__title">会員登録をお済の方はこちらからログインしてください。</h2>
    <p class="Login__suggest">※アカウントをお持ちでない方は下部の新規登録ボタンからお進みください</p>
		{{csrf_field()}}
		<div class="Login__inner-wrapper">
      <label for="">メールアドレス</label>
      <input class="Login__input" type="text" name="email" value="{{old('email')}}">
    </div>
    <div class="Login__inner-wrapper">
      <label for="">パスワード</label>
      <input class="Login__input" type="password" name="password">
    </div>
		<input type="checkbox" name="auto_login" value="1" id="check">
		<label for="check">ログイン状態を保存する</label>
		<input class="Button Button--red Login__button" type="submit" value="ログイン">
    <p class="Login__suggest">※アカウントをお持ちでない方はこちらからご登録ください</p>
    <a class="Button Button--red Login__button" href="{{url('registerPage')}}">新規登録</a>
	</form>
  <a class="Button Button--red Login__button" href="{{url('homePage')}}">TOPへ戻る</a>
</div>
@endsection

