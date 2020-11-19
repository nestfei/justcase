<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Procategory;
use App\Models\Descategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;

class CategoryController extends Controller
{		
		//お気に入りに入っているかどうかを判断
		public function isWish($list){
			$uid=Cookie::get('uid_cookie');
			$wish=array();/*連想配列 商品idは添え字*/
			foreach($list as $value){
				$wished=Wishlist::where([['userid','=',$uid],['pid','=',$value->id]])->first();
				if($wished){
					$wish[$value->id]=1;
				}else{
					$wish[$value->id]=0;
				}
			}
			return $wish;
		}
		//機種カテゴリー
    public function categoryPage(Request $request,$cateNo){
			$parent=Procategory::where('parent_no','=','0')->get();
			$is_parent=false;
			foreach($parent as $value){
				if($cateNo==$value->category_no){
					$cateIds=Procategory::where('parent_no','=',$cateNo)->get();
					foreach($cateIds as $value2){
						$cateIdsArray[]=$value2->id;
					}
					$is_parent=true;
					break;
				}
			}
			if($is_parent){
				$cateproducts=Products::wherein('procategory_id',$cateIdsArray)->get();
			}else{
				$cateId=Procategory::where('category_no','=',$cateNo)->first('id');
				$cateproducts=Products::where('procategory_id','=',$cateId->id)->get();
			}
			$wish=$this->isWish($cateproducts);
			return view('result',['cateproducts'=>$cateproducts,'wish'=>$wish,'cateNo'=>$cateNo]);
		}
	
			//デザインカテゴリー
			public function categorDesPage($cateNo){
			$cateId=Descategory::where('category_no','=',$cateNo)->first('id');
			$desId=$cateId->id;
			$cateproducts=Products::where('descategory_ids','=',$desId)->orwhere('descategory_ids','like',$desId.',%')->orwhere('descategory_ids','like','%,'.$desId.',%')->orwhere('descategory_ids','like','%,'.$desId)->get();
			$wish=$this->isWish($cateproducts);
			return view('result',['cateproducts'=>$cateproducts,'wish'=>$wish,'desCateNo'=>$cateNo]);
		 }
}
