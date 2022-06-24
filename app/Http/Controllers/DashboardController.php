<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseProduct;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function count()
    {
        $productCount = Product::all()->count();
        $userCount = User::all()->count();
        // $users = User::all();
        $purchaseCount = PurchaseProduct::all()->count();


        // dd($productcategory);
        return view('dashboard', compact('productCount', 'userCount', 'purchaseCount'));
    }

    // public function ()
    // {

    //     return view("layouts");
    // }
}
