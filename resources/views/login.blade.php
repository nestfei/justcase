@extends('mainlayout')

@section('title','ログイン')

@section('contents')
	@include('common.validator')
	{{session('login_error')}}
	<form method="post" action="{{url('loginDao')}}">
			{{csrf_field()}}
			メールアドレス：<input type="text" name="email" value="{{old('email')}}"><br>
			パスワード：<input type="password" name="password"><br>
			<input type="checkbox" name="auto_login" value="1" id="check">
			<label for="check"> 次回から自動ログインする</label><br>
			<input type="submit" value="ログイン">
	</form>
@endsection

