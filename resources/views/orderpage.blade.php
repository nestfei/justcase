@extends('mainlayout')

@section('title','注文内容確認')

@section('lastname',$lastname)

@section('contents')
<div class="Order">
  <h1 class="Contents-title">ご注文内容の確認</h1>
  <div class="Order__inner-wrapper">
    <h2 class="Order__sub-title">ご注文内容</h2>
    <div class="Order__label">
      <span></span>
      <span>商品名</span>
      <span>単価</span>
      <span>数量</span>
      <span>小計合計</span>
    </div>
    <div class="Order__detail">
      @foreach($cartInfos as $value)
      <!--商品画像-->
      <a href="{{url('proDetails',['products_id'=>$value->id])}}">
        <img src="{{asset($value->previewfile)}}">
      </a>
      <!--商品名-->
      <a class="Order__name" href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}</a>
      <!--単価-->
      <span>&yen;<span class="price">{{$value->price}}</span></span>
      <div id="{{$value->id}}">
        <!--数量-->
        <span class="text_box">{{$quantity[$value->id]}}</span>
      </div>
      <!--小計-->
      <span>&yen;<span class="sub_total"></span></span>
      @endforeach
    </div>
  </div>
  <div class="Order__info">
    <div>
      <h1 class="Contents-title Order__info-title">ご注文内容の確認</h1>
      <div class="Order__user-data">
        <p>お名前</p>
        <p>{{$member->lastname}}　{{$member->firstname}}</p>
      </div>
      <div class="Order__user-data">
        <p>郵便番号</p>
        <p>{{$member->post}}</p>
      </div>
      <div class="Order__user-data">
        <p>住所</p>
        <p>{{$member->prefecture}}　{{$member->town}}　{{$member->address}}</p>
      </div>
      <div class="Order__user-data">
        <p>電話番号</p>
        <p>{{$member->phone}}</p>
      </div>
    </div>
    <div>
      <h1 class="Contents-title Order__info-title">ご注文内容の確認</h1>
      <label for="pay">代金引換</label><input type="radio" name="pay">
    </div>
  </div>
  <div class="Order__links">
    <a class="Button Button--red Order__link" href="{{url('editInfo')}}">会員情報を変更</a>
    <div class="Order__complete">
      <span class="Order__total">合計<span class="total"></span></span>
      <a class="Button Button--red Order__link" href="{{url('ordered')}}">注文を確定する</a>
      <a class="Button Button--red Order__link" href="{{url('cartPage')}}">ショッピングカートに戻る</a>
    </div>
  </div>
</div>
{{-- <table>
	<tr>
		<td></td>
		<td>商品名</td>
		<td>単価</td>
		<td>数量</td>
		<td>小計</td>
	</tr>
@foreach($cartInfos as $value)
	<tr class="cart_product"><!--商品div-->
		<!--商品画像-->
		<td>
		<a href="{{url('proDetails',['products_id'=>$value->id])}}"><img src="{{asset($value->previewfile)}}"></a>
		</td>
		<td>
		<!--商品名-->
		<a href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}</a>
		</td>
		<td>
		<!--単価-->
		&yen;<span class="price">{{$value->price}}</span>
		</td>
		<td>
		<div id="{{$value->id}}">
		<!--数量-->
			<span class="text_box">{{$quantity[$value->id]}}</span>
		</div>
		</td>
		<td>
			<!--小計-->
			&yen;<span class="sub_total"></span>
		</td>
	</tr>
@endforeach
</table> --}}
<!--合計-->


@section('js')
	@parent
	<script type="text/javascript">
		$(function(){
			//小計
			function subTotal(){
				var sub=0;
				$('.Order__detail').each(function(){sub=parseInt($(this).find('span[class*=text_box]').text())*parseInt($(this).find('span[class*=price]').text());
					$(this).find('span[class*=sub_total]').html(sub);
				});
			}
			//合計
			function total(){
				var sum=0;
				$('.Order__detail').each(function(){sum+=parseInt($(this).find('span[class*=text_box]').text())*parseInt($(this).find('span[class*=price]').text());
				})
				$('.total').html("¥"+sum);
			}
			subTotal();
			total();
		});
	</script>
@endsection

@endsection