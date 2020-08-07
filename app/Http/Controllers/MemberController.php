<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
	//ログインページ
  public function loginPage(){
		return view('login');
	}
	
	//登録ページ
	public function registerPage(){
		return view('register');
	}
		
	//登録チェック、エラーメッセージ
	public function registerDao(Request $request){
		$request->validate([
			'Member.email'=>'required|email',
			'Member.name1'=>'required',
			'Member.name2'=>'required',
			'Member.name3'=>'required',
			'Member.name4'=>'required',
			'Member.password'=>'required',
			'comfirmpwd'=>'required|same:Member.password'
		],[
			'required'=>':attributeを入力してください',
			'same'=>':attributeは一致しません',
			'email'=>'正しい:attributeを入力してください'
		],[
			'Member.email'=>'メールアドレス',
			'Member.name1'=>'姓',
			'Member.name2'=>'名',
			'Member.name3'=>'姓（フリガナ）',
			'Member.name4'=>'名（フリガナ）',
			'Member.password'=>'パスワード',
			'comfirmpwd'=>'パスワード（再入力）'
		]);
	}
	
	//memo 
	/*public function registerAdd(Request $request){
		$request->validate([
			'Add.phone'=>'required|phone',
			
		]);
	}*/
	
}
