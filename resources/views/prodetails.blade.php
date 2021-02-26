@extends('mainlayout')

@section('title','商品詳細ページ')

@section('lastname',$lastname)

@section('contents')
<div class="Product-detail">
  <div class="Bread-list">
    <!--パンくず-->
  <a class="Bread-list__link" href="{{url('homePage')}}">TOP</a>
  ><!--親機種-->
  @foreach($cateIdArray as $key=>$parent)
  @foreach($parent as $son)
  @if($son==$proCate[0]->category_no)
  <a class="Bread-list__link" href="{{url('categoryPage',['cateNo'=>$key])}}">
    {{$cateNameArray[$key]}}
  </a>
  @break
  @endif
	@endforeach
  @endforeach
  ><!--機種-->
  <a class="Bread-list__link" href="{{url('categoryPage',['cateNo'=>$proCate[0]->category_no])}}">
  {{$proCate[0]->name}}</a>
  ><!--商品名-->
  <span class="Bread-list__link">{{$productInfo[0]->name}}</span>
  </div>

<div class="Product-detail__main">
  <!--商品詳細情報-->
	<!--詳細画像-->
  <div class="Product-detail__images">
	<div class="swiper-container slider">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="{{asset($productInfo[0]->previewfile)}}">
      </div>
      <div class="swiper-slide">
        <img src="{{asset($alldetails[0]->thumb01file)}}">
      </div>
      <div class="swiper-slide">
        <img src="{{asset($alldetails[0]->thumb02file)}}">
      </div>
      <div class="swiper-slide">
        <img src="{{asset($alldetails[0]->thumb03file)}}">
      </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  <div class="swiper-container slider-thumbnail">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="{{asset($productInfo[0]->previewfile)}}">
        </div>
        <div class="swiper-slide">
          <img src="{{asset($alldetails[0]->thumb01file)}}">
        </div>
        <div class="swiper-slide">
          <img src="{{asset($alldetails[0]->thumb02file)}}">
        </div>
        <div class="swiper-slide">
          <img src="{{asset($alldetails[0]->thumb03file)}}">
        </div>
    </div>
  </div>
</div>
	<div class="Product-detail__data">
    <!--商品名-->
    <h1 class="Product-detail__name">{{$productInfo[0]->name}}</h1>
    <!--機種-->
    <a class="Product-detail__model-name" href="{{url('categoryPage',['cateNo'=>$proCate[0]->category_no])}}">
      {{$proCate[0]->name}}
    </a>
    <!--値段-->
    <p class="Product-detail__price">&yen;{{$productInfo[0]->price}}</p>
    <!--タグ-->
    <div class="Product-detail__tag">
      @foreach($descateIds as $value)
      <a href="{{url('categoryDesPage',['cateNo'=>$value])}}">
        {{$descateNameArray[$value]}}
      </a>
      @endforeach
    </div>
    <!--在庫-->
    <p class="Product-detail__stock">
      @if($productInfo[0]->store>0)
        在庫あり
      @else
        在庫なし
      @endif
    </p>
    <!--買い物カートボタン-->
    <button class='Product-detail__cart'>カートに入れる</button>
    <!--お気に入りボタン-->
    <button class='Product-detail__wish'>{{$button}}</button>
  </div>
</div>
  <p class="Product-detail__precautions">
    ※一度キャンセルされましたご注文は後から戻すことができません。あらかじめご了承ください。<br>
    なお、商品によりましては在庫切れにより、同一商品（限定商品、特典付商品など）の再注文ができない場合がございます。
  </p>
  <p class="Product-detail__precautions">
    ※上記条件内でもご注文確定後にキャンセルができない商品が一部ございます。<br>
    商品詳細をよくご確認のうえご注文をお願いいたします。
  </p>
	<div class="Product-detail__suggest">
    <!--おすすめ-->
    <h2>その他関連商品</h2>
    @foreach($similar as $value)
    <a href="{{url('proDetails',['products_id'=>$value->id])}}">
      <img src="{{asset($value->previewfile)}}"></a>
    @endforeach
  </div>
</div>
@endsection

@section('js')
	@parent
		<!--お気に入りajax-->
    <script type="text/javascript">
			@if(!isset($_COOKIE['uid_cookie']))
			/*ログインしていないとログインページにとぶ*/
					$('.Product-detail__wish').on('click',function(){
						location.href="{{url('loginPage')}}";
					});
			@else
			/*ログインしている*/
				var btnText=$('.Product-detail__wish').text();
        $('.Product-detail__wish').on('click',function () {
            var pid = {{$productInfo[0]->id}};
						if(btnText=="お気に入りに追加する"){/*お気に入りに追加*/
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('.Product-detail__wish').text('お気に入りに追加済');/*←お気に入りに追加した後の状態*/
													btnText=$('.Product-detail__wish').text()
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
													$('.Product-detail__wish').text('お気に入りに追加する');/*←お気に入りに追加した後の状態*/
													btnText=$('.Product-detail__wish').text()
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
					$('.Product-detail__cart').on('click',function(){
						location.href="{{url('loginPage')}}";
					});
			@else
			/*ログインしている*/
			/*買い物カートに追加するajax*/
        $('.Product-detail__cart').on('click',function () {
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
    <script>
      //サムネイル
var sliderThumbnail = new Swiper('.slider-thumbnail', {
  slidesPerView: 4,
  freeMode: true,
  watchSlidesVisibility: true,
  watchSlidesProgress: true,
});

//スライダー
var slider = new Swiper('.slider', {
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  thumbs: {
    swiper: sliderThumbnail
  }
});
    </script>
@endsection