<!--エラーメッセージを表示するコンポネント-->
@if(count($errors))
<div>
	<ul>
		@foreach($errors->all() as $value)
		<li>{{$value}}</li>
		@endforeach
	</ul>
</div>
@endif