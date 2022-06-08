<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>
    <section class="p-6">
      <main class="max-w-lg mx-auto mt-10">
          <form  method="POST" action="{{ url('editproduct/'.$product->id) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$product->id}}" ></input>
            <div class="text-center p-3 mb-2 form-margin">
                <input class="border border-gray-400 p-2 w-full"
                type="text"
                name="name"
                value="{{$product->name}}"
                placeholder="Product Name"
                required
                  ></input>
            </div>



                      <!-- title or slug-->

                <!-- pages/Duration/Gameing Info -->

                <div class="text-center p-3 form-margin">
                <input class="border border-gray-400 p-2 w-full"
                type="text"
                name="description"
                placeholder="description"
                value="{{$product->description}}"
                required
                  ></input>
            </div>
                      <!-- Image -->
                      <div class="text-center p-3 form-margin">
                 <img src="{{ asset('Uploads/products/'.$product->image) }}" width="70px" height="70px" alt="Product Image">
                <input class="border border-gray-400 p-2 w-full"
                type="file"
                name="image"
                  ></input>
            </div>

            <div class="text-center p-3 form-margin">
                <input class="border border-gray-400 p-2 w-full"
                type="number"
                min="1"
                name="price"
                placeholder="Product Price"
                value="{{$product->price}}"
                required
                ></input>
            </div>

            <div class="text-center p-3 form-margin">
                <select name="category_id" class="p-3 w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                  <option value="Select a Category" disabled >Select a Category</option>
                  @php
                  $categories = App\Models\Category::all();
                  @endphp
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{ucwords($category->name)}}</option>
                  @endforeach
                </select>
            </div>

            <div class="text-center mb-6 form-margin">
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
            type="submit"
            >
            Update
            </button>
            </div>
          </form>
      </main>
  </section>

</x-app-layout>
