@extends('mainlayout')

@section('title','マイページ')

@section('lastname',$lastname)

@section('contents')
	<div class="Mypage">
    <h1 class="Contents-title">マイページ</h1>
    <p class="Mypage__welcome">いらっしゃいませ、{{$lastname}}様</p>
    <div class="User-data-change">
      <p>会員情報の変更は下部のボタンからお進みください</p>
      <a class="Button Button--red" href="{{url('editInfo')}}">会員情報を変更</a>
    </div>
    <div class="Order-history Mypage__order-history">
      <h1 class="Order-history__title">お客様の注文履歴</h1>
      <!--注文時間フィルター-->
      <form method="post" action="{{url('myPage')}}">
        {{csrf_field()}}
        <select class="Order-history__select" name="date_filter">
          <option value="-6"
          @if($dateFilter==-6)
          {{'selected="selected"'}}
          @endif
          >過去六ヶ月</option>
          <option value="-12"
          @if($dateFilter==-12)
          {{'selected="selected"'}}
          @endif>過去一年間</option>
          <option value="-24"
          @if($dateFilter==-24)
          {{'selected="selected"'}}
          @endif>過去二年間</option>
        </select>
        <input class="Button Button--red Order-history__button" type="submit" value="検索">
      </form>
      <div class="Order-history__labels">
        <span class="Order-history__label"></span>
        <span class="Order-history__label">商品名</span>
        <span class="Order-history__label">注文日</span>
        <span class="Order-history__label">数量</span>
        <span class="Order-history__label">金額</span>
        <span class="Order-history__label">注文状況</span>
      </div>
      <div class="Order-history__list">
        @foreach($orderInfos as $key=>$value)
        <div class="Order-history__img">
          <a href="{{url('proDetails',['products_id'=>$value->id])}}">
            <img src="{{asset($value->previewfile)}}">
          </a>
        </div>
        <div class="Order-history__text">
          <a href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}</a>
        </div>
        <div class="Order-history__text">
          {{substr($order[$key]->created_at,0,10)}}
        </div>
        <div class="Order-history__text">
          {{$order[$key]->quantity}}
        </div>
        <div class="Order-history__text">
          &yen;{{$value->price}}
        </div>
        <div class="Order-history__text">
          {{$state[$key]}}
        </div>
        @endforeach
      </div>
    </div>
  </div>
	<!--注文履歴-->
	{{-- <table>
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
	</table> --}}

@endsection