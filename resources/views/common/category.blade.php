<form method="post" action="{{url('searchCheck')}}">
	{{csrf_field()}}
	<!--デザインカテゴリー-->
	@foreach($descateIdArray as $value)
		<input type="radio" name="desId" value="{{$value}}" checked="checked"><a href="{{url('categoryDesPage',['cateNo'=>$value])}}">
			{{$descateNameArray[$value]}}</a>
	@endforeach
	<br>
	<!--機種カテゴリー-->
	@foreach($cateIdArray as $parent=>$value)
		<!--親機種　例：iPhone-->
		<a href="{{url('categoryPage',['cateNo'=>$parent])}}">{{$cateNameArray[$parent]}}</a><br>
		@foreach($value as $son)
			<!--子機種 例：iPhone8,iPhoneX......-->
		<input type="radio" name="proNo" value="{{$son}}" checked="checked"><a href="{{url('categoryPage',['cateNo'=>$son])}}">{{$cateNameArray[$son]}}</a>
		@endforeach
	<br>
	@endforeach
	<input type="submit" value="絞り込み検索">
</form>