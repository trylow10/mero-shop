<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        return $this->belongsToMany(Product::class, 'purchase_products');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // public function getRemaingStocks()
    // {

    //     return DB::where('id', 5)->get('stocks') - $this->quantity;

    // }
}
