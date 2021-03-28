@extends('mainlayout')

@section('title','result')

@section('lastname',$lastname)

@section('contents')
<div class="Result">
  <div class="Bread-list">
    <a class="Bread-list__link" href="{{url('homePage')}}">TOP</a>
    >
    @if(isset($cateNo))
      <!--親機種-->
      @foreach($cateIdArray as $key=>$parent)
        @foreach($parent as $son)
          @if($son==$cateNo)
            <a　class="Bread-list__link" href="{{url('categoryPage',['cateNo'=>$key])}}">
              {{$cateNameArray[$key]}}</a>
              >
          @break
          @endif
        @endforeach
      @endforeach
      <!--機種-->
      <span class="Bread-list__link">{{$cateNameArray[$cateNo]}}</span>
    @elseif(isset($desCateNo))
      <!--デザイン-->
      <span class="Bread-list__link">{{$descateNameArray[$desCateNo]}}</span>
    @elseif(isset($input))
      <!--検査した言葉-->
      <span class="Bread-list__link">"{{$input}}"の検索結果</span>
    @endif
    </div>
    <!--検索した言葉-->
    @if(isset($input))
    <h1 class="Result__title">"{{$input}}"の検索結果</h1>
    @endif

    <!--商品-->
    <div class="Result__products">
      @foreach($cateproducts as $value)
        @include('common.products', ["class" => "result"])
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