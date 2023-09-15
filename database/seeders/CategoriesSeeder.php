<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'category' => "Education",
            'category_slug' => 'education',

        ]);

        $category2 = Category::create([
            'category' => "Health",
            'category_slug' => 'health',

        ]);

        $category3 = Category::create([
            'category' => "Wellness",
            'category_slug' => 'wellness',
        ]);
    }
}
