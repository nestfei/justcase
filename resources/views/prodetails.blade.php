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
	<br>
	<!--商品名-->
	商品名：{{$productInfo[0]->name}}
	<!--機種-->
	機種：<a href="{{url('categoryPage',['cateNo'=>$proCate[0]->category_no])}}">
	{{$proCate[0]->name}}</a>
	<!--値段-->
	値段：{{$productInfo[0]->price}}円
	<!--タグ-->
	タグ：
	@foreach($descateIds as $value)
	<a href="{{url('categoryDesPage',['cateNo'=>$value])}}">
	{{$descateNameArray[$value]}}</a>
	@endforeach
	<!--在庫-->
	在庫：{{$productInfo[0]->store}}
	<button class='wish'>{{$button}}</button>
	<br>
	この商品に似てるやつ
	@foreach($similar as $value)
	<a href="{{url('proDetails',['products_id'=>$value->id])}}">
	<img src="{{asset($value->previewfile)}}"></a>
	@endforeach

<!--お気に入りに追加ajax-->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
				var btnText=$('.wish').text();
        $('.wish').on("click",function () {
            var pid = {{$productInfo[0]->id}};
						if(btnText=="お気に入り"){
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('.wish').text(data.msg);
													btnText=$('.wish').text()
											}
											if(data.status==1){
													alert(data.msg);
											}
									},
									error:function (xhr,status,error) {
											console.log(xhr);
											console.log(status);
											console.log(error);
									}
							});
						}else{
							$.ajax({
									type:'POST',
									url:'{{url('removeWish')}}',
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('.wish').text(data.msg);
													btnText=$('.wish').text()
											}
											if(data.status==1){
													alert(data.msg);
											}
									},
									error:function (xhr,status,error) {
											console.log(xhr);
											console.log(status);
											console.log(error);
									}
							});
						}
        });
		</script>

@endsection