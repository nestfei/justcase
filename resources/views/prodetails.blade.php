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
	@if($productInfo[0]->store>0)
	在庫あり
	@else
	在庫なし
	@endif
	<!--お気に入りボタン-->
	<button class='wish'>{{$button}}</button>
	<!--買い物カートボタン-->
	<button class='cart'>カートに入れる</button>
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
		<!--お気に入りajax-->
    <script type="text/javascript">
			@if(!isset($_COOKIE['uid_cookie']))
			/*ログインしていないとログインページにとぶ*/
					$('.wish').on('click',function(){
						location.href="{{url('loginPage')}}";
					});
			@else
			/*ログインしている*/
				var btnText=$('.wish').text();
        $('.wish').on('click',function () {
            var pid = {{$productInfo[0]->id}};
						if(btnText=="お気に入りに追加する"){/*お気に入りに追加*/
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('.wish').text('お気に入りに追加済');/*←お気に入りに追加した後の状態*/
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
						}else{/*お気に入りから削除*/
							$.ajax({
									type:'POST',
									url:'{{url('removeWish')}}',
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('.wish').text('お気に入りに追加する');/*←お気に入りに追加した後の状態*/
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

		<!--買い物カートajax-->
		<script type="text/javascript">
			@if(!isset($_COOKIE['uid_cookie']))
			/*ログインしていないとログインページにとぶ*/
					$('.cart').on('click',function(){
						location.href="{{url('loginPage')}}";
					});
			@else
			/*ログインしている*/
			/*買い物カートに追加するajax*/
        $('.cart').on('click',function () {
            var pid = {{$productInfo[0]->id}};
								$.ajax({
									type:'POST',
									url:'{{url('addCart')}}',
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											alert(data.msg);
									},
									error:function (xhr,status,error) {
											console.log(xhr);
											console.log(status);
											console.log(error);
									}
							});
        });
			@endif
		</script>
@endsection