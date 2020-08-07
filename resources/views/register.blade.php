<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>新規登録</title>
    </head>
    <body>
			@include('common.validator')
			<form method="post" action="{{url('registerDao')}}">
				{{csrf_field()}}
				メールアドレス：<input type="text" name="Member[email]" value="{{old('Member.email')}}"><br>
				氏名：<input type="text" name="Member[name1]" placeholder="姓" value="{{old('Member.name1')}}"><input type="text" name="Member[name2]" placeholder="名" value="{{old('Member.name2')}}"><br>
				氏名（フリガナ）：<input type="text" name="Member[name3]" placeholder="セイ" value="{{old('Member.name3')}}"><input type="text" name="Member[name4]" placeholder="メイ" value="{{old('Member.name4')}}"><br>
				パスワード：<input type="password" name="Member[password]"><br>
				パスワード（再入力）：<input type="password" name="comfirmpwd"><br>
			<input type="submit" value="登録">
		</form>
    </body>
</html>
