@extends('mainlayout')

@section('title','新規登録')

@section('contents')
<div class="Register">
  <h1 class="Contents-title">新規会員登録</h1>
	<div class="Register__error">
    @include('common.validator')
  </div>
	{{session('email_existed')}}
	<form class="Register__form" method="post" action="{{url('registerConfirm')}}">
    <div class="Register__outer-wrapper">
      <h2 class="Register__title">会員登録</h2>
		{{csrf_field()}}
		<div class="Register__inner-wrapper">
      <label>メールアドレス</label>
      <input class="Register__input" type="text" name="Member[email]" placeholder="example@example.com" value="{{old('Member.email')}}{{$email}}">
    </div>
    <div class="Register__inner-wrapper">
      <label>パスワード</label>
      <div class="Register__password">
        <input class="Register__input" type="password" name="Member[password]">
        <span>パスワードは8文字以上20文字以内で入力してください</span>
      </div>
    </div>
    <div class="Register__inner-wrapper">
      <label>パスワード(確認)</label>
      <input class="Register__input" type="password" name="comfirmpwd">
    </div>
    <div class="Register__inner-wrapper">
      <label>お名前</label>
      <div class="Register__name">
        <input class="Register__input" type="text" name="Member[lastname]" placeholder="姓" value="{{old('Member.lastname')}}{{$last}}">
        <input class="Register__input" type="text" name="Member[firstname]" placeholder="名" value="{{old('Member.firstname')}}{{$firstname}}">
      </div>
    </div>
    <div class="Register__inner-wrapper">
      <label>フリガナ</label>
      <div class="Register__name">
        <input class="Register__input" type="text" name="Member[lastname_huri]" placeholder="セイ" value="{{old('Member.lastname_huri')}}{{$lastname_huri}}">
        <input class="Register__input" type="text" name="Member[firstname_huri]" placeholder="メイ" value="{{old('Member.firstname_huri')}}{{$firstname_huri}}">
      </div>
    </div>
    <div class="Register__inner-wrapper">
      <label>性別</label>
      <div class="Register__gender">
        <div>
          <input type="radio" name="Member[gender]" value="0" id="men"
          @if($gender==0 || old('Member.gender')==0)
            {{'checked="checked"'}}
          @endif>
          <label for="men">男</label>
        </div>
        <div>
          <input type="radio" name="Member[gender]" value="1" id="women"
          @if($gender==1 || old('Member.gender')==1)
            {{'checked="checked"'}}
          @endif>
          <label for="women">女</label>
        </div>
        <div>
          <input type="radio" name="Member[gender]" value="2" id="ohter"
					@if($gender==2 || old('Member.gender')==2)
            {{'checked="checked"'}}
					@endif>
          <label for="ohter">その他</label>
        </div>
      </div>
    </div>
    <div class="Register__inner-wrapper">
      <label>生年月日</label>
      <div class="Register__birthday">
        <select class="Register__select" name="Birth[y]" id="year" value="{{old('Birth.y')}}{{$birth_y}}"></select>
        <label>年</label>
        <select class="Register__select" name="Birth[m]" id="month" value="{{old('Birth.m')}}{{$birth_m}}"></select>
        <label>月</label>
        <select class="Register__select" name="Birth[d]" id="day" value="{{old('Birth.d')}}{{$birth_d}}"></select>
        <label>日</label>
      </div>
    </div>
    <div class="Register__inner-wrapper Register__inner-wrapper--short">
      <label>郵便番号</label>
      <input class="Register__input" type="text" name="Member[post]" value="{{old('Member.post')}}{{$post}}">
    </div>
    <div class="Register__inner-wrapper Register__inner-wrapper--short">
      <label>電話番号</label>
      <input class="Register__input" type="text" name="Member[phone]" value="{{old('Member.phone')}}{{$phone}}">
    </div>
    <div class="Register__inner-wrapper Register__inner-wrapper--short">
      <label>住所</label>
      <div class="Register__address">
        <input class="Register__input" type="text" name="Member[prefecture]" placeholder="都道府県" value="{{old('Member.prefecture')}}{{$prefecture}}">
        <input class="Register__input" type="text" name="Member[town]" placeholder="市町村" value="{{old('Member.town')}}{{$town}}">
        <input class="Register__input" type="text" name="Member[address]" placeholder="以降の住所" value="{{old('Member.address')}}{{$address}}">
      </div>
    </div>
		<input class="Button Button--red Register__button" type="submit" value="確認画面へ">
    </div>
  </form>
</div>
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