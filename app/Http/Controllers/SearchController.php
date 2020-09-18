<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Descategory;

class SearchController extends Controller
{
    public function searchProducts(Request $request){
			$search=mb_convert_kana($request->input('search'),'a','UTF-8');
			$search=str_replace('　',' ',$search);
			$searchArr=explode(' ',$search);
			$searchLike=[];
			foreach($searchArr as $key=>$value){
				$searchLike[$key]=['name','like','%'.$value.'%'];
			}
			$result=Products::where($searchLike)->get();
			
			return view('searchPage',['result'=>$result]);
		}
}
