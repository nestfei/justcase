<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Procategory;
use App\Models\Descategory;

class CategoryController extends Controller
{
		//機種カテゴリー
    public function categoryPage($cateNo){
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
			return view('result',['cateproducts'=>$cateproducts]);
		}
	
			//デザインカテゴリー
			public function categorDesPage($cateNo){
			$cateId=Descategory::where('category_no','=',$cateNo)->first('id');
			$desId=$cateId->id;
			$cateproducts=Products::where('descategory_ids','=',$desId)->orwhere('descategory_ids','like',$desId.',%')->orwhere('descategory_ids','like','%,'.$desId.',%')->orwhere('descategory_ids','like','%,'.$desId)->get();
			return view('result',['cateproducts'=>$cateproducts]);
		 }
}
