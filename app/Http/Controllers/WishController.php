<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishController extends Controller
{
		/*お気に入りに追加*/
    public function addWish(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//お気に入り商品idを取得
			$pid=$request->input('pid');
			if($pid){
				Wishlist::firstOrCreate(['userid'=>$uid,'pid'=>$pid]);
			}else{
				return response()->json(array('status'=>1,'msg'=>'pidが存在んしません'));
			}
			return response()->json(array('status'=>0,'msg'=>'お気に入りに追加済'));
		}
	
		/*お気に入りから削除*/
		public function removeWish(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//お気に入り商品idを取得
			$pid=$request->input('pid');
			if($pid){
				Wishlist::where([['userid','=',$uid],['pid','=',$pid]])->delete();
			}else{
				return response()->json(array('status'=>1,'msg'=>'pidが存在んしません'));
			}
			return response()->json(array('status'=>0,'msg'=>'お気に入りから削除済'));
		}
	
		/*お気に入り一覧*/
		public function wishPage(Request $request){
			$wishInfos=array();
			$uid=$request->cookie('uid_cookie');
			$wish=Wishlist::where('userid','=',$uid)->orderBy('created_at','desc')->get();
			foreach($wish as $value){
				$wishInfo=Wishlist::find($value->id)->wishInfo;
				foreach($wishInfo as $item){
					array_push($wishInfos,$item);
				}
			}
			return view('wishpage',['wishInfos'=>$wishInfos]);
		}
}
