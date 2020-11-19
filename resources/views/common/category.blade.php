<br>
<!--デザインカテゴリー-->
@foreach($descateIdArray as $value)
	<a href="{{url('categoryDesPage',['cateNo'=>$value])}}">
		{{$descateNameArray[$value]}}</a>
@endforeach
<br>
<!--機種カテゴリー-->
@foreach($cateIdArray as $parent=>$value)
	<!--親機種　例：iPhone-->
	<a href="{{url('categoryPage',['cateNo'=>$parent])}}">{{$cateNameArray[$parent]}}</a><br>
	@foreach($value as $son)
		<!--子機種 例：iPhone8,iPhoneX......-->
		<a href="{{url('categoryPage',['cateNo'=>$son])}}">{{$cateNameArray[$son]}}</a>
	@endforeach
<br>
@endforeach