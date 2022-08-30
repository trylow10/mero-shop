@include('homeheader')

<body>
    @extends('layouts.review_layout')
    <div class="container-fluid pt-5">
        <div class="card-header text-center">
            <h5>Products</h5>
        </div>
        <div class="row mt-5" style="justify-content:center">
            <div class="col-md-3 ">
                <div id="carouselExampleControls" class="carousel slide container border" data-bs-ride="carousel">
                    <img class="card-img-top">

                    <div class=" carousel-inner">

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
                    <h5 class="card-title">

                        <p class="mt-1">
                            @for ($i = 1; $i <= $avgStar; $i++)
                                <span><i class="fa fa-star text-warning"></i></span>
                            @endfor

                        </p>
                    </h5>
                    <h5 class="card-title">{{ $product->name }}</h5>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body text-center">
                    <ul class="unstyled" style="list-style-type:none">
                        <li style="text-decoration:line-through">old price {{ $product->price }}<br></li>
                        <li style="color:green">discount: {{ $product->discount }}%<br></li>
                        <li style="color:red"> discouted price
                            {{ $product->getDicountedPriceAttribute() }}
                        </li>
                    </ul>
                    <h6> Description
                        <p class="card-text">{{ $product->description }}</p>
                    </h6>
                    @if (session('cart'))
                        @foreach (session('cart') as $id => $details)
                            <div style="display: flex;gap:25px">

                                <input data-id={{ $product->id }} type="number"
                                    value=" @php $details['quantity']  @endphp"
                                    class="form-control quantity update-cart" style="width:15%" min="1" />
                        @endforeach
                    @endif
                    <p id="cart_message"></p>
                    <div class="row" style="width: 25% ">
                        <div class="col-lg-12 col-sm-12 col-12 text-center cart">
                            <a href="{{ route('add.to.cart', $product->id) }}"
                                class="btn btn-warning btn-block text-center" style="color: white">Add
                                to Cart</a>
                        </div>
                    </div>
                </div>

                @section('scripts')
                    <script type="text/javascript">
                        $(".update-cart").change(function(e) {
                            e.preventDefault();

                            var ele = $(this);

                            $.ajax({
                                url: '{{ route('update.cart') }}',
                                method: "patch",
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: ele.data('id'),
                                    quantity: ele.val()
                                },
                                success: function(response) {
                                    if (response == true) {
                                        $("#cart_message").html("update")
                                    }
                                }
                            });
                        });

                        $(".remove-from-cart").click(function(e) {
                            e.preventDefault();

                            var ele = $(this);

                            if (confirm("Are you sure want to remove?")) {
                                $.ajax({
                                    url: '{{ route('remove.from.cart') }}',
                                    method: "DELETE",
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        id: ele.parents("tr").attr("data-id")
                                    },
                                    success: function(response) {
                                        window.location.reload();
                                    }
                                });
                            }
                        });
                    </script>

                </div>

            </div>
        </div>
        <div class="row absolute">
            {{-- <div class="leftcolumn"> --}}
            <div class="card">

                <!-- Review store Section -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
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
                                            <input type="radio" checked id="star4" class="rate" name="rating"
                                                value="4" />
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

        {{-- @foreach (relateds as $related)
            {{ $related }}
        @endforeach --}}

        <div class="row">

            <div class="card">

                <hr>

                <div class="row1">

                    <div class="card">


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
                                                    @endfor

                                                </p>

                                                <span class="font-weight-bold ml-2">{{ $review->review }}</span>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

    </body>

    </html>
