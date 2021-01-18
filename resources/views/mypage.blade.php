@extends('mainlayout')

@section('title','マイページ')

@section('lastname',$lastname)

@section('contents')
	<h1>マイページ</h1>
	いらっしゃいませ{{$lastname}}様
	<div>
		会員情報の変更は下部のボタンからお進みください<br>
		<a href="{{url('editInfo')}}">会員情報を変更</a>
	</div>
	

@endsection