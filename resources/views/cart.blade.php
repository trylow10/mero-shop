@extends('layouts.cart_layout')
@extends('homeheader')



@section('content1')
{{-- @section('nav') --}}

<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            {{-- <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div> --}}
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
    <tfoot>
        {{-- <tr>
            <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
        </tr> --}}
        {{-- <tr>
            <td colspan="5" class="text-right">
                <a href="{{ route('checkout')}}"><button class="btn btn-success">Checkout</button></a>
            </td>
        </tr> --}}
    </tfoot>
    <a href="{{ route('homepage')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
</table>
@endsection

@section('scripts')
<script type="text/javascript">

    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
            </div>
        </div>
        <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <header class="card-header">
                            <h4 class="card-title mt-2">Billing Details</h4>
                        </header>
                        <article class="card-body">
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->name;}}">
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="country">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label>Post Code</label>
                                    <input type="text" class="form-control" name="post_code">
                                </div>
                                <div class="form-group  col-md-6">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{Auth::user()->email;}}" disabled>
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            {{-- <div class="form-group">
                                <label>Order Notes</label>
                                <textarea class="form-control" name="notes" rows="6"></textarea>
                            </div> --}}
                        </article>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <header class="card-header">
                                    <h4 class="card-title mt-2">Your Order</h4>
                                </header>
                                @php $total = 0 @endphp
                                @if(session('cart'))
                                <dt>Total cost: </dt>
                                    @foreach(session('cart') as $id => $details)
                                    <article class="card-body">
                                        <dl class="dlist-align">

                                            <dd class="h5 b text-center">

                                                @php $total += $details['price'] * $details['quantity']; @endphp
                                            {{-- <dd class="text-right h5 b"> {{ config('settings.currency_symbol') }}{{ Purchase::getSubTotal() }} </dd> --}}
                                        </dd>


                                        @endforeach
                                        <dd class="h5 b text-center">${{ $total }}
                                        </dd>
                                        {{-- {{ $details['price'] * $details['quantity'] }} --}}

                                        @endif
                                    </dl>
                                </article>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            {{-- <a href="{{ route('checkout')}}" --}}
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block">Place Order</button></a>
                                {{-- <a href="{{ route('checkout')}}" class="btn btn-success"><button class="fa fa-angle-left"></button> Purchase </a> --}}

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
