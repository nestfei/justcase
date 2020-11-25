@extends('mainlayout')

@section('title','注文完了')

@section('lastname',$lastname)

@section('contents')
	<h1>購入が確定しました</h1>
	<a href="{{url('cartPage')}}">ショッピングカートに戻る</a>

@endsection