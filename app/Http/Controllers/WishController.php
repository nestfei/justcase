<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishController extends Controller
{
		/*気に入りに追加*/
    public function addWish(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//気に入り商品idを取得
			$pid=$request->input('pid');
			if($pid){
				Wishlist::firstOrCreate(['userid'=>$uid,'pid'=>$pid]);
			}else{
				return response()->json(array('status'=>1,'msg'=>'pidが存在んしません'));
			}
			return response()->json(array('status'=>0,'msg'=>'お気に入り追加済'));
		}
	
		/*気に入りから削除*/
		public function removeWish(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//気に入り商品idを取得
			$pid=$request->input('pid');
			if($pid){
				Wishlist::where([['userid','=',$uid],['pid','=',$pid]])->delete();
			}else{
				return response()->json(array('status'=>1,'msg'=>'pidが存在んしません'));
			}
			return response()->json(array('status'=>0,'msg'=>'お気に入り'));
		}
}
