<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'address',
        'phone',
        'country',
        'post_code',
        'city'


    ];
    public function product()
    {
        // return $this->hasMany(Product::class,);

        return $this->belongsToMany(Product::class, 'purchase_products');
    }
    public function user()
    {
        return $this->hasMany(Purchase::class, 'purchase_products');

        // return $this->hasMany(Auth::class, 'purchase_products');
    }
}
