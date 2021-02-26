@extends('mainlayout')

@section('title','登録情報確認')

@section('contents')
<div class="Register-confirm">
  <h1 class="Contents-title">登録内容確認</h1>
  <ul class="Register-confirm__list">
    <li class="Register-confirm__label">メールアドレス</li>
    <li class="Register-confirm__item">{{$email}}</li>
    <li class="Register-confirm__label">お名前</li>
    <li class="Register-confirm__item">{{$last}}　{{$firstname}}</li>
    <li class="Register-confirm__label">フリガナ</li>
    <li class="Register-confirm__item">{{$lastname_huri}}　{{$firstname_huri}}</li>
    <li class="Register-confirm__label">性別</li>
    <li class="Register-confirm__item">{{$gender_arr[$gender]}}</li>
    <li class="Register-confirm__label">生年月日</li>
    <li class="Register-confirm__item">{{$birth_str}}</li>
    <li class="Register-confirm__label">郵便番号</li>
    <li class="Register-confirm__item">{{$post}}</li>
    <li class="Register-confirm__label">都道府県</li>
    <li class="Register-confirm__item">{{$prefecture}}</li>
    <li class="Register-confirm__label">市町村</li>
    <li class="Register-confirm__item">{{$town}}</li>
    <li class="Register-confirm__label">以降の住所</li>
    <li class="Register-confirm__item">{{$address}}</li>
    <li class="Register-confirm__label">電話番号</li>
    <li class="Register-confirm__item">{{$phone}}</li>
  </ul>
	<form method="post" action="{{url('registerDao')}}">
			{{csrf_field()}}
			<input type="hidden" name="Member[email]" value="{{$email}}">
			<input type="hidden" name="Member[lastname]" value="{{$last}}">
			<input type="hidden" name="Member[firstname]" value="{{$firstname}}">
			<input type="hidden" name="Member[lastname_huri]" value="{{$lastname_huri}}">
			<input type="hidden" name="Member[firstname_huri]" value="{{$firstname_huri}}">
			<input type="hidden" name="Member[password]" value="{{$password}}">
			<input type="hidden" name="Member[gender]" value="{{$gender}}">
			<input type="hidden" name="Birth" value="{{$birth_str}}">
			<input type="hidden" name="Member[post]" value="{{$post}}">
			<input type="hidden" name="Member[prefecture]" value="{{$prefecture}}">
			<input type="hidden" name="Member[town]" value="{{$town}}">
			<input type="hidden" name="Member[address]" value="{{$address}}">
			<input type="hidden" name="Member[phone]" value="{{$phone}}">
			<input class="Button Button-red Register-confirm__button" type="submit" value="登録">
	</form>
  <form method="post" action="{{url('registerPageBack')}}">
    {{csrf_field()}}
    <input type="hidden" name="Member[email]" value="{{$email}}">
    <input type="hidden" name="Member[lastname]" value="{{$last}}">
    <input type="hidden" name="Member[firstname]" value="{{$firstname}}">
    <input type="hidden" name="Member[lastname_huri]" value="{{$lastname_huri}}">
    <input type="hidden" name="Member[firstname_huri]" value="{{$firstname_huri}}">
    <input type="hidden" name="Member[gender]" value="{{$gender}}">
    <input type="hidden" name="Birth[y]" value="{{$birth_y}}">
    <input type="hidden" name="Birth[m]" value="{{$birth_m}}">
    <input type="hidden" name="Birth[d]" value="{{$birth_d}}">
    <input type="hidden" name="Member[post]" value="{{$post}}">
    <input type="hidden" name="Member[prefecture]" value="{{$prefecture}}">
    <input type="hidden" name="Member[town]" value="{{$town}}">
    <input type="hidden" name="Member[address]" value="{{$address}}">
    <input type="hidden" name="Member[phone]" value="{{$phone}}">
    <input class="Button Button-red Register-confirm__button Register-confirm__button--back" type="submit" value="戻る">
</form>
</div>
@endsection