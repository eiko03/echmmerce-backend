<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory,SearchableTrait;
    protected $fillable=['name','description','qty','price','image'];
    protected $searchable = [

        'columns' => [
            'products.name' => 10,
            'products.description' => 5,
        ]
    ];

}
