@extends('mainlayout')

@section('title','ホームページ')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')
<!--スライドショーの画像-->
<div>
	<img src="{{asset($sliderInfo[0][0])}}" alt="">
	<img src="{{asset($sliderInfo[1][0])}}" alt="">
	<img src="{{asset($sliderInfo[2][0])}}" alt="">
</div>
	
<!--カテゴリー-->
@include('common.category')

<!--全ての商品-->
@foreach($productsInfo as $value)
<div><!--商品div-->
	<!--プレビュー画像-->
	<img src="{{asset($value->previewfile)}}">
	{{$value->name}}
	{{$value->price}}
	<?php
	/*$descateIds=explode(",",$value->descategory_ids);
	foreach($descateIds as $descateId){
		echo $descateNameArray[$descateId]." ";
	}*/
	?>
</div>
@endforeach

@endsection