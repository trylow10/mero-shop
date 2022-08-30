<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\RatingReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    use HasFactory;


    public function imgshow($id)
    {

        $product = Product::find($id);

        $images = json_decode($product->image, true);

        $reviews = RatingReview::where('product_id', $product->id)->get();

        $avgStar = RatingReview::avg('star_rating');

        return view('details', compact('images', 'product', 'reviews', 'avgStar'));
    }

    public function create()
    {

        return view('addproduct');
    }


    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->description = $request->input('description');
        $product->stocks = $request->input('stocks');
        // $product->update();

        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = [];

        if ($image = $request->file('images')) {
            foreach ($request->images as $key => $image) {

                $imageType = $image->getClientOriginalExtension();
                $imageName = time() . rand(1, 99) . '.' . $imageType;
                $image->move('Uploads/products/', $imageName);

                $images['image' . $key] = $imageName;
            }

            $product->image = json_encode($images);
        }
        $product->save();
        $category = Category::find($request->category_id);
        $product->category()->attach($category);

        return redirect()->route('products')->with('success', 'Product has been Added.');
    }


    public function show()
    {
        $products = Product::latest()->paginate(15);
        return view('products', ['products' => $products]);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('editProduct', compact('product'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');
        $product->stocks = $request->input('stocks');
        $product->description = $request->input('description');
        $images = [];

        if ($image = $request->file('images')) {
            foreach ($request->images as $key => $image) {

                $imageType = $image->getClientOriginalExtension();
                $imageName = time() . rand(1, 99) . '.' . $imageType;
                $image->move('Uploads/products/', $imageName);

                $images['image' . $key] = $imageName;
            }

            $product->image = json_encode($images);
        }

        // $product->save();

        $category = Category::find($request->category_id);

        $product->category()->sync($category);

        $product->update();


        return redirect()->route('products')->with('success', 'Product has been Edited.');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $destination = 'Uploads/products/' . $product->Image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        return back()->with('success', 'Product has been Deleted.');
    }

    public function showProduct(Request $request)
    {
        // dd("lochn");
        $search = $request->input('search');
        // dd($search);
        // search filter
        if (request('search')) {
            $products = Product::latest()->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')->paginate(15);
            $categories = Category::get();


            return view('welcome', compact('products', 'categories'));
        } else {
            // $products = Product::filter(request(['category']))->paginate(15);
            $products = Product::all();
            // dd($products);

            foreach ($products as $product) { {

                    $categories = Category::get();
                    $product['avgStar'] = RatingReview::where('product_id', $product->id)->avg('star_rating');

                    // dd($product);
                }
            }
            return view('welcome', compact('products'));
        }
    }
    // NEWS LETTER

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when(
    //         $filters['category'] ?? false,
    //         fn ($query, $category) =>
    //         $query
    //             ->whereHas('category', fn ($query) =>
    //             $query->where('name', $category))
    //     );
    // }
    public function scopeFilter($query, array $filters)
    {


        // Retrieve posts with at least one comment containing words like code%...
        $relateds = Product::whereHas('category', function (Builder $query) {
            $query->where('content', 'like', 'fav%');
        }, '>=', 2)->get();

        return view('details', compact('relateds'));

        // Retrieve posts with at least ten comments containing words like code%...
        //     $posts = Post::whereHas('comments', function (Builder $query) {
        //         $query->where('content', 'like', 'code%');
        //     }, '>=', 10)->get();
        // }

        // // $product= Product::with('categories')->findOrFail(1);


    }





    public function newsLetter()
    {
        request()->validate(['email' => 'required|email']);
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
        try {
            $response = $mailchimp->lists->addListMember(config('services.mailchimp.lists.subscribers'), [
                'email_address' => request('email'),
                'status' => 'subscribed'
            ]);
        } catch (\Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be sent to our Newsletter.'
            ]);
        }
        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }
}
// if ($product->stock > 0) {
//     dd('available');
// } else {
//     dd('out of stock');
// }
