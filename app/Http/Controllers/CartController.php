<?php

namespace App\Http\Controllers;


use App\Models\Cart;
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

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function cart()
    // {
    //     // dd($products);
    //     // dd((session('cart')));
    //     return view('cart');
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        // $category = Category::find($id);
        if (Auth::check()) {
            return redirect()->route('login', with('sucess', "please login first"));
        } else {

            $product = Product::find($id);
            // dd($product);



            $cart = session()->get('cart', []);
            // dd($cart);
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
        }
        // dd($cart[$id]);
        // $purchase = crea

        // array_push($cart,[]);


        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
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
