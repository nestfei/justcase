@extends('mainlayout')

@section('title','お気に入り')

@section('lastname',$lastname)

@section('contents')
<div class="Favorite">
  <h1 class="Contents-title">お気に入り商品</h1>
  <div class="Favorite__list">
    <div class="Favorite__label">
      <span></span>
      <span>商品名</span>
      <span>単価</span>
      <span>在庫状況</span>
      <span></span>
    </div>
    @foreach($wishInfos as $value)
    <div class="Favorite__item">
      <div class="Favorite__img">
        <a href="{{url('proDetails',['products_id'=>$value->id])}}">
          <img src="{{asset($value->previewfile)}}">
        </a>
      </div>
      <div class="Favorite__text">
        <a href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}</a>
      </div>
      <div class="Favorite__text">
        &yen;{{$value->price}}
      </div>
      <div class="Favorite__text">
        @if($value->store>0)
          在庫あり
        @else
          在庫なし
        @endif
      </div>
      <div id="{{$value->id}}">
        <!--同じidをカート機能とお気に入り機能に使うために、カートボタンとお気に入りボタンを同じdivに入れた-->
        <!--買い物カートボタン-->
        <button class='Favorite__cart'>カートに入れる</button>
        <!--お気に入りボタン-->
        <button class='Favorite__remove'>削除</button>
      </div>
    </div>
    @endforeach
  </div>
</div>
@section('js')
	@parent
	<!--お気に入りajax-->
    <script type="text/javascript">
				var btnText=$('.remove_wish').text();
        $('.remove_wish').on('click',function () {
            var id=$(this).parent()[0].id;
						if(btnText=="お気に入りに追加する"){/*お気に入りに追加*/
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',
									data:{pid:id,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('#'+id).find('.remove_wish').text('削除');
													btnText=$('#'+id).find('.remove_wish').text()
											}
											if(data.status==1){
													alert(data.msg);
											}
									},
									error:function (xhr,status,error) {
											console.log(xhr);
											console.log(status);
											console.log(error);
									}
							});
						}else{/*お気に入りから削除*/
							$.ajax({
									type:'POST',
									url:'{{url('removeWish')}}',
									data:{pid:id,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('#'+id).find('.remove_wish').text('お気に入りに追加する');
													btnText=$('#'+id).find('.remove_wish').text()
											}
											if(data.status==1){
													alert(data.msg);
											}
									},
									error:function (xhr,status,error) {
											console.log(xhr);
											console.log(status);
											console.log(error);
									}
							});
						}
        });
		</script>
		<!--買い物カートajax-->
		<script type="text/javascript">
			/*買い物カートに追加するajax*/
        $('.cart').on('click',function () {
            var id=$(this).parent()[0].id;
								$.ajax({
									type:'POST',
									url:'{{url('addCart')}}',
									data:{pid:id,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											alert(data.msg);
									},
									error:function (xhr,status,error) {
											console.log(xhr);
											console.log(status);
											console.log(error);
									}
							});
        });
		</script>
@endsection

@endsection