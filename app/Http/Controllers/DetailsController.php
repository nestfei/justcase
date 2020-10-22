<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodetails;
use App\Models\Products;
use App\Models\Procategory;
use App\Models\Descategory;

class DetailsController extends Controller
{
    public function proDetails($products_id){
			$alldeteils=Prodetails::where('products_id','=',$products_id)->get();
			$productInfo=Products::where('id','=',$products_id)->get();
			/*機種*/
			$procate=Procategory::where('id','=',$productInfo[0]->procategory_id)->get();
			/*デザインid*/
			foreach($productInfo as $value){
				$descateIds=explode(",",$value->descategory_ids);
			}
			return view('prodetails',['alldetails'=>$alldeteils,'productInfo'=>$productInfo,'proCate'=>$procate,'descateIds'=>$descateIds]);
		}
}
