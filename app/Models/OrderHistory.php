<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $fillable=['product_id','order_history_id','qty'];
    use HasFactory;

    public function orders(){
        return $this->belongsToMany('App\Models\User','orders','order_id','user_id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
