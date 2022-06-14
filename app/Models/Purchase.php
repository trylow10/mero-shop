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
        'city',
        'user_id'


    ];
    public function product()
    {
        // return $this->hasMany(Product::class,);

        return $this->belongsToMany(Product::class, 'purchase_products');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');

        // return $this->hasMany(Auth::class, 'purchase_products');
    }
}
