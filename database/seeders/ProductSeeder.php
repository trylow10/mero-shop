<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Seeder\Int;
use Illuminate\Support\Str;
// use Illuminate\Support\Int;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = [
            [
                'name' => 'Samsung Galaxy',
                'description' => 'Samsung Brand',
                'image' => '{"image0":"165640129296.jpg","image1":"165640129234.png"}',
                'price' => 100,
                'discount' => 10
            ],
            [
                'name' => 'Apple iPhone 12',
                'description' => 'Apple Brand',
                'image' => '{"image0":"165640129296.jpg","image1":"165640129234.png"}',
                'price' => 500,
                'discount' => 20
            ],
            [
                'name' => 'Google Pixel 2 XL',
                'description' => 'Google Pixel Brand',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=Google',
                'price' => 400,
                'discount' => 10
            ],
            [
                'name' => 'LG V10 H800',
                'description' => 'LG Brand',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=LG',
                'price' => 200,
                'discount' => 10
            ]
        ];

        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
