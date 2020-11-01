<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartlist extends Model
{
    protected $table='cartlist';
		protected $primaryKey='id';
		protected $fillable=['userid','pid'];
	
		public function cartInfo(){
			return $this->hasMany(Products::class,'id','pid');
		}
}
