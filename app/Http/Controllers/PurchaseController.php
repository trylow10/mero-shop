<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
// use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{


    public function checkout()
    {

        return view('cart');
    }

    //     $purc = session()->get('cart');
    //     if (isset($cart[$request->id])) {
    //         session()->put('cart', $cart);
    //     }
    // }
    // }

    public function storeOrderDetails(Request $request)
    {
        // dd($request);
        $purchase = new Purchase();
        $purchase->user_id =  Auth::user()->id;
        $purchase->address = $request->input('address');
        $purchase->city = $request->input('city');
        $purchase->country = $request->input('country');
        $purchase->post_code = $request->input('post_code');

        $purchase->phone = $request->input('phone');



        $purchase_id =  $purchase->save();


        foreach (session()->get('cart') as $cart) {

            // dd($cart);
            // $data= Auth::user()->id;
            // dd(getType($cart));
            $purchase_product = new PurchaseProduct();
            $data['product_id'] = $cart['product_id'];
            $data['user_id'] = $cart['user_id'];
            /*fillable*/
            $data['quantity'] = $cart['quantity'];

            $data['purchase_id'] = $purchase_id;

            $purchase_product->create($data);
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
