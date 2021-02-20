@extends('mainlayout')

@section('title','ホームページ')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')

<div class="Main-visual">
  <img class="Main-visual__img" src="{{ asset("images/main_visual.png") }}" alt="">
</div>

<h1 class="Title">OUR BRAND</h1>
<div class="Brands">
  <div class="Brands__img-wrap">
    <a class="Brands__link" href="">
      <img class="Brands__img" src="{{ asset("images/icons/iphone.svg") }}" alt="iphone">
    </a>
    <a class="Brands__link" href="">
      <img class="Brands__img" src="{{ asset("images/icons/galaxy.svg") }}" alt="galaxy">
    </a>
    <a class="Brands__link" href="">
      <img class="Brands__img" src="{{ asset("images/icons/xperia.svg") }}" alt="xperia">
    </a>
    <a class="Brands__link" href="">
      <img class="Brands__img" src="{{ asset("images/icons/huawei.svg") }}" alt="huawei">
    </a>
  </div>
</div>

<div class="Categories">
  <h1 class="Title Categories__title">CATEGORY</h1>
</div>

<!--スライドショー-->
{{-- @include('common.slider') --}}

<!--商品-->
<h1>RANKING</h1>
{{-- @foreach($topInfo as $value)
	@include('common.products')
@endforeach --}}

<h1 class="Title">NEW ARRIVE</h1>
<div class="New-arrive">
  @foreach($productsInfo as $value)
	@include('common.products', ["class" => "new"])
  @endforeach
  <a class="New-arrive__more" href="">read more →</a>
</div>

@endsection
@section('js')
	@parent
    <script type="text/javascript">
			@if(!isset($_COOKIE['uid_cookie']))
			/*ログインしていない*/
					$('.Product__favorite-button').on("click",function(){
						location.href="{{url('loginPage')}}";
					});
			@else
			/*ログインしている*/
			/*お気に入りに追加するajax*/
        $('.Product__favorite-button').on("click",function () {
            var pid=$(this).attr('id');
						var isWish=$(this).find('span').attr('class');
						if(isWish=="Product__no-favorite"){
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',/*追加*/
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$("#"+pid).find('span').html('<img src="{{ asset("images/icons/favorited.svg") }}" alt="お気に入り済み">');
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
													$("#"+pid).find('span').html('<img src="{{ asset("images/icons/no-favorite.svg") }}" alt="お気に入りに入れる">');/*←お気に入りから削除したあとの状態*/
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