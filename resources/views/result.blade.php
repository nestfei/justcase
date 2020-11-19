@extends('mainlayout')

@section('title','result')

@section('lastname',$lastname)

@section('contents')

<!--スライドショー-->
<!--{{--@include('common.slider')--}}-->

<!--カテゴリー-->
<!--{{--@include('common.category')--}}-->

<!--パンくず-->
<a href="{{url('homePage')}}">TOP</a>
>
@if(isset($cateNo))
	<!--親機種-->
	@foreach($cateIdArray as $key=>$parent)
		@foreach($parent as $son)
			@if($son==$cateNo)
				<a href="{{url('categoryPage',['cateNo'=>$key])}}">
					{{$cateNameArray[$key]}}</a>
					>
			@break
			@endif
		@endforeach
	@endforeach
	<!--機種-->
	{{$cateNameArray[$cateNo]}}
@elseif(isset($desCateNo))
	<!--デザイン-->
	{{$descateNameArray[$desCateNo]}}
@elseif(isset($input))
	<!--検査した言葉-->
	"{{$input}}"の検索結果
@endif

<!--検索した言葉-->
@if(isset($input))
	<h1>"{{$input}}"の検索結果</h1>
@endif

<!--商品-->
	@foreach($cateproducts as $value)
		@include('common.products')
	@endforeach

@endsection
@section('js')
	@parent
    <script type="text/javascript">
			@if(!isset($_COOKIE['uid_cookie']))
			/*ログインしていない*/
					$('.wish').on("click",function() {
						location.href="{{url('loginPage')}}";
					});
			@else
			/*ログインしている*/
			/*お気に入りに追加するajax*/
        $('.wish').on("click",function () {
            var pid=$(this).attr('id');
						var isWish=$(this).find('span').attr('class');
						if(isWish=="notwish"){
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',/*追加*/
									data:{pid:pid,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$("#"+pid).find('span').text("♥");/*←お気に入りに追加したあとの状態*/
													$("#"+pid).find('span').attr('class','wished');
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
													$("#"+pid).find('span').text("ハートの枠");/*←お気に入りから削除したあとの状態*/
													$("#"+pid).find('span').attr('class','notwish');
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