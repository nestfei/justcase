<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodetails;
use App\Models\Products;
use App\Models\Procategory;
use App\Models\Descategory;
use App\Models\Wishlist;

class DetailsController extends Controller
{
    public function proDetails(Request $request,$products_id){
			/*商品詳細情報*/
			$allDeteils=Prodetails::where('products_id','=',$products_id)->get();
			$productInfo=Products::where('id','=',$products_id)->get();
			/*機種*/
			$proCate=Procategory::where('id','=',$productInfo[0]->procategory_id)->get();
			/*デザインid*/
			foreach($productInfo as $value){
				$descateIds=explode(",",$value->descategory_ids);
			}
			/*お気に入りに追加済であるかどうか*/
			$uid=$request->cookie('uid_cookie');
			$pid=$products_id;
			$wish=Wishlist::where([['userid','=',$uid],['pid','=',$pid]])->first();
			$button="お気に入りに追加する";
			if($wish){
				$button="お気に入りに追加済";
			}
			/*似てる商品（おすすめ）*/
			$similar=Products::where([['procategory_id','=',$proCate[0]->id],['descategory_ids','like',$descateIds[0].',%'],['id','<>',$products_id]])
														->orwhere([['procategory_id','=',$proCate[0]->id],['descategory_ids','like','%,'.$descateIds[0].',%'],['id','<>',$products_id]])
														->orwhere([['procategory_id','=',$proCate[0]->id],['descategory_ids','like','%,'.$descateIds[0]],['id','<>',$products_id]])
														->orwhere([['procategory_id','=',$proCate[0]->id],['id','<>',$products_id]])
														->take(4)->get();
			return view('prodetails',['alldetails'=>$allDeteils,'productInfo'=>$productInfo,'proCate'=>$proCate,'descateIds'=>$descateIds,'similar'=>$similar,'button'=>$button]);
		}
}
