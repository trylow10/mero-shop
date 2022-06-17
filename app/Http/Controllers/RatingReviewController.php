<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseProduct;
use App\Models\RatingReview;
use Illuminate\Http\Request;
// use Session;
use Illuminate\Support\Facades\Auth;


class RatingReviewController extends Controller
{


    public function store(Request $request)
    {
        $review = new RatingReview();
        $review->review = $request->review;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::user()->id;
        $review->star_rating = $request->rating;


        $review->save();

        // $reviews = RatingReview::orderBy('id', 'desc')->get();


        // dd($review);
        // return redirect()->route('review')->with('flash_msg_success', 'Your review has been submitted Successfully');
        return redirect()->back()->with('flash_msg_success', 'Your review has been submitted Successfully');
    }

    // public function view($id)
    // {
    //     $reviews = RatingReview::orderBy('id', 'desc')->get();
    //     return view('details', compact('reviews'));
    //     // return view('post.list', compact('posts'));
    //     // $review = RatingReview::find($id);
    //     // dd($review);
    // }

    // public function view($id)
    // {
    //     $post_detail = RatingReview::with('ReviewData')->find($id);
    //     return view('details', compact('post_detail'));
    // }
}
