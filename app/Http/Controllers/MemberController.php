<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
	//ログインページ
  public function loginPage(Request $request){
		if($request->cookie('auth_cookie')){
			//自動ログイン
			return view('welcome');
		}
		return view('login');
	}
	
	//登録ページ
	public function registerPage(){
		return view('register');
	}
		
	//登録、エラーメッセージ
	public function registerDao(Request $request){
		//入力チェック
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
		
		//データを受け取る。Memberは配列
		$data=$request->input('Member');
		//メールアドレス重複チェック
		$repeat_check=Member::where('email','=',$data['email'])->first();
		if(isset($repeat_check)){
			return redirect('registerPage')->with('email_existed','登録済のメールアドレスです')->withinput();
		}else{
			//members表に書き込む
			$salt='just';
			$md5pwd=md5($data['password'].$salt);
			$data['password']=$md5pwd;
			Member::create($data);
			exit("<script>
				alert('登録完了\\nありがとうございました');
				location.href='loginPage';
			</script>");
		}
	}
	
	//ログイン
	public function loginDao(Request $request){
		//データを受け取る
		$email=$request->input('email');
		$password=$request->input('password');
		$salt='just';
		$md5pwd=md5($password.$salt);
		$auto_login=$request->input('auto_login');
		//パスワードチェック
		$result=Member::where([
			['email','=',$email],
			['password','=',$md5pwd]
		])->first();
		if($result){
			$user_data=Member::where('email','=',$email)->select('id','lastname')->get();
			$uid=$user_data[0]->id;
			$lastname=$user_data[0]->lastname;
			if($auto_login==1){
				$auth=md5($email.$md5pwd);
				$auth_cookie=\Cookie('auth_cookie',$auth,40320);
				$uid_cookie=\Cookie('uid_cookie',$uid,40320);
				$lastname_cookie=\Cookie('lastname_cookie',$lastname,40320);
				return \response()->redirectToRoute('mywelcome')->cookie($auth_cookie)->cookie($uid_cookie)->cookie($lastname_cookie);
			}else{
				$uid_cookie=\Cookie('uid_cookie',$uid);
				$lastname_cookie=\Cookie('lastname_cookie',$lastname);
				return \response()->redirectToRoute('mywelcome')->cookie($uid_cookie)->cookie($lastname_cookie);
			}
		}else{
			exit("<script>
					alert('メールアドレスまたはパスワードは正しくありません');
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
