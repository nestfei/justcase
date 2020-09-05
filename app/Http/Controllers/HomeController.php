<?php

namespace App\Http\Controllers;

use App\Models\Sliderimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
		//ホームページ
    public function homePage(){
			//スライドショー画像pathを読み込む
			$sliderInfo=$this->sliderimg();
			//全ての商品を読み込む
			$productsInfo=$this->allProducts();
			return view('homepage',['sliderInfo'=>$sliderInfo,'productsInfo'=>$productsInfo]);
		}
	
		//スライドショー
		public function sliderimg(){
			//image1
			$img1=Sliderimg::where('img_no','=',1)->first();
			$proid_1=$img1['products_id'];//画像の商品のid
			$imgfile_1=$img1['sliderimgfile'];//画像path
			//image2
			$img2=Sliderimg::where('img_no','=',2)->first();
			$proid_2=$img2['products_id'];//画像の商品のid
			$imgfile_2=$img2['sliderimgfile'];//画像path

			//mage3
			$img3=Sliderimg::where('img_no','=',3)->first();
			$proid_3=$img3['products_id'];//画像の商品のid
			$imgfile_3=$img3['sliderimgfile'];//画像path
			$sliderInfo=[
				[$imgfile_1,$proid_1],
				[$imgfile_2,$proid_2],
				[$imgfile_3,$proid_3]
			];
			return $sliderInfo;
		}
	
		//全ての商品
		public function allProducts(){
			//プレビュー画像のパス、商品名、価格、カテゴリー、id
			$productsInfo=DB::table('products as p')->leftJoin('procategory as c','p.procategory_id','=','c.id')->select('p.*','c.name as catename')->get();
			return $productsInfo;
		}
	
}
