@extends('mainlayout')

@section('title','商品詳細ページ')

@section('lastname',$lastname)

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
	<!--お気に入りボタン-->
	<button class='wish'>{{$button}}</button>
	<br>
	<!--おすすめ-->
	この商品に似てるやつ
	@foreach($similar as $value)
	<a href="{{url('proDetails',['products_id'=>$value->id])}}">
	<img src="{{asset($value->previewfile)}}"></a>
	@endforeach
@endsection

@section('js')
	@parent
    <script type="text/javascript">
			@if(!isset($_COOKIE['uid_cookie']))
			/*ログインしていない*/
					$('.wish').text('♥ログインしてください');
					$('.wish').on("click",function(){
						location.href="{{url('loginPage')}}";
					});
			@else
			/*ログインしている*/
			/*お気に入りに追加するajax*/
				var btnText=$('.wish').text();
        $('.wish').on("click",function () {
            var pid = {{$productInfo[0]->id}};
						if(btnText=="お気に入り"){
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',/*追加*/
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('.wish').text(data.msg);/*←お気に入りに追加したあとの状態*/
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
									url:'{{url('removeWish')}}',/*削除*/
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('.wish').text(data.msg);/*←お気に入りに追加したあとの状態*/
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
			@endif
		</script>
@endsection