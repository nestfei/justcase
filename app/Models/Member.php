<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table='members';//テーブル名
		protected $primaryKey='id';
		protected $fillable=['lastname','firstname','lastname_huri','firstname_huri','password','email'];
}
