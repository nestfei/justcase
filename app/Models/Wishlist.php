<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table='wishlist';
		protected $primaryKey='id';
		protected $fillable=['userid','pid'];
}
