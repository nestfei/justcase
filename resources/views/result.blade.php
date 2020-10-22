@extends('mainlayout')

@section('title','カテゴリー')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')

<!--スライドショー-->
@include('common.slider')

<!--カテゴリー-->
@include('common.category')

<!--商品-->
@foreach($cateproducts as $value)
<div><!--商品div-->
	<!--プレビュー画像-->
	<a href="{{url('proDetails',['products_id'=>$value->id])}}"><img src="{{asset($value->previewfile)}}"></a>
	<a href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}
	{{$value->price}}</a>
	<?php
	/*$descateIds=explode(",",$value->descategory_ids);
	foreach($descateIds as $descateId){
		echo $descateNameArray[$descateId]." ";
	}*/
	?>
</div>
@endforeach

@endsection