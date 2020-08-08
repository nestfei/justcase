<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>新規登録</title>
    </head>
    <body>
			@include('common.validator')
			{{session('email_existed')}}
			<form method="post" action="{{url('registerDao')}}">
				{{csrf_field()}}
				メールアドレス：<input type="text" name="Member[email]" value="{{old('Member.email')}}"><br>
				氏名：<input type="text" name="Member[lastname]" placeholder="姓" value="{{old('Member.lastname')}}"><input type="text" name="Member[firstname]" placeholder="名" value="{{old('Member.firstname')}}"><br>
				氏名（フリガナ）：<input type="text" name="Member[lastname_huri]" placeholder="セイ" value="{{old('Member.lastname_huri')}}"><input type="text" name="Member[firstname_huri]" placeholder="メイ" value="{{old('Member.firstname_huri')}}"><br>
				パスワード：<input type="password" name="Member[password]"><br>
				パスワード（再入力）：<input type="password" name="comfirmpwd"><br>
			<input type="submit" value="登録">
		</form>
    </body>
</html>
