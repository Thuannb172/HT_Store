<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = ['name', 'price_nomal', 'price_sale', 'description', 'content', 'image', 'images'];
}
