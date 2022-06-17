<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class loginseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {
            DB::table('users')->insert([
                'name' => 'Trilochan Aryal',
                'email' => 'aryaltrylowchan@gmail.com',
                'password' => '12345678',
            ]);
        }
    }
}
