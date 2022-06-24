<?php

namespace App\Models;

use App\Http\Controllers\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity', 'price', 'total'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
