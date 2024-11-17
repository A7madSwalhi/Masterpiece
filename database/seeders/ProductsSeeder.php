<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Electronics
            [
                'name' => 'Samsung Galaxy Watch 6',
                'vendor_id' => 10,
                'catetgory_id' => 16,
                'slug' => Str::slug('Samsung Galaxy Watch 6'),
                'SKU' => 'ELEC-001',
                'long_description' => 'The latest Samsung Galaxy Watch 6 offers advanced health tracking, GPS, and a sleek design perfect for all-day wear. It’s equipped with powerful sensors to monitor your heart rate, steps, and sleep patterns.',
                'short_description' => 'Advanced smartwatch with health tracking.',
                'regular_price' => 299,
                'discount_price' => 249,
                'quantitiy' => 50,
                'options' => null,
                'image' => 'https://example.com/images/galaxy-watch.jpg',
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'vendor_id' => 10,
                'catetgory_id' => 31,
                'slug' => Str::slug('Sony WH-1000XM5 Headphones'),
                'SKU' => 'ELEC-002',
                'long_description' => 'Experience unmatched noise cancellation with Sony’s WH-1000XM5. These over-ear headphones offer up to 30 hours of battery life and superior sound quality with deep bass and clear highs.',
                'short_description' => 'Premium noise-canceling headphones.',
                'regular_price' => 349,
                'discount_price' => null,
                'quantitiy' => 30,
                'options' => null,
                'image' => 'https://example.com/images/sony-headphones.jpg',
                'status' => 'active',
                'featured' => false,
            ],

            // Fashion
            [
                'name' => 'Nike Air Zoom Running Shoes',
                'vendor_id' => 11,
                'catetgory_id' => 34,
                'slug' => Str::slug('Nike Air Zoom Running Shoes'),
                'SKU' => 'FASH-001',
                'long_description' => 'Lightweight and durable, Nike Air Zoom shoes are perfect for running. With breathable mesh and cushioned soles, they provide comfort for long distances.',
                'short_description' => 'Breathable running shoes for athletes.',
                'regular_price' => 120,
                'discount_price' => 99,
                'quantitiy' => 40,
                'options' => null,
                'image' => 'https://example.com/images/nike-air-zoom.jpg',
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Adidas Originals Hoodie',
                'vendor_id' => 11,
                'catetgory_id' => 32,
                'slug' => Str::slug('Adidas Originals Hoodie'),
                'SKU' => 'FASH-002',
                'long_description' => 'Comfortable and stylish, the Adidas Originals hoodie is made with soft fleece fabric to keep you warm during chilly days. Features the classic 3-stripe design.',
                'short_description' => 'Casual wear hoodie for comfort.',
                'regular_price' => 75,
                'discount_price' => null,
                'quantitiy' => 60,
                'options' => null,
                'image' => 'https://example.com/images/adidas-hoodie.jpg',
                'status' => 'active',
                'featured' => false,
            ],

            // Health & Beauty
            [
                'name' => 'Dyson Supersonic Hair Dryer',
                'vendor_id' => 13,
                'catetgory_id' => 19,
                'slug' => Str::slug('Dyson Supersonic Hair Dryer'),
                'SKU' => 'BEAUTY-001',
                'long_description' => 'The Dyson Supersonic Hair Dryer is engineered to protect hair from extreme heat damage, with fast drying and controlled styling. Ideal for all hair types.',
                'short_description' => 'Powerful hair dryer with heat control.',
                'regular_price' => 399,
                'discount_price' => 350,
                'quantitiy' => 25,
                'options' => null,
                'image' => 'https://example.com/images/dyson-hair-dryer.jpg',
                'status' => 'active',
                'featured' => true,
            ],
            [
                'name' => 'Maybelline Waterproof Eyeliner',
                'vendor_id' => 13,
                'catetgory_id' => 19,
                'slug' => Str::slug('Maybelline Waterproof Eyeliner'),
                'SKU' => 'BEAUTY-002',
                'long_description' => 'Achieve bold and precise lines with Maybelline’s waterproof eyeliner. Long-lasting formula that won’t smudge or fade, perfect for all-day wear.',
                'short_description' => 'Long-lasting waterproof eyeliner.',
                'regular_price' => 12,
                'discount_price' => 10,
                'quantitiy' => 100,
                'options' => null,
                'image' => 'https://example.com/images/maybelline-eyeliner.jpg',
                'status' => 'active',
                'featured' => false,
            ],

            // Home & Furniture
            [
                'name' => 'IKEA LACK Coffee Table',
                'vendor_id' => 12,
                'catetgory_id' => 18,
                'slug' => Str::slug('IKEA LACK Coffee Table'),
                'SKU' => 'HOME-001',
                'long_description' => 'The IKEA LACK coffee table is a modern and minimalist piece that fits any living room. It’s lightweight and easy to move, making it perfect for small spaces.',
                'short_description' => 'Minimalist coffee table.',
                'regular_price' => 49,
                'discount_price' => 45,
                'quantitiy' => 70,
                'options' => null,
                'image' => 'https://example.com/images/ikea-lack-table.jpg',
                'status' => 'active',
                'featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
