<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'productname' => $this->faker->word(),
            'creatorinfo' => $this->faker->word(),
            'title' => $this->faker->word(),
            'otherinfo' => $this->faker->word(),
            'productprice' =>$this->faker->numberBetween(10,15),
            
        ];
    }
}