@extends('mainlayout')

@section('title','注文内容確認')

@section('lastname',$lastname)

@section('contents')
	<h1>ご注文内容</h1>
<table>
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
</table>
<div>
	<h2>お届け先ご住所</h2>
	名前　{{$member->lastname}}　{{$member->firstname}}<br>
	郵便番号　{{$member->post}}<br>
	住所　{{$member->prefecture}}　{{$member->town}}　{{$member->address}}<br>
	電話番号　{{$member->phone}}<br>
	<a href="{{url('editInfo')}}">会員情報を変更</a>
</div>
<div>
	<h2>お支払い方法</h2>
	<input type="radio" name="pay">代金引換
</div>
<!--合計-->
合計<span class="total"></span><br>
<a href="{{url('ordered')}}">注文を確定する</a><br>
<a href="{{url('cartPage')}}">ショッピングカートに戻る</a>

@section('js')
	@parent
	<script type="text/javascript">
		$(function(){
			//小計
			function subTotal(){
				var sub=0;
				$('.cart_product').each(function(){sub=parseInt($(this).find('span[class*=text_box]').text())*parseInt($(this).find('span[class*=price]').text());
					$(this).find('span[class*=sub_total]').html(sub);
				});
			}
			//合計
			function total(){
				var sum=0;
				$('.cart_product').each(function(){sum+=parseInt($(this).find('span[class*=text_box]').text())*parseInt($(this).find('span[class*=price]').text());
				})
				$('.total').html("¥"+sum);
			}
			subTotal();
			total();
		});
		
	</script>
    
@endsection

@endsection