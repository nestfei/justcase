<form class="Search-products <?php if(isset($class)) echo $class ?>" method="post" action="{{url('searchCheck')}}">
	{{csrf_field()}}
	<div class="Search-products__outer-wrap">
    <div class="Search-products__inner-wrap">
      <!--デザインカテゴリー-->
      <h2 class="Search-products__title">カテゴリー別</h2>
      @foreach($descateIdArray as $value)
      <input type="radio" name="desId" value="{{$value}}" checked="checked">
      <a class="Search-products__link" href="{{url('categoryDesPage',['cateNo'=>$value])}}">
        {{$descateNameArray[$value]}}
      </a>
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
        <input type="radio" name="proNo" value="{{$son}}" checked="checked">
        <a class="Search-products__link" href="{{url('categoryPage',['cateNo'=>$son])}}">
          {{$cateNameArray[$son]}}
        </a>
        @endforeach
      </div>
      @endforeach
  </div>
	<input type="submit" value="絞り込み検索">
</form>