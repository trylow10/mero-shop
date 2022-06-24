<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <style>
        ul.no-bullets {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        /* .container {
            overflow: auto;
            display: flex;
            scroll-snap-type: x mandatory;

        } */
    </style>
</head>


<body>
    {{-- @section('scripts') --}}
    {{-- @include('layouts.cart_layout') --}}
    @include('homeheader')
    @extends('layouts.review_layout')
    <div class="container-fluid pt-5">
        <div class="card-header text-center">
            <h5>Products</h5>
        </div>
        <div class="row mt-5">
            <div class="col-md-3 ">
                <div id="carouselExampleControls" class="carousel slide container border" data-bs-ride="carousel">
                    <img class="card-img-top">
                    <div class=" carousel-inner">
                        {{-- {{ dd($images) }} --}}
                        {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

                        @foreach ($images as $key => $image)
                            <div class="carousel-item  {{ $key == 'image0' ? 'active' : '' }}">
                                <img src="{{ asset('Uploads/products/' . $image) }}" class="img-fluid" alt="..."
                                    height="30%" />
                            </div>
                        @endforeach
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body text-center">

                    <h5 class="card-title">

                        <p class="mt-1">
                            @for ($i = 1; $i <= $avgStar; $i++)
                                <span><i class="fa fa-star text-warning"></i></span>
                                {{-- {{ $review->star_rating }} --}}
                            @endfor
                            {{-- <span class="font ml-2">{{ $review->email }}</span> --}}
                        </p>
                    </h5>


                    <h5 class="card-title">{{ $product->name }}</h5>



                    <ul class="no-bullets">
                        <li c>old price {{ $product->price }}<br></li>
                        <li>discount percent {{ $product->discount }}%<br></li>
                        <li> discouted price price
                            {{ $product->getDicountedPriceAttribute() }}
                        </li>
                    </ul>


                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center cart">
                            <a href="{{ route('add.to.cart', $product->id) }}"
                                class="btn btn-warning btn-block text-center">Add to cart</a>
                        </div>
                    </div>

                    <h6> Description
                        <p class="card-text">{{ $product->description }}</p>
                    </h6>
                </div>

            </div>
        </div>
        <div class="row absolute">
            <div class="leftcolumn">
                <div class="card">

                    <!-- Review store Section -->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-10 mt-4 ">
                                <form class="py-2 px-4" method="post" action="{{ route('review.store') }}">
                                    @csrf
                                    {{-- action="{{ route('review.store') }}"
                                        style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off"> --}}
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="row justify-content-end mb-1">
                                        <div class="col-sm-8 float-right">
                                            @if (Session::has('flash_msg_success'))
                                                <div class="alert alert-success alert-dismissible p-2">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                        aria-label="close">&times;</a>
                                                    <strong>Success!</strong> {!! session('flash_msg_success') !!}.
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="font-weight-bold ">Submit Review</p>

                                    <div class="form-group row">

                                        <div class="col-sm-6">
                                            <div class="rate">
                                                <input type="radio" id="star5" class="rate" name="rating"
                                                    value="5" />
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" checked id="star4" class="rate"
                                                    name="rating" value="4" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" class="rate" name="rating"
                                                    value="3" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" class="rate" name="rating"
                                                    value="2">
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" class="rate" name="rating"
                                                    value="1" />
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-2">
                                        <div class="col-sm-12 ">
                                            <textarea class="form-control" name="review" rows="6 " placeholder="Review" maxlength="200"></textarea>
                                        </div>

                                    </div>

                                    <div class="mt-3 ">
                                        <button type="submit" class="btn btn-sm py-1 px-2 btn-info">Submit
                                        </button>
                                        {{-- <button type="button" class="btn-close" aria-label="Close"></button> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    {{-- </div> --}}

    <!-- Display review section start -->
    <div class="row">
        {{-- <div class="leftcolumn"> --}}
        <div class="card">
            {{-- <p style="color:#e91e63;">Published at : {{ $post_detail->created_at->format('jS \\of F Y') }}</p> --}}
            {{-- <p>{{ $post_detail->description }}</p> --}}
            <hr>
            <!-- Display review section start -->
            <div class="row1">
                {{-- <div class="leftcolumn"> --}}
                <div class="card">
                    {{-- <p style="color:#e91e63;">Published at : {{ $post_detail->created_at->format('jS \\of F Y') }}</p> --}}
                    {{-- <p>{{ $post_detail->description }}</p> --}}
                    <hr>
                    <!-- Display review section start -->
                    <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                        <div>
                            <div class="row mt-5">
                                <h4 clas>Reviews :</h4>
                                <div class="col-sm-12 mt-5">
                                    @foreach ($reviews as $review)
                                        <div class=" review-content">
                                            <img src="https://www.w3schools.com/howto/img_avatar.png" class="avatar"
                                                height="50" width="50">
                                            <span
                                                class="font-weight-bold ml-2">{{ $review->user = Auth::user()->name }}</span>
                                            <p class="mt-1">
                                                @for ($i = 1; $i <= $review->star_rating; $i++)
                                                    <span><i class="fa fa-star text-warning"></i></span>
                                                    {{-- {{ $review->star_rating }} --}}
                                                @endfor
                                                {{-- <span class="font ml-2">{{ $review->email }}</span> --}}
                                            </p>

                                            <span class="font-weight-bold ml-2">{{ $review->review }}</span>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endsection --}}
</body>

</html>
