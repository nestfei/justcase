@extends('mainlayout')

@section('title','ホームページ')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->
<img src="{{asset($sliderInfo[0][0])}}" alt="">
<img src="{{asset($sliderInfo[1][0])}}" alt="">
<img src="{{asset($sliderInfo[2][0])}}" alt="">

@section('contents')

@endsection