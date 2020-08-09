<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ログイン</title>
    </head>
    <body>
			@include('common.validator')
			<form method="post" action="{{url('loginDao')}}">
				{{csrf_field()}}
				メールアドレス：<input type="text" name="email" value="{{old('email')}}"><br>
				パスワード：<input type="password" name="password"><br>
				<input type="checkbox" name="auto_login" value="1" id="check">
				<label for="check"> 次回から自動ログインする</label><br>
				<input type="submit" value="ログイン">
			</form>
    </body>
</html>
