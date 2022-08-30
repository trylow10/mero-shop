<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'quantity',
        'product_id',
        'purchase_id',
    ];

    // public function getRemaingStocks()
    // {

    //     return $this->stocks - $this->quantity;
    // }
}
