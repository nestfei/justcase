<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
/*use App\Models\Procategory;
use App\Models\Descategory;*/
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       //電話番号の正規表現（10桁か11桁）
			\Validator::extend('phone',function($attribute,$value,$parameters,Validator $validator){
					return $validator->validateRegex($attribute,$value,['/^(0{1}\d{9,10})$/']);
				});
			
			//gobal cookie
			/*$view->with('変数名',\request()->cookie('cookie名'));*/
			view()->composer('*',function($view){
				$view->with('lastname',\request()->cookie('lastname_cookie'));
				/*$view->with('uid',\request()->cookie('uid_cookie'));*/
			});
				
			//gobal phone category date
				view()->composer('*',function($view){
					$parentCate=DB::table('procategory')->where('parent_no','=',0)->select('name','category_no')->get();
					$cateIdArray=[];
					$cateNameArray=[];
					foreach($parentCate as $value){
						$cateNameArray[$value->category_no]=$value->name;//親機種名　連想配列
						$cateIdArray[$value->category_no]=[];//親機種id　連想配列
					}
					$subCate=DB::table('procategory')->where('parent_no','<>',0)->select('name','parent_no','category_no')->get();
					foreach($subCate as $value){
						$cateNameArray[$value->category_no]=$value->name;//機種名　連想配列
						$cateIdArray[$value->parent_no][]=$value->category_no;//機種id 二次元配列
					}
					$view->with('cateNameArray',$cateNameArray)->with('cateIdArray',$cateIdArray);
				});
				
			//gobal design category date
				view()->composer('*',function($view){
					$descate=DB::table('descategory')->select('name','category_no')->get();
					$descateIdArray=[];
					$descateNameArray=[];
					foreach($descate as $value){
						$descateIdArray[]=$value->category_no;//デザインid
						$descateNameArray[$value->category_no]=$value->name;//デザイン名　連想配列
					}
					$view->with('descateNameArray',$descateNameArray)->with('descateIdArray',$descateIdArray);
				});
    }
}
