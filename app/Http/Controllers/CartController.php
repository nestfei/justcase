<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartlist;

class CartController extends Controller
{/*memo:数量はまだ*/
    public function cartPage(){
			return view('cartpage');
		}
	
		/*買い物カートに追加する*/
		public function addCart(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//カートに追加する商品idを取得
			$pid=$request->input('pid');
			if($pid){
				Cartlist::firstOrCreate(['userid'=>$uid,'pid'=>$pid]);
			}else{
				return response()->json(array('status'=>1,'msg'=>'pidが存在んしません'));
			}
			return response()->json(array('status'=>0,'msg'=>'カートに追加しました'));
		}
}
