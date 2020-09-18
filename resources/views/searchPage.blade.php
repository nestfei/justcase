@extends('mainlayout')

@section('title','カテゴリー')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')

<!--カテゴリー-->
@include('common.category')

<!--商品-->
@foreach($result as $value)
<div><!--商品div-->
	<!--プレビュー画像-->
	<img src="{{asset($value->previewfile)}}">
	{{$value->name}}
	{{$value->price}}
</div>
@endforeach

@endsection