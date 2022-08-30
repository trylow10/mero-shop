<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchases') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-indigo-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            {{-- <a href="addProduct" class="my-6 p-6 add-product-btn">Add Product</a>
            <span>{{$products->links()}} </span> --}}
            <div class="mar-top-bott bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-nowrap table-auto">
                    <thead>
                        <tr class="font-bold text-left">
                            <!--Re usable component defined in component table-column -->
                            <x-table-column>Username</x-table-column>
                            <x-table-column>Product Name</x-table-column>
                            <x-table-column>Price</x-table-column>
                            <x-table-column>Quantity</x-table-column>
                            <x-table-column>Category</x-table-column>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($purchases as $purchase)
                            <tr>
                                <x-table-column>{{ $purchase->user->name }}</x-table-column>
                        @endforeach
                        @foreach ($purchase->product as $product)
                            {{-- {{ dd($purchase->product) }} --}}
                            <x-table-column>{{ $product->name }}</x-table-column>
                            <x-table-column>{{ $product->price }}</x-table-column>
                            <x-table-column>{{ $product->stocks }}</x-table-column>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
