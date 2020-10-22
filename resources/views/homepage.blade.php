@extends('mainlayout')

@section('title','ホームページ')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')

<!--スライドショー-->
@include('common.slider')

<!--カテゴリー-->
@include('common.category')

<!--全ての商品-->
@foreach($productsInfo as $value)
<div><!--商品div-->
	<!--プレビュー画像-->
	<a href="{{url('proDetails',['products_id'=>$value->id])}}"><img src="{{asset($value->previewfile)}}"></a>
	<a href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}
	{{$value->price}}</a>
</div>
@endforeach

@endsection