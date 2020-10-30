<?php

namespace App\Http\Controllers;

use App\Models\Sliderimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
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
		//ホームページ
    public function homePage(){
			$productsInfo=$this->newProducts();
			$wish=$this->isWish($productsInfo);
			return view('homepage',['productsInfo'=>$productsInfo,'wish'=>$wish]);
		}
	
		public function all(){
			$productsInfo=$this->allProducts();
			$wish=$this->isWish($productsInfo);
			return view('homepage',['productsInfo'=>$productsInfo,'wish'=>$wish]);
		}
	
		//全ての商品
		public function allProducts(){
			//プレビュー画像のパス、商品名、価格、カテゴリー、id
			$productsInfo=DB::table('products as p')->leftJoin('procategory as c','p.procategory_id','=','c.id')->select('p.*','c.name as catename')->get();
			return $productsInfo;
		}
	
		//最新の8商品
		public function newProducts(){
			$productsInfo=DB::table('products as p')->leftJoin('procategory as c','p.procategory_id','=','c.id')->select('p.*','c.name as catename')->orderBy('createtime','DESC')->take(8)->get();
			return $productsInfo;
		}
	
}
