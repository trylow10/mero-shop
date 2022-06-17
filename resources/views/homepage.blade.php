@extends('layouts.cart_layout')

@section('content1')
    <section class="section-hero">
        <div class="hero">
            <div class="hero-text-box">
                <h1 class="heading-primary">
                    A nice collection delivered to your door, every single day
                </h1>
                <p class="hero-description">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias possimus reprehenderit, architecto
                    inventore tempora asperiores! Sit facilis reiciendis harum odit hic enim blanditiis?
                </p>
                <a href="#" class="btn btn--full margin-right-sm">Buy Now</a>

                <a href="#" class="btn btn--outline">Learn more &darr;</a>
            </div>
            <div class="hero-img-box">
                <picture>
                    <img src="./Images/Hero.png" class="hero-img" alt="images of book cd and game" />
                </picture>
            </div>
        </div>
    </section>
    <!--Services   -->

    <div class="services">
        <h1>Category</h1>
        <div class="cen">
            <a href="http://127.0.0.1:8000/?category=books">
                <div class="service">
                    <i class="fa fa-book"></i>
                    <h2>Book</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </a>

            <a href="http://127.0.0.1:8000/?category=games">
                <div class="service">
                    <i class="fa fa-gamepad"></i>
                    <h2>Game</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </a>


            <a href="http://127.0.0.1:8000/?category=cd">
                <div class="service">
                    <i class="fa fa-play-circle"></i>
                    <h2>Cd</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Ends Services -->
    {{-- @foreach ($categories as $category)
   {{dd($category)}}
  <a href="#">{{$category->name}}</a>
  @endforeach --}}


    {{-- @if ($nr >= 1 && $nr <= 1) --}}

    <!-- Products -->
    <h1 class="text-center p-3" style="font-size: 20px">PRODUCTS</h1>
    <div class="products">
        <!-- Product -->
        @foreach ($products as $product)
            <div class="product-card">
                old price {{ $product->price }}<br>
                discount percent {{ $product->discount }}%<br>
                discouted price price {{ $product->getDicountedPriceAttribute() }}

                <img src="{{ asset('Uploads/products/' . $product->image) }}" alt="product image"
                    class="product-img" />
                <a href="{{ route('details', $product->id) }}" <h4 class=" product-title">{{ $product->name }}</h4>
                </a>

                {{-- <p class="card-desc">{{$product->title}}</p> --}}

                <p class="product-category">

                    @foreach ($product->category as $category)
                        {{ $category->name }}
                </p>

                {{-- {{$product->name}} --}}
                {{-- {{ $product['category']-> $category->name}} --}}
        @endforeach
        <p class="product-price">${{ $product->price }}</p>
        {{-- <button class="buy-now">Buy Now</button> --}}
        <p class="btn-holder">
            <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center"
                role="button">Add to cart</a>
        </p>
    </div>
    @endforeach
    <!-- product Ends -->
    </div>
    <span class="text-center">{{ $products->links() }}</span>
@endsection
{{-- @yield('home') --}}
