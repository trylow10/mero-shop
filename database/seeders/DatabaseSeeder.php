<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Foundation\Testing\WithoutEvents;

class DatabaseSeeder extends Seeder
{

    // use WithoutModelEvents;

    public function run()
    {
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
