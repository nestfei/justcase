@extends('mainlayout')

@section('title','マイページ')

@section('lastname',$lastname)

@section('contents')
	<h1>マイページ</h1>
	いらっしゃいませ{{$lastname}}様
	<div>
		会員情報の変更は下部のボタンからお進みください<br>
		<a href="{{url('editInfo')}}">会員情報を変更</a>
	</div>
	<a href="{{url('logout')}}">ログアウト</a>
	<h1>お客さんの注文履歴</h1>
	<!--注文時間フィルター-->
	<form method="post" action="{{url('myPage')}}">
		{{csrf_field()}}
		<select name="date_filter">
			<option value="-6"
				@if($dateFilter==-6)
					{{'selected="selected"'}}
				@endif
			>過去六ヶ月</option>
			<option value="-12"
				@if($dateFilter==-12)
					{{'selected="selected"'}}
				@endif			
			>過去一年間</option>
			<option value="-24"
				@if($dateFilter==-24)
					{{'selected="selected"'}}
				@endif			
			>過去二年間</option>
		</select>
		<input type="submit" value="検索">
	</form>
	<!--注文履歴-->
	<table>
		<tr>
			<td></td>
			<td>商品名</td>
			<td>注文日</td>
			<td>数量</td>
			<td>金額</td>
			<td>注文状況</td>
		</tr>
		@foreach($orderInfos as $key=>$value)
		<tr><!--商品div-->
			<td>
			<!--商品画像-->
			<a href="{{url('proDetails',['products_id'=>$value->id])}}"><img src="{{asset($value->previewfile)}}"></a>
			</td>
			<td>
			<!--商品名-->
			<a href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}</a>
			</td>
			<!--注文日-->
			<td>
			{{substr($order[$key]->created_at,0,10)}}
			</td>
			<!--数量-->
			<td>
			{{$order[$key]->quantity}}
			</td>
			<td>
			<!--単価-->
			&yen;{{$value->price}}
			</td>
			<!--注文状況-->
		<td>
			{{$state[$key]}}
		</td>
		</tr>
		@endforeach
	</table>

@endsection