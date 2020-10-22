<?php

namespace App\Http\Controllers;

use App\Models\Sliderimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
		//ホームページ
    public function homePage(){
			//全ての商品を読み込む
			$productsInfo=$this->allProducts();
			return view('homepage',['productsInfo'=>$productsInfo]);
		}
	
		//全ての商品
		public function allProducts(){
			//プレビュー画像のパス、商品名、価格、カテゴリー、id
			$productsInfo=DB::table('products as p')->leftJoin('procategory as c','p.procategory_id','=','c.id')->select('p.*','c.name as catename')->get();
			return $productsInfo;
		}
	
}
