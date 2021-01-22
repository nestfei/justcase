<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cartlist;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Orddetails;


class OrderController extends Controller
{		
	
    public function order(){
			//注文表にユーザーidと注文idを書き込む
			$uid=Cookie::get('uid_cookie');
			$oid=Orders::create(['uid'=>$uid,'states_id'=>0])->id;
			//注文詳細表に注文詳細を書き込む
			$this->orderDetails($oid,$uid);
			return view('orderfin');
		}
	
		//注文詳細表に注文詳細を書き込む関数
		public function orderDetails($oid,$uid){
			$cartInfos=Cartlist::where('userid','=',$uid)->get();//カート情報を読み込む
			foreach($cartInfos as $value){
				$product=Products::where('id','=',$value->pid)->first();
				$price=$product->price;
				Orddetails::create(['oid'=>$oid,'uid'=>$uid,'products_id'=>$value->pid,'quantity'=>$value->quantity,'price'=>$price]);
			}
			//カートデータを削除
			Cartlist::where('userid','=',$uid)->delete();
			
		}
	
	//注文一覧
	public function readOrder(Request $request){
			$orderInfos=array();
			$uid=Cookie::get('uid_cookie');
			//注文時間フィルター
			$date_filter=-6;
			if(!empty($request->input('date_filter'))){
				$date_filter=$request->input('date_filter');
			}
			$order_date=date("Y-m-d H:i:s", strtotime($date_filter."month"));
			
			//注文詳細
			$order=Orddetails::where([['uid','=',$uid],['created_at','>',$order_date]])->orderBy('created_at','desc')->get();
			foreach($order as $value){
				$orderInfo=Orddetails::find($value->id)->orderInfo;
				foreach($orderInfo as $item){
					array_push($orderInfos,$item);
				}
			}
			
			//注文状況
			$state=array();
			$state_name=['準備中','発送済','お届け済'];
			foreach($order as $value){
				$orders=Orders::where('oid','=',$value->oid)->first();
				$state[]=$state_name[$orders->states_id];
			}
		return view('mypage',['orderInfos'=>$orderInfos,'order'=>$order,'state'=>$state,'dateFilter'=>$date_filter]);
	}
	
}
