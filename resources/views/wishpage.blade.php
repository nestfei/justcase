@extends('mainlayout')

@section('title','お気に入り')

@section('lastname',$lastname)

@section('contents')
	<h1>お気に入りリスト</h1>
	@foreach($wishInfos as $value)
	<div><!--商品div-->
		<a href="{{url('proDetails',['products_id'=>$value->id])}}"><img src="{{asset($value->previewfile)}}"></a>
		<a href="{{url('proDetails',['products_id'=>$value->id])}}">{{$value->name}}
		{{$value->price}}</a>
		<!--お気に入りボタン-->
		<button class='remove_wish' id="{{$value->id}}">削除</button>
	</div>
	@endforeach

@section('js')
	@parent
	<!--お気に入りajax-->
    <script type="text/javascript">
				var btnText=$('.remove_wish').text();
        $('.remove_wish').on('click',function () {
            var id=$(this).attr("id");
						if(btnText=="お気に入り"){/*お気に入りに追加*/
								$.ajax({
									type:'POST',
									url:'{{url('addWish')}}',
									data:{pid:id,_token:"{{csrf_token()}}"},
									dataType:'json',
									success:function (data) {
											if(data.status==0){
													$('#'+id).text('削除');
													btnText=$('#'+id).text()
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
													$('#'+id).text(data.msg);
													btnText=$('#'+id).text()
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
@endsection

@endsection