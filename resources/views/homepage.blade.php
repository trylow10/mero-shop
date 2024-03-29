{{-- @include('homeheader') --}}
@include('homeheader')
@extends('layouts.review_layout')


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
@if (session('sucess'))
    {{ session('sucess') }}
@endif
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


<h1 class="text-center p-3" style="font-size: 20px">PRODUCTS</h1>
<div class="products">
    <!-- Product -->

    @foreach ($products as $product)
        <div class="product-card">
            old price {{ $product->price }}<br>
            discount percent {{ $product->discount }}%<br>
            {{-- discouted price price {{ $product->getDicountedPriceAttribute() }} --}}

            <img src="{{ asset('Uploads/products/' . $product->image[0]) }}" class="product-img" alt="product img"
                height="30%" />
            <a href="{{ route('details', $product->id) }}" <h4 class="product-title">{{ $product->name }}</h4>
            </a>

            {{-- <p class="card-desc">{{$product->title}}</p> --}}
            <p class="mt-1">
                @for ($i = 1; $i <= $product->avgStar; $i++)
                    <span><i class="fa fa-star text-warning"></i></span>
                @endfor

            </p>
            <p class="product-category">

                @foreach ($product->category as $category)
                    {{ $category->name }}<br>
                @endforeach
            </p>
            {{-- {{ dd(getRemaingStocks()) }} --}}
            <p class="product-price">Rs.{{ $product->getDicountedPriceAttribute() }}</p>
            {{ $product->stocks }}
            {{ $product->stocks > 0 ? 'in stocks' : 'out of stock' }}
            <p class="product-price"></p>

            @if ($product->stocks > 0)
                <p class="btn-holder">

                    <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center "
                        role="button">Add to cart</a>
                </p>
            @else
                <p class="btn-holder">

                    <a href="#" class="btn btn-warning btn-block text-center" style="cursor: not-allowed"
                        role="button">Add to
                        cart</a>
                </p>
            @endif
        </div>
    @endforeach
    <!-- product Ends -->
</div>


<!-- Create Post Form -->
{{-- <span class="text-center">{{ $products->links() }}</span> --}}
{{-- @endsection
@endsection --}}
