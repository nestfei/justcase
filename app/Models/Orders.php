<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table='orders';
		protected $primaryKey='id';
	
		protected $fillable=['uid','states_id'];
}
