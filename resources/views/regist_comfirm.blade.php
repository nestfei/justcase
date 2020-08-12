@extends('mainlayout')

@section('title','登録情報確認')

@section('contents')
	メールアドレス：{{$email}}<br>
	氏名：{{$last}}　{{$firstname}}<br>
	氏名（フリガナ）：{{$lastname_huri}}　{{$firstname_huri}}<br>
	<form method="post" action="{{url('registerPageBack')}}">
			{{csrf_field()}}
			<input type="hidden" name="Member[email]" value="{{$email}}">
			<input type="hidden" name="Member[lastname]" value="{{$last}}">
			<input type="hidden" name="Member[firstname]" value="{{$firstname}}">
			<input type="hidden" name="Member[lastname_huri]" value="{{$lastname_huri}}">
			<input type="hidden" name="Member[firstname_huri]" value="{{$firstname_huri}}">
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
			<input type="submit" value="登録">
	</form>
@endsection