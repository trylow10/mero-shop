<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}

            <a href="addProduct" class="my-6 p-6 add-product-btn">Add Product</a>

        </h2>
    </x-slot>

    {{ session('sucess') }}
    <div class="py-12 bg-indigo-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <span>{{ $products->links() }} </span>
            <div class="mar-top-bott bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full whitespace-nowrap table-auto">
                    <thead>
                        <tr class="font-bold text-left">
                            <!--Re usable component defined in component table-column -->
                            <x-table-column>Name</x-table-column>
                            <x-table-column>Description</x-table-column>
                            <x-table-column>Available in inventory</x-table-column>
                            <x-table-column>Price</x-table-column>
                            <x-table-column>Discount %</x-table-column>
                            <x-table-column>Image</x-table-column>
                            <x-table-column>Category</x-table-column>
                            <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <x-table-column>{{ $product->name }}</x-table-column>
                                <x-table-column>{{ $product->description }}</x-table-column>
                                <x-table-column>{{ $product->stocks }}</x-table-column>
                                <x-table-column>{{ $product->price }}</x-table-column>
                                <x-table-column>{{ $product->discount }}</x-table-column>
                                <x-table-column> <img src="{{ asset('Uploads/products/' . $product->Image) }}"
                                        width="70px" height="70px" alt="Product Image"></x-table-column>
                                {{-- <x-table-column>{{$product->productprice}}</x-table-column> --}}
                                <x-table-column>
                                    @foreach ($product->category as $category)
                                        {{ $category->name }}</p>
                                    @endforeach
                                </x-table-column>

                                <x-table-column><a href={{ 'product/edit/' . $product['id'] }}
                                        class="edit-btn">Edit</a></x-table-column>
                                <x-table-column>
                                    <form action="products/{{ $product->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-btn">Delete</button>
                                    </form>
                                </x-table-column>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
