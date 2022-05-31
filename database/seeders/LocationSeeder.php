<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <= 20; $x++) {
        DB::table('location')->insert([
            'name' => Str::random(10),
            'description' => Str::random(10),
        ]);
        }
    }
}
