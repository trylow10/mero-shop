<?php

namespace App\Models;

use App\Http\Controllers\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query
                ->whereHas('category', fn ($query) =>
                $query->where('name', $category))
        );
    }

    public function category()
    {

        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function purchase()
    {

        return $this->belongsToMany(Purchase::class, 'purchase_products');
    }


    public function run()
    {

        Product::factory()
            ->count(20)

            ->create();
    }
}
