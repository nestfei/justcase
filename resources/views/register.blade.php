@extends('mainlayout')

@section('title','新規登録')

@section('contents')
	@include('common.validator')
	{{session('email_existed')}}
	<form method="post" action="{{url('registerConfirm')}}">
			{{csrf_field()}}
			メールアドレス<input type="text" name="Member[email]" value="{{old('Member.email')}}{{$email}}"><br>
			パスワード<input type="password" name="Member[password]"><br>
			パスワード（再入力）<input type="password" name="comfirmpwd"><br>
			パスワードは8文字以上20文字以内で入力してください<br>
			<input type="checkbox">パスワードを表示する<br>
			お名前
			<input type="text" name="Member[lastname]" placeholder="姓" value="{{old('Member.lastname')}}{{$last}}">
			<input type="text" name="Member[firstname]" placeholder="名" value="{{old('Member.firstname')}}{{$firstname}}"><br>
			フリガナ
			<input type="text" name="Member[lastname_huri]" placeholder="セイ" value="{{old('Member.lastname_huri')}}{{$lastname_huri}}">
			<input type="text" name="Member[firstname_huri]" placeholder="メイ" value="{{old('Member.firstname_huri')}}{{$firstname_huri}}"><br>
			性別
			<input type="radio" name="Member[gender]" value="0" 
						@if($gender==0 || old('Member.gender')==0)
						 {{'checked="checked"'}}
						@endif
						 >男
			<input type="radio" name="Member[gender]" value="1" 
						@if($gender==1 || old('Member.gender')==1)
						 {{'checked="checked"'}}
						@endif
						 >女
			<input type="radio" name="Member[gender]" value="2" 
						@if($gender==2 || old('Member.gender')==2)
						 {{'checked="checked"'}}
						@endif
						 >その他<br>
			生年月日
			<select name="Birth[y]" id="year" value="{{old('Birth.y')}}{{$birth_y}}"></select>年
			<select name="Birth[m]" id="month" value="{{old('Birth.m')}}{{$birth_m}}"></select>月
			<select name="Birth[d]" id="day" value="{{old('Birth.d')}}{{$birth_d}}"></select>日<br>
			郵便番号<input type="text" name="Member[post]" value="{{old('Member.post')}}{{$post}}"><br>
			住所<input type="text" name="Member[prefecture]" placeholder="都道府県" value="{{old('Member.prefecture')}}{{$prefecture}}">
			<input type="text" name="Member[town]" placeholder="市町村" value="{{old('Member.town')}}{{$town}}">
			<input type="text" name="Member[address]" placeholder="以降の住所" value="{{old('Member.address')}}{{$address}}"><br>
			電話番号<input type="text" name="Member[phone]" value="{{old('Member.phone')}}{{$phone}}"><br>
			<input type="submit" value="登録">
	</form>
	<script>
		//生年月日セレクターのjs
		 window.onload=function(){
		 var oY=document.getElementById("year");
		 var oM=document.getElementById("month");
		 var oD=document.getElementById("day");
		 ini(oY,oM,oD);
		 oY.onchange=function(){
		 ref(oY,oM,oD);
		 }
		 oM.onchange=function(){
		 ref(oY,oM,oD);
		 }
		 }
		 function ini(y,m,d){
			for(var i=2020;i>1920;i--){
			if(i=="{{old('Birth.y')}}{{$birth_y}}"){
				y.appendChild(new Option(i,i,true,true));
			}else{
				y.appendChild(new Option(i));
			}
			
			}
			for(var i=1;i<13;i++){
				if(i=="{{old('Birth.m')}}{{$birth_m}}"){
					m.appendChild(new Option(i,i,true,true));
				}else{
					m.appendChild(new Option(i));
				}
			
			}
			for(var i=1;i<32;i++){
				if(i=="{{old('Birth.d')}}{{$birth_d}}"){
					d.appendChild(new Option(i,i,true,true));
				}else{
					d.appendChild(new Option(i));
				}
			
			}
		 }
		 function ref(y,m,d){
		 var yv=y.value;
		 var mv=m.value;
		 var dv;
		 switch(parseInt(mv)){
		 case 1:
		 case 3:
		 case 5:
		 case 7:
		 case 8:  
		 case 10:
		 case 12: dv=31;break;
		 case 4:
		 case 6:
		 case 9:
		 case 11:dv=30;break;
		 case 2:
			if((yv%4==0&&yv%100!=0)||(yv%400==0)){
			dv=29;
			}else{
			dv=28;
			}
			break;
		 }
		 d.length=0;
		 for(var i=1;i<dv+1;i++){
			d.appendChild(new Option(i));
			}
		 }
 </script>
@endsection