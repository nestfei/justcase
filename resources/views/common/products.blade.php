	<div class="Product">
		<!--プレビュー画像-->
		<div class="Product__img-wrap <?php if(isset($class)) echo $class ?>">
      <a class="Product__img" href="{{url('proDetails',['productsId'=>$value->id])}}">
        <img src="{{asset($value->previewfile)}}">
      </a>
    </div>
		<!--商品名-->
		<a class="Product__name" href="{{url('proDetails',['productsId'=>$value->id])}}">{{$value->name}}
		<!--単価-->
		<span class="Product__price">{{$value->price}}円(税別)</a></span>
		<!--お気に入りボタン-->
		<button class='Product__favorite-button' id="{{$value->id}}">
		@if($wish[$value->id]==0)
			<span class="Product__no-favorite"><img src="{{ asset("images/icons/no-favorite.svg") }}" alt="お気に入りに入れる"></span>
		@else
			<span class="Product__favorite"><img src="{{ asset("images/icons/favorited.svg") }}" alt="お気に入り済み"></span>
		@endif
		</button>
	</div>
