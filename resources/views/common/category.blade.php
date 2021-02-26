<form class="Search-products" method="post" action="{{url('searchCheck')}}">
	{{csrf_field()}}
	<div class="Search-products__outer-wrap">
    <div class="Search-products__inner-wrap">
      <!--デザインカテゴリー-->
      <h2 class="Search-products__title">カテゴリー別</h2>
      @foreach($descateIdArray as $value)
      <div class="Search-products__item">
        <input class="Search-products__radio" type="radio" name="desId" value="{{$value}}" checked="checked">
        <a class="Search-products__link" href="{{url('categoryDesPage',['cateNo'=>$value])}}">
          {{$descateNameArray[$value]}}
        </a>
      </div>
      @endforeach
    </div>
      <!--機種カテゴリー-->
      @foreach($cateIdArray as $parent=>$value)
      <div class="Search-products__inner-wrap">
        <!--親機種　例：iPhone-->
        <a class="Search-products__link" href="{{url('categoryPage',['cateNo'=>$parent])}}">
          <h2 class="Search-products__title">
            {{$cateNameArray[$parent]}}
          </h2>
        </a>
        @foreach($value as $son)
        <!--子機種 例：iPhone8,iPhoneX......-->
        <div class="Search-products__item">
          <input class="Search-products__radio" type="radio" name="proNo" value="{{$son}}" checked="checked">
          <a class="Search-products__link" href="{{url('categoryPage',['cateNo'=>$son])}}">
            {{$cateNameArray[$son]}}
          </a>
        </div>
        @endforeach
      </div>
      @endforeach
  </div>
  <div class="Search-products__operation">
    <button type="button" class="Search-products__close" id="search_products_close">閉じる</button>
    <input class="Button Button--red Search-products__button" type="submit" value="絞り込み検索">
  </div>
</form>