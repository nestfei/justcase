<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Descategory;
use App\Models\Procategory;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;

class SearchController extends Controller
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
	
    public function searchProducts(Request $request){
			$search=mb_convert_kana($request->input('search'),'a','UTF-8');
			$input=$search;
			$search=str_replace('　',' ',$search);
			if(empty($search)){
				$search="可愛い";
				$input=$search;
			}
			$searchArr=explode(' ',$search);
			$searchLike=[];
			foreach($searchArr as $key=>$value){
				$searchLike[$key]=['name','like','%'.$value.'%'];
			}
			$result=Products::where($searchLike)->get();
			$wish=$this->isWish($result);
			return view('result',['cateproducts'=>$result,'wish'=>$wish,'input'=>$input]);
		}
	
		public function searchCheck(Request $request){
			$desId=$request->input('desId');
			$proId=Procategory::where('category_no','=',$request->input('proNo'))->first();
			$result=Products::where([['descategory_ids','=',$desId],['procategory_id','=',$proId->id]])->orwhere([['descategory_ids','like',$desId.',%'],['procategory_id','=',$proId->id]])->orwhere([['descategory_ids','like','%,'.$desId.',%'],['procategory_id','=',$proId->id]])->orwhere([['descategory_ids','like','%,'.$desId],['procategory_id','=',$proId->id]])->get();
			$wish=$this->isWish($result);
			return view('result',['cateproducts'=>$result,'wish'=>$wish]);
		}
}
