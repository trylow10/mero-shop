<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;



class CartController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products', compact('products'));
    }

    public function addToCart($id)
    {

        if (Auth::check()) {

            $product = Product::find($id);
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {

                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'product_id' => $product->id,
                    'user_id' => auth()->user()->id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image" => $product->image,
                    "description" => $product->description
                ];
            }

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } else {

            return redirect()->route('login')->with('sucess', 'please login first', session()->keep());
        }
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
            return true;
        } else {
            return false;
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
