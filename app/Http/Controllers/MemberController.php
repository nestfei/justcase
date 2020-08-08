<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

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
			'Member.lastname'=>'required',
			'Member.firstname'=>'required',
			'Member.lastname_huri'=>'required',
			'Member.firstname_huri'=>'required',
			'Member.password'=>'required',
			'comfirmpwd'=>'required|same:Member.password'
		],[
			'required'=>':attributeを入力してください',
			'same'=>':attributeは一致しません',
			'email'=>'正しい:attributeを入力してください'
		],[
			'Member.email'=>'メールアドレス',
			'Member.lastname'=>'姓',
			'Member.firstname'=>'名',
			'Member.lastname_huri'=>'姓（フリガナ）',
			'Member.firstname_huri'=>'名（フリガナ）',
			'Member.password'=>'パスワード',
			'comfirmpwd'=>'パスワード（再入力）'
		]);
		
		$data=$request->input('Member');//データを受け取る。Memberは配列
		
		//メールアドレス重複チェック
		$repeat_check=Member::where('email','=',$data['email'])->select('email')->get();
		$count=0;
		foreach($repeat_check as $value){
			$count++;
		}
		if($count==1){
			return redirect('registerPage')->with('email_existed','登録済のメールアドレスです')->withinput();
		}else{
			//members表に書き込む
			$hash_pwd=password_hash($data['password'],PASSWORD_DEFAULT);
			$data['password']=$hash_pwd;
			Member::create($data);
			exit("<script>
				alert('登録完了\\nありがとうございました');
				location.href='loginPage';
			</script>");
		}
	}
	
	//memo 
	/*public function registerAdd(Request $request){
		$request->validate([
			'Add.phone'=>'required|phone',
			
		]);
	}*/
	
}
