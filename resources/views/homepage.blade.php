@extends('mainlayout')

@section('title','ホームページ')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')
<!--スライドショーの画像-->
<img src="{{asset($sliderInfo[0][0])}}" alt="">
<img src="{{asset($sliderInfo[1][0])}}" alt="">
<img src="{{asset($sliderInfo[2][0])}}" alt="">

<!--全ての商品-->
@foreach($productsInfo as $value)
<div>
	<!--プレビュー画像-->
	<img src="{{asset($value->previewfile)}}">
	{{$value->name}}
	{{$value->price}}
	<?php
	$descateIdArr=explode(",",$value->descategory_ids);
	foreach($descateIdArr as $descateId){
		echo $descateArray[$descateId-1]." ";
	}
	?>
</div>
@endforeach

@endsection