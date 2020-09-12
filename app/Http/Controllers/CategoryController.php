<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Procategory;

class CategoryController extends Controller
{
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
			
			return view('categorypage',['cateproducts'=>$cateproducts]);
		}
}
