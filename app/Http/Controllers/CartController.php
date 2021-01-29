<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cartlist;
use Illuminate\Support\Facades\Cookie;
use App\Models\Member;

class CartController extends Controller{
	
		/*買い物カート一覧*/
		public function readCart(){
			$cartInfos=array();
			$quantity=array();
			$uid=Cookie::get('uid_cookie');
			$cart=Cartlist::where('userid','=',$uid)->orderBy('updated_at','desc')->get();
			foreach($cart as $value){
				$cartInfo=Cartlist::find($value->id)->cartInfo;
				foreach($cartInfo as $item){
					array_push($cartInfos,$item);
				}
				$quantity[$value->pid]=$value->quantity;
			}
			$result=[$cartInfos,$quantity];
			return $result;
		}
		
		/*買い物カートページ*/
		public function cartPage(){
			$result=$this->readCart();
			return view('cartpage',['cartInfos'=>$result[0],'quantity'=>$result[1]]);
		}
	
		/*注文確認ページ*/
		public function orderPage(){
			//ユーザーidを取得
			$uid=Cookie::get('uid_cookie');
			//ユーザー情報を取得
			$member=Member::where('id','=',$uid)->first();
			$result=$this->readCart();
			return view('orderpage',['cartInfos'=>$result[0],'quantity'=>$result[1],'member'=>$member]);
		}
	
		/*買い物カートに追加する(+1)*/
		public function addCart(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//商品idを取得
			$pid=$request->input('pid');
			if($pid){
				$cartDate=Cartlist::where([['userid','=',$uid],['pid','=',$pid]])->first();
				$quantity=1;
				if(isset($cartDate)){
					$quantity+=$cartDate->quantity;
				}
				Cartlist::updateOrCreate(['userid'=>$uid,'pid'=>$pid],['quantity'=>$quantity]);
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
			$result=$this->readCart();
			return view('cartpage',['cartInfos'=>$result[0],'quantity'=>$result[1]]);
		}
	
		/*買い物カートから1件減らす(-1)*/
		public function m1Cart(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//商品idを取得
			$pid=$request->input('pid');
			$cartDate=Cartlist::where([['userid','=',$uid],['pid','=',$pid]])->first();
			$quantity=1;
			if(isset($cartDate)){
				$quantity=$cartDate->quantity-1;
			}
			Cartlist::where([['userid','=',$uid],['pid','=',$pid]])->first()->update(['quantity'=>$quantity]);
			return response()->json(array('status'=>0,'msg'=>'カートから1件減らしました'));
		}
		
		/*買い物カートのinputから数量変更*/
		public function changeCart(Request $request){
			//ユーザーidを取得
			$uid=$request->cookie('uid_cookie');
			//商品idを取得
			$pid=$request->input('pid');
			$quantity=$request->input('quantity');
			Cartlist::where([['userid','=',$uid],['pid','=',$pid]])->first()->update(['quantity'=>$quantity]);
			return response()->json(array('status'=>0,'msg'=>'数量を変更しました'));
		}
	
}
