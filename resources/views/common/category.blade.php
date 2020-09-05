<!--デザインカテゴリー-->
@foreach($descateArray as $value)
	{{$value}}
@endforeach
<br>
<!--機種カテゴリー-->
@foreach($CateArray as $parent=>$value)
	<!--親機種　例：iPhone-->
	{{$parent}}<br>
	@foreach($value as $son)
		<!--子機種 例：iPhone8,iPhoneX......-->
		{{$son}}
	@endforeach
<br>
@endforeach