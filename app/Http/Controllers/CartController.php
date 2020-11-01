<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartlist;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller{
	
		/*買い物カート一覧*/
		public function cartPage(){
			$cartInfos=array();
			$uid=Cookie::get('uid_cookie');
			$cart=Cartlist::where('userid','=',$uid)->orderBy('updated_at','desc')->get();
			foreach($cart as $value){
				$cartInfo=Cartlist::find($value->id)->cartInfo;
				foreach($cartInfo as $item){
					array_push($cartInfos,$item);
				}
			}
			return view('cartpage',['cartInfos'=>$cartInfos]);
			/*return view('cartpage');*/
		}
	
		/*買い物カートに追加する*/
		public function addCart(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//商品idを取得
			$pid=$request->input('pid');
			if($pid){
				Cartlist::firstOrCreate(['userid'=>$uid,'pid'=>$pid]);
			}else{
				return response()->json(array('status'=>1,'msg'=>'pidが存在んしません'));
			}
			return response()->json(array('status'=>0,'msg'=>'カートに追加しました'));
		}
	
		/*買い物カートから削除*/
		public function removeCart($pid){
			//ユーザーidを取得
			$uid=Cookie::get('uid_cookie');
			Cartlist::where([['userid','=',$uid],['pid','=',$pid]])->delete();
			$cartInfos=array();
			$cart=Cartlist::where('userid','=',$uid)->orderBy('updated_at','desc')->get();
			foreach($cart as $value){
				$cartInfo=Cartlist::find($value->id)->cartInfo;
				foreach($cartInfo as $item){
					array_push($cartInfos,$item);
				}
			}
			return view('cartpage',['cartInfos'=>$cartInfos]);
		}
		
}
