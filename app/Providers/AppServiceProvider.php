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
					$CateArray=[];
					foreach($parentCate as $value){
						$cateArray[$value->category_no]=$value->name;//連想配列
					}
					$subCate=DB::table('procategory')->where('parent_no','<>',0)->select('name','parent_no')->get();
					foreach($subCate as $value){
						$CateArray[$cateArray[$value->parent_no]][]=$value->name;//二次元連想配列
					}
					$view->with('CateArray',$CateArray);
				});
				
			//gobal design category
				view()->composer('*',function($view){
					$descate=DB::table('descategory')->select('name')->get();
					$descateArray=[];
					foreach($descate as $value){
						$descateArray[]=$value->name;
					}
					$view->with('descateArray',$descateArray);
				});
			
    }
}
