<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'All kinds of electronic items',
                'slug' => Str::slug('Electronics'),
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothing and fashion accessories',
                'slug' => Str::slug('Fashion'),
            ],
            [
                'name' => 'Home & Kitchen',
                'description' => 'Items for home and kitchen use',
                'slug' => Str::slug('Home & Kitchen'),
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Health and beauty products',
                'slug' => Str::slug('Health & Beauty'),
            ],
        ];

        // Seed main categories
        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}
