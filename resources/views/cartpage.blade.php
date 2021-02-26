@extends('mainlayout')

@section('title','買い物カート')

@section('lastname',$lastname)

@section('contents')
<div class="Cart">
  <h1 class="Contents-title">ショッピングカート</h1>
  <div class="Cart__list">
    <div class="Cart__label">
      <span></span>
      <span>商品名</span>
      <span>単価</span>
      <span>数量</span>
      <span>小計合計</span>
      <span></span>
    </div>
    @foreach($cartInfos as $value)
    <div class="Cart__item">
      <div class="Cart__img">
        <a href="{{url('proDetails',['products_id'=>$value->id])}}">
          <img src="{{asset($value->previewfile)}}">
        </a>
      </div>
      <a class="Cart__text" href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}</a>
      <div class="Cart__price">
        &yen;<span class="price">{{$value->price}}</span>
      </div>
      <div class="Cart__button" id="{{$value->id}}">
        <input class="text_box" type="text" name="number" value="{{$quantity[$value->id]}}">
        <button class="btn_up"></button>
        <button class="btn_down"></button>
      </div>
      <div class="Cart__subtotal">
        &yen;<span class="sub_total"></span>
      </div>
      <div class="Cart__remove">
        <a href="{{url('removeCart',['pid'=>$value->id])}}">
          <button class='remove_cart'>削除</button>
        </a>
      </div>
    </div>
    @endforeach
    <a class="Cart__link Button Button--red" href="{{url('orderPage')}}">レジに進む</a>
  <a class="Cart__link Button Button--red" href="{{url('homePage')}}">買い物をつづける</a>
  </div>
</div>

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
				$('.Cart__item').each(function(){sub=parseInt($(this).find('input[class*=text_box]').val())*parseInt($(this).find('span[class*=price]').text());
					$(this).find('span[class*=sub_total]').html(sub);
				});
			}
			//合計
			function total(){
				var sum=0;
				$('.Cart__item').each(function(){
					sum+=parseInt($(this).find('input[class*=text_box]').val())*parseInt($(this).find('span[class*=price]').text());
				})
				$('.total').html("¥"+sum);
			}
			subTotal();
			total();
		});
	</script>
@endsection

@endsection