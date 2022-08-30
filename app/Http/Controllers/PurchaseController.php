<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
// use App\Models\getRemaingStocks();
// use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{


    public function checkout()
    {

        return view('cart');
    }



    public function storeOrderDetails(Request $request)
    {
        $purchase = new Purchase();
        $purchase->user_id =  Auth::user()->id;
        $purchase->address = $request->input('address');
        $purchase->city = $request->input('city');
        $purchase->country = $request->input('country');
        $purchase->post_code = $request->input('post_code');

        $purchase->phone = $request->input('phone');

        $purchase_id =  $purchase->save();


        foreach (session()->get('cart') as $cart) {

            $product = Product::find($cart['product_id']);

            $purchase_product = new PurchaseProduct();

            $data['product_id'] = $cart['product_id'];
            $data['purchase_id'] = $purchase->id;
            $data['user_id'] = $cart['user_id'];

            // $data['quantity'] = $product['stocks'] - $cart['quantity'];


            $data['quantity'] = $cart['quantity'];
            // $data['quantity'] = getRemaingStocks();

            $purchase_product->create($data);
            $product->stocks =  $product->stocks - $data['quantity'];
            // dd($product);
            $product->update();
        }
        $products = Product::latest()->paginate(15);


        session()->forget('cart');
        session()->flash("Cart has been cleared");


        return redirect()->route('homepage', [$products]);
    }


    public function index()
    {

        $products = Product::latest()->paginate(15);

        $purchases = Purchase::get();

        return view('purchase', ['purchases' => $purchases], ['products' => $products]);
    }
}
