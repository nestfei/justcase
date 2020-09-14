@extends('mainlayout')

@section('title','カテゴリー')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')


<!--商品-->
@foreach($cateproducts as $value)
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