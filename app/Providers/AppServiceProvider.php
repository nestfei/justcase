<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    }
}
