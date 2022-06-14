<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use HasFactory;

    // -----------------------------------------------------------------
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function imgshow($id)
    {
        // $sql = Product::all()->where('id', 1);
        // dd($sql);
        $product = Product::find($id);
        // $products = Product::find();
        // dd($id);

        // foreach ($products as $product) {
        //     dd($products);

        // dd($image);
        $images = json_decode($product->image, true);

        // dd($images);
        // dd($test);

        // foreach ($test as $images) {


        //     // return view("images");
        return view('images', ['images' => $images], ['product' => $product]);
    }

    // public function getDicountedPriceAttribute()
    // {
    //     return $this->price * (1 - $this->discount / 100);
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('here');
        // $product = new Product();
        // dd($product);

        return view('addproduct');
    }


    public function store(Request $request)
    {
        $product = new Product();
        // $product->id = auth()->user()->id;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        // $product->title = $request->input('title');
        // $product->otherinfo = $request->input('otherinfo');
        // if ($request->hasfile('image')) {
        //     $file = $request->file('image');
        //     $filetype = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $filetype;
        //     $file->move('Uploads/products/', $filename);
        //     $product->image = $filename;
        // }

        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = [];

        if ($image = $request->file('images')) {
            foreach ($request->images as $key => $image) {
                // dd($image);

                // dd($image->getClientOriginalExtension());
                $imageType = $image->getClientOriginalExtension();
                $imageName = time() . rand(1, 99) . '.' . $imageType;
                $image->move('Uploads/products/', $imageName);

                $images['image' . $key] = $imageName;
            }
            // $data = $request->only('images');
            $product->image = json_encode($images);
            // Product::insert($images);
            // dd($images);
        }


        // $product->productprice = $request->input('productprice');
        // $product->category;

        // dd($product);

        $product->save();
        // $category = Category::
        $category = Category::find($request->category_id);
        // // dd($product);
        // // dd($category);

        $product->category()->attach($category);
        // dd($product->category);

        // dd($product);




        return redirect()->route('products')->with('success', 'Product has been Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products = Product::latest()->paginate(15);

        // dd($products->category);

        return view('products', ['products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('editProduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        if ($request->hasfile('image')) {

            $destination = 'Uploads/products/' . $product->Image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $filetype = $file->getClientOriginalExtension();
            $filename = time() . '.' . $filetype;
            $file->move('Uploads/products/', $filename);
            $product->image = $filename;
        }
        // $product->price = $request->input('price');
        // $product->category_id = $request->input('category_id');
        $product->update();
        return redirect('products')->with('success', 'Product has been Edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            $products = Product::filter(request(['category']))->paginate(15);

            foreach ($products as $product) { {

                    $categories = Category::get();

                    // foreach($product->category as $category){

                    // $product['category']= $category->name;

                    //  dd($product);
                    // $product =

                    // $category=[];

                    // array_push($category,$product);


                    //  dd($product);

                    // $category = [];

                    // dd($product);
                    // array_push($category,'category');
                    // }
                }
                // dd($products);
                // dd($product);


                // dd($category);

                //     $product = $category->name;
                //  dd($categories);


            }
            return view('welcome', compact('products'));
        }
    }
    // NEWS LETTER
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
