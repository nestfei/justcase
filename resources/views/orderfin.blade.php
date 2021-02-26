@extends('mainlayout')

@section('title','注文完了')

@section('lastname',$lastname)

@section('contents')
	<div class="Order-finish">
    <h1 class="Contents-title">完了</h1>
    <div class="Order-finish__inner-wrapper">
      <p>購入が確定しました</p>
      <a class="Button Button--red" href="{{url('cartPage')}}">ショッピングカートに戻る</a>
    </div>
  </div>

@endsection