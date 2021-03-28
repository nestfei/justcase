@extends('mainlayout')

@section('title','全ての商品')

@section('lastname',$lastname)
<!--{{--@section('uid',$uid)--}}-->

@section('contents')

<!--商品-->
<h1 class="Contents-title">全ての商品</h1>
<div class="Result">
  <div class="Result__products">
  @foreach($productsInfo as $value)
	@include('common.products')
  @endforeach
  </div>
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