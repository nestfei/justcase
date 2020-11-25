<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orddetails extends Model
{
    protected $table='orddetails';
		protected $primaryKey='id';
		protected $fillable=['oid','uid','products_id','quantity','price'];
		public function orderInfo(){
			return $this->hasMany(Products::class,'id','products_id');
		}
}
