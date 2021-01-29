<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Cookie;

class MemberController extends Controller
{
	//ログインページ
  public function loginPage(Request $request){
		if($request->cookie('auth_cookie')){
			//自動ログイン
			return view('homepage');
		}
		return view('login');
	}
	
	//登録ページ
	public function registerPage(){
		return view('register',['email'=>'',
														'last'=>'',
														'firstname'=>'',
														'lastname_huri'=>'',
														'firstname_huri'=>'',
														'birth_y'=>'',
														'birth_m'=>'',
														'birth_d'=>'',
														'gender'=>'',
														'post'=>'',
														'prefecture'=>'',
														'town'=>'',
														'address'=>'',
														'phone'=>''
													 ]);
	}
	
	public function registerPageBack(Request $request){
		$data=$request->input('Member');
		$birth=$request->input('Birth');
		return view('register',['email'=>$data['email'],
														'last'=>$data['lastname'],
														'firstname'=>$data['firstname'],
														'lastname_huri'=>$data['lastname_huri'],
														'firstname_huri'=>$data['firstname_huri'],
														'gender'=>$data['gender'],
														'birth_y'=>$birth['y'],
														'birth_m'=>$birth['m'],
														'birth_d'=>$birth['d'],
														'post'=>$data['post'],
														'prefecture'=>$data['prefecture'],
														'town'=>$data['town'],
														'address'=>$data['address'],
														'phone'=>$data['phone']
													 ]);
	}
	
	//登録確認ページ、エラーメッセージ
	public function registerConfirm(Request $request){
		//入力チェック
		$request->validate([
			'Member.email'=>'required|email',
			'Member.lastname'=>'required',
			'Member.firstname'=>'required',
			'Member.lastname_huri'=>'required',
			'Member.firstname_huri'=>'required',
			'Member.password'=>'required|digits_between:8,20',
			'Member.post'=>'required|digits:7',
			'Member.prefecture'=>'required',
			'Member.town'=>'required',
			'Member.phone'=>'required|phone',
			'comfirmpwd'=>'required|same:Member.password'
		],[
			'required'=>':attributeを入力してください',
			'digits_between'=>':attributeは8文字以上20文字以内で入力してください',
			'digits'=>'正しい:attributeを入力してください',
			'same'=>':attributeは一致しません',
			'email'=>'正しい:attributeを入力してください',
			'phone'=>'正しい:attributeを入力してください'
		],[
			'Member.email'=>'メールアドレス',
			'Member.lastname'=>'姓',
			'Member.firstname'=>'名',
			'Member.lastname_huri'=>'姓（フリガナ）',
			'Member.firstname_huri'=>'名（フリガナ）',
			'Member.password'=>'パスワード',
			'Member.post'=>'郵便番号',
			'Member.prefecture'=>'都道府県',
			'Member.town'=>'市町村',
			'Member.phone'=>'電話番号',
			'comfirmpwd'=>'パスワード（再入力）'
		]);
		//データを受け取る。Memberは配列
		$data=$request->input('Member');
		$birth=$request->input('Birth');
		//メールアドレス重複チェック
		$repeat_check=Member::where('email','=',$data['email'])->first();
		if(isset($repeat_check)){
			return redirect('registerPage')->with('email_existed','登録済のメールアドレスです')->withinput();
		}else{
			$birth_str=$birth['y']."-".$birth['m']."-".$birth['d'];
			$gender_arr=['男','女','その他'];
			return view('regist_comfirm',['email'=>$data['email'],
																		'last'=>$data['lastname'],
																		'firstname'=>$data['firstname'],
																		'lastname_huri'=>$data['lastname_huri'],
																		'firstname_huri'=>$data['firstname_huri'],
																		'password'=>$data['password'],
																		'gender'=>$data['gender'],
																		'gender_arr'=>$gender_arr,
																		'birth_y'=>$birth['y'],
																		'birth_m'=>$birth['m'],
																		'birth_d'=>$birth['d'],
																		'birth_str'=>$birth_str,
																		'post'=>$data['post'],
																		'prefecture'=>$data['prefecture'],
																		'town'=>$data['town'],
																		'address'=>$data['address'],
																		'phone'=>$data['phone']]);
		}
	}
		
