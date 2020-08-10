<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
		//ホームページ
    public function homePage(){
			return view('homepage');
		}
}
