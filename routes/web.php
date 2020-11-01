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

//Route::any('descateArray',['uses'=>'HomeController@descateArray']);

//全ての商品
Route::any('allProducts',['uses'=>'HomeController@all']);

//機種カテゴリー別商品
Route::any('categoryPage/{cateNo}',['uses'=>'CategoryController@categoryPage']);

//デザインカテゴリー別商品
Route::any('categoryDesPage/{cateNo}',['uses'=>'CategoryController@categorDesPage']);

//商品検索
Route::any('searchProducts',['uses'=>'SearchController@searchProducts']);

//商品詳細ページ
Route::any('proDetails/{productsId}',['uses'=>'DetailsController@proDetails']);

//お気に入りに追加
Route::any('addWish',['uses'=>'WishController@addWish']);

//お気に入りから削除
Route::any('removeWish',['uses'=>'WishController@removeWish']);

//お気に入り一覧
Route::any('wishPage',['uses'=>'WishController@wishPage']);

//買い物カート一覧
Route::any('cartPage',['uses'=>'CartController@cartPage']);

//買い物カートに追加
Route::any('addCart',['uses'=>'CartController@addCart']);

//買い物カートから削除
Route::any('removeCart/{pid}',['uses'=>'CartController@removeCart']);

//ログイン判断　お気に入り、カート用
/*Route::group(['middleware'=>['autologin']],function(){
	//お気に入り、カートのルーター
});*/






