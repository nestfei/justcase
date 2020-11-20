<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cartlist;
use App\Models\Orders;
use App\Models\Orddetails;


class OrderController extends Controller
{
    public function order(){
			$uid=Cookie::get('uid_cookie');
			//注文表にユーザーidと注文idを書き込む
			$oid=Orders::create(['uid'=>$uid,'states_id'=>0])->id;
			
			//注文詳細表に注文詳細を書き込む
			//读取购物车表内容，写入订单表，然后删除购物车记录
			var_dump($oid);
			exit;
		}
}
