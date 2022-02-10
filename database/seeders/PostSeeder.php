<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$table->bigInteger('category_id')->unsigned();
        $table->string('title', 250);
        $table->text('description');
        $table->text('text');
        $table->string('slug')->unique();*/
        for($i = 7; $i < 150; $i++){
            DB::table('posts')->insert([
                'category_id' => rand(1,10),
                'title' => 'Пост №'. $i,
                'description' => 'Описание поста №'. $i,
                'text' => 'Lorem ' . $i . 'ipsum dolor sit amet, consectetur adipisicing elit. Commodi eos libero molestias, odio qui sapiente! Minus non perferendis repellendus repudiandae similique tempore! At cumque eos fuga mollitia nemo tenetur ut.',
                'slug' => 'posts-'. $i,
            ]);
        }
    }
}
