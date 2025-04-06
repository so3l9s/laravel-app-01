<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Laravel', 'PHP', 'JavaScript'];

        foreach ($categories as $name) {
            Category::firstOrCreate([
                'category_name' => $name,
                'slug' => Str::slug($name), // スラッグを生成
            ]);
        }
    }
}

