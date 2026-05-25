<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = ['name', 'description', 'ingredients', 'recipe_steps', 'price', 'stock', 'image_url', 'is_published'];

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'desc');
    }
}
