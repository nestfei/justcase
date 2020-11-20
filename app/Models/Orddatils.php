<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orddatils extends Model
{
    protected $table='orddetails';
		protected $primaryKey='id';
	
		protected $fillable=['userid','products_id','quantity'];
}
