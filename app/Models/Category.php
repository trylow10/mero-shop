<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        // return $this->hasMany(Product::class,);

        return $this->belongsToMany(Product::class, 'category_product');
        // return $this->belongsToMany(Product::class, 'category_id');
    }
    public function run()
    {
        Category::factory()
            ->count(20)
            ->create();
    }
}
