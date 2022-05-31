<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <= 20; $x++) {
        DB::table('store')->insert([
            'name' => Str::random(10),
            'description' => Str::random(10),
            'loc_id' => random_int(1, 9),
            'cat_id' => random_int(100, 999),
            'subcat_id' => random_int(10, 99),
            'price' => round(rand() * .000001,2 ),
        ]);
        }
    }
}
