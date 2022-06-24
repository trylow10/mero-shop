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
        // if (Auth::check()) {
        // } else if (true) {
        //     return redirect()->route('login', with('sucess', "please login first"));
        // } else {

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
        // $purchase-> = $request->input('country');
        $purchase->phone = $request->input('phone');

        // $purchase->cart = session()->get('cart');

        // $cart_json = json_encode($purchase->cart);

        // $cart1 = json_decode($cart_json);

        // $purchase->cart = $cart_json;



        // dd($purchase);

        $purchase_id =  $purchase->save();
        // dd($purchase_id);

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
            // $data['quantity'] = $cart->quantity;
            // $data['total'] = $cart->total;

            // dd($c);

            // dd($data);
            $purchase_product->create($data);
        }

        $products = Product::latest()->paginate(15);

        // dd($products->category);
        session()->forget('cart');
        session()->flash("Cart has been cleared");

        // $products = Product::latest()->paginate(15);

        // dd($products->category);
        // dd('here');
        // return view('products', ['products' => $products]);\
        // return redirect()->intended('homepage', with(['products' => $products]));
        // return redirect()->route('homepage', with(['products' => $products]));
        return redirect()->route('homepage', [$products]);
        // return redirect('homepage', compact('products'));
    }



    // $product = Product::all();
    // $product->cart()->attach($cart);


    // return redirect('home')->with('success', 'checkout has been done.');
    public function index()
    {
        // $products = Product::filter(request(['category']))->paginate(15);
        $products = Product::latest()->paginate(15);
        // // dd($products[0]);
        // $users = Purchase::latest()->paginate(15);
        // $purchases = Purchase::all();
        // $purchases = PurchaseProduct::latest()->paginate(15);
        $purchases = Purchase::get();
        // dd($products);

        //     }
        // }
        // return view('purchase', ['purchases' => $purchases], ['products' => $products], ['purchaseproduct' => $purchase_product]);
        return view('purchase', ['purchases' => $purchases], ['products' => $products]);
    }
}
    // return view('homepage');

//         $order = Purchase::create([
//             // // 'order_number'      =>  'ORD-'.strtoupper(uniqid()),
//             // 'cart_id' => $request->id,
//             'user_id'           => auth()->user()->id,
//             'product_id'         => $cart->id,
//             // 'total'       =>
//             // 'payment_status'    =>  0,
//             // 'payment_method'    =>  null,
//             // 'name'           =>    $request['name'],
//             'address'           => $request['address'],
//             'city'              => $request['city'],
//             'country'           => $request['country'],
//             'post_code'         => $request['post_code'],
//             'phone'             => $request['phone_number'],
//         ]);
//         dd($order);
//     }
// }
