<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++){
            DB::table('categories')->insert([
                //'title' => Str::random(10),
                'title' => 'Категория '. $i,
                'slug' => 'categoria-'. $i,
            ]);
        }

    }
}
