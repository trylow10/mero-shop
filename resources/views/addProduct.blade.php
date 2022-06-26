<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <section class="p-6">
        <main class="max-w-lg mx-auto mt-10">
            <form method="POST" action="product" enctype="multipart/form-data">
                @csrf
                <div class="text-center p-3 form-margin">
                    <input class="border border-gray-400 p-2 w-full" type="text" name="name"
                        placeholder="Product Name" required></input>
                </div>


                <div class="text-center p-3 form-margin">
                    <input class="border border-gray-400 p-2 w-full" type="text" name="description"
                        placeholder="Product Description" required></input>

                </div>



                <!-- pages/Duration/Gameing Info -->


                <!-- Image -->


                <div class="text-center p-3 form-margin">
                    <input class="border border-gray-400 p-2 w-full" type="text" name="price"
                        placeholder="Product Price" required></input>

                </div>
                <div class="text-center p-3 form-margin">
                    <input class="border border-gray-400 p-2 w-full" type="number" name="stocks"
                        placeholder="Availabe in Inventory" />

                </div>
                <div class="panel-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>

                        @foreach (Session::get('images') as $image)
                            <img src="images/{{ $image['image'] }}" width="300px">
                        @endforeach
                    @endif


                    <div class="mb-3">
                        <label class="form-label" for="inputImage">Select Images:</label>
                        <input type="file" name="images[]" id="inputImage" multiple
                            class="form-control @error('images') is-invalid @enderror">

                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                </div>

                <div class="text-center p-3 form-margin">
                    <select name="category_id[]" multiple
                        class="p-6 w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="Select a Category">Select a Category</option>
                        @php
                            $categories = App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                        @endforeach


                    </select>
                </div>
                <div class="text-center p-3 form-margin">
                    <input class="border border-gray-400 p-2 w-full" type="number" name="discount"
                        placeholder="Discount" />

                </div>

                <div class="text-center mb-6">
                    <button
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </section>

</x-app-layout>
