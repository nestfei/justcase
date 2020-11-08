@extends('mainlayout')

@section('title','買い物カート')

@section('lastname',$lastname)

@section('contents')
	<h1>買い物カート</h1>
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
			<input class="text_box" type="text" name="number" value="{{$quantity[$value->id]}}">
			<!--メモ：inputに入力できる数字を1-100の整数に限定するjsは書いていない。
							フロントエンドさんお願いします_(:3 」∠ )_-->
			<button class="btn_up">+</button>
			<button class="btn_down">-</button>
		</div>
		</td>
		<td>
			<!--小計-->
			&yen;<span class="sub_total"></span>
		</td>
		<td>
		<!--カートから削除ボタン-->
		<a href="{{url('removeCart',['pid'=>$value->id])}}"><button class='remove_cart'>削除</button></a>
			<a href="{{url('m1Cart',['pid'=>$value->id])}}">test-1</a>
		</td>
	</tr>
@endforeach
</table>
<!--合計-->
合計<span class="total"></span>

@section('js')
	@parent
	<script type="text/javascript">
		$(function(){
			//数量+
			$('.btn_up').click(function(){
				var id=$(this).parent()[0].id;
				var num=$(this).parent().find('input[class*=text_box]');
				num.val(parseInt(num.val())+1);
				subTotal();
				total();
				if(parseInt(num.val())<100){
					$.ajax({
							type:'POST',
							url:'{{url('addCart')}}',
							data:{pid:id,_token:"{{csrf_token()}}"},
							dataType:'json',
							success:function (data) {

							},
							error:function (xhr,status,error) {
									console.log(xhr);
									console.log(status);
									console.log(error);
							}
					});
				}
			});
			//数量-
			$('.btn_down').click(function(){
				var id=$(this).parent()[0].id;
				var num=$(this).parent().find('input[class*=text_box]');
				num.val(parseInt(num.val())-1);
				if(parseInt(num.val())<1){
					num.val(1);
					subTotal();
					total();
				}else{
					$.ajax({
						type:'POST',
						url:'{{url('m1Cart')}}',
						data:{pid:id,_token:"{{csrf_token()}}"},
						dataType:'json',
						success:function (data) {
								
						},
						error:function (xhr,status,error) {
								console.log(xhr);
								console.log(status);
								console.log(error);
						}
					});
				}
				subTotal();
				total();
				
			});
			//input change
			$('.text_box').change(function(){
				subTotal();
				total();
				var quantity=$(this).parent().find('input[class=text_box]').val();
				if(quantity>=1 && quantity<=100){
					var id=$(this).parent()[0].id;
					
					$.ajax({
							type:'POST',
							url:'{{url('changeCart')}}',
							data:{pid:id,quantity:quantity,_token:"{{csrf_token()}}"},
							dataType:'json',
							success:function (data) {

							},
							error:function (xhr,status,error) {
									console.log(xhr);
									console.log(status);
									console.log(error);
							}
					});
				}
			})
			//小計
			function subTotal(){
				var sub=0;
				$('.cart_product').each(function(){sub=parseInt($(this).find('input[class*=text_box]').val())*parseInt($(this).find('span[class*=price]').text());
					$(this).find('span[class*=sub_total]').html(sub);
				});
			}
			//合計
			function total(){
				var sum=0;
				$('.cart_product').each(function(){
					sum+=parseInt($(this).find('input[class*=text_box]').val())*parseInt($(this).find('span[class*=price]').text());
				})
				$('.total').html(sum);
			}
			subTotal();
			total();
		});
		

	</script>
    
@endsection

@endsection