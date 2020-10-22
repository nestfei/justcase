@extends('mainlayout')

@section('title','商品詳細ページ')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')


<!--商品詳細情報-->
	<!--詳細画像-->
	<img src="{{asset($productInfo[0]->previewfile)}}">
	<img src="{{asset($alldetails[0]->thumb01file)}}">
	<img src="{{asset($alldetails[0]->thumb02file)}}">
	<img src="{{asset($alldetails[0]->thumb03file)}}">
<!--商品名-->
	商品名：{{$productInfo[0]->name}}
	<!--機種-->
	機種：<a href="{{url('categoryPage',['cateNo'=>$proCate[0]->category_no])}}">{{$proCate[0]->name}}</a>
	<!--値段-->
	値段：{{$productInfo[0]->price}}円
	<!--タグ-->
	タグ：
	@foreach($descateIds as $value)
	<a href="{{url('categoryDesPage',['cateNo'=>$value])}}">{{$descateNameArray[$value]}}</a>
	@endforeach
	<!--在庫-->
	在庫：{{$productInfo[0]->store}}

@endsection