	//登録
	public function registerDao(Request $request){
		//データを受け取る。Memberは配列
		$data=$request->input('Member');
		$data['birth']=$request->input('Birth');
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
				return \response()->redirectToRoute('home')->cookie($auth_cookie)->cookie($uid_cookie)->cookie($lastname_cookie);
			}else{
				$uid_cookie=\Cookie('uid_cookie',$uid);
				$lastname_cookie=\Cookie('lastname_cookie',$lastname);
				return \response()->redirectToRoute('home')->cookie($uid_cookie)->cookie($lastname_cookie);
			}
		}else{
			return redirect('loginPage')->with('login_error','メールアドレスまたはパスワードは正しくありません')->withinput();
		}		
	}
	
	//マイページ 多分使わない
	public function myPage(){
		return view('mypage');
	}
	
	//情報変更ページ
	public function editInfo(){
		$uid=Cookie::get('uid_cookie');
		$info=Member::where('id','=',$uid)->first();
		return view('edit_info',['info'=>$info]);
	}

	//情報変更チェック、エラーメッセージ
	public function editCheck(Request $request){
		//入力チェック
		$request->validate([
			'Member.email'=>'required|email',
			'Member.lastname'=>'required',
			'Member.firstname'=>'required',
			'Member.lastname_huri'=>'required',
			'Member.firstname_huri'=>'required',
			'Member.password'=>'required|digits_between:8,20',
			'Member.post'=>'required|digits:7',
			'Member.prefecture'=>'required',
			'Member.town'=>'required',
			'Member.phone'=>'required|phone',
			'comfirmpwd'=>'required|same:Member.password'
		],[
			'required'=>':attributeを入力してください',
			'digits_between'=>':attributeは8文字以上20文字以内で入力してください',
			'digits'=>'正しい:attributeを入力してください',
			'same'=>':attributeは一致しません',
			'email'=>'正しい:attributeを入力してください',
			'phone'=>'正しい:attributeを入力してください'
		],[
			'Member.email'=>'メールアドレス',
			'Member.lastname'=>'姓',
			'Member.firstname'=>'名',
			'Member.lastname_huri'=>'姓（フリガナ）',
			'Member.firstname_huri'=>'名（フリガナ）',
			'Member.password'=>'パスワード',
			'Member.post'=>'郵便番号',
			'Member.prefecture'=>'都道府県',
			'Member.town'=>'市町村',
			'Member.phone'=>'電話番号',
			'comfirmpwd'=>'パスワード（再入力）'
		]);
		//データを受け取る。Memberは配列
		$data=$request->input('Member');
		$birth=$request->input('Birth');
		//メールアドレス重複チェック
		$uid=Cookie::get('uid_cookie');
		$repeat_check=Member::where([['email','=',$data['email']],['id','<>',$uid]])->first();
		if(isset($repeat_check)){
			return redirect('editInfo')->with('email_existed','登録済のメールアドレスです')->withinput();
		}else{
			$birth=$request->input('Birth');
			$birth_str=$birth['y']."-".$birth['m']."-".$birth['d'];
			//データを受け取る。Memberは配列
			$data=$request->input('Member');
			$data['birth']=$birth_str;
			//members表に書き込む
			$salt='just';
			$md5pwd=md5($data['password'].$salt);
			$data['password']=$md5pwd;
			Member::where('id','=',$uid)->update($data);
			/*exit;*/
			exit("<script>
				alert('変更しました\\nありがとうございました');
				location.href='editInfo';
			</script>");	
		}
	}
	
	/*ログアウト*/
	public function logout(){
		$cookie1=Cookie::forget('auth_cookie');
		$cookie2=Cookie::forget('lastname_cookie');
		$cookie3=Cookie::forget('uid_cookie');
		return redirect()->route('home')->withCookie($cookie1)->withCookie($cookie2)->withCookie($cookie3);
	}
	
}
