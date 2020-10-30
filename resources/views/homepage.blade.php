@extends('mainlayout')

@section('title','ホームページ')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')

<!--スライドショー-->
@include('common.slider')

<!--カテゴリー-->
@include('common.category')

<!--全ての商品-->
@foreach($productsInfo as $value)
	@include('common.products')
@endforeach

@endsection
@section('js')
	@parent
    <script type="text/javascript">
			@if(!isset($_COOKIE['uid_cookie']))
			/*ログインしていない*/
					$('.wish').on("click",function(){
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