@extends('mainlayout')

@section('title','登録情報確認')

@section('contents')
	メールアドレス {{$email}}<br>
	お名前 {{$last}}　{{$firstname}}<br>
	フリガナ {{$lastname_huri}}　{{$firstname_huri}}<br>
	性別 {{$gender_arr[$gender]}}<br>
	生年月日 {{$birth_str}}<br>
	郵便番号 {{$post}}<br>
	都道府県 {{$prefecture}}<br>
	市町村 {{$town}}<br>
	以降の住所 {{$address}}<br>
	電話番号 {{$phone}}<br>
	
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
			<input type="submit" value="戻る">
	</form>
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
			<input type="submit" value="登録">
	</form>
@endsection