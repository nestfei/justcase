<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
})->name('mywelcome');*/
Route::any('/',['uses'=>'HomeController@homePage'])->name('home');

//ログインページ
Route::any('loginPage',['uses'=>'MemberController@loginPage']);

//登録ページ
Route::any('registerPage',['uses'=>'MemberController@registerPage']);
Route::any('registerPageBack',['uses'=>'MemberController@registerPageBack']);

//登録確認ページ
Route::any('registerConfirm',['uses'=>'MemberController@registerConfirm']);

//登録、ログイン、エラーメッセージ
Route::group(['middleware'=>['web']],function(){
	Route::any('registerDao',['uses'=>'MemberController@registerDao']);
	Route::any('loginDao',['uses'=>'MemberController@loginDao']);
});

//ホームページ
Route::any('homePage',['uses'=>'HomeController@homePage'])->name('home');

//ログイン判断　お気に入り、カート用
/*Route::group(['middleware'=>['autologin']],function(){
	お気に入り、カートのルーター
});*/






