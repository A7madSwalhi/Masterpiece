<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $brands = [
            ['name' => 'Nike', 'slug' => 'nike'],
            ['name' => 'Adidas', 'slug' => 'adidas'],
            ['name' => 'Puma', 'slug' => 'puma'],
            ['name' => 'Reebok', 'slug' => 'reebok'],
            ['name' => 'Under Armour', 'slug' => 'under-armour'],
            ['name' => 'New Balance', 'slug' => 'new-balance'],
            ['name' => 'Asics', 'slug' => 'asics'],
            ['name' => 'Skechers', 'slug' => 'skechers'],
            ['name' => 'Vans', 'slug' => 'vans'],
            ['name' => 'Converse', 'slug' => 'converse'],
            ['name' => 'Levi’s', 'slug' => 'levis'],
            ['name' => 'Calvin Klein', 'slug' => 'calvin-klein'],
            ['name' => 'H&M', 'slug' => 'hm'],
            ['name' => 'Zara', 'slug' => 'zara'],
            ['name' => 'Gucci', 'slug' => 'gucci'],
            ['name' => 'Prada', 'slug' => 'prada'],
            ['name' => 'Versace', 'slug' => 'versace'],
            ['name' => 'Chanel', 'slug' => 'chanel'],
            ['name' => 'Dolce & Gabbana', 'slug' => 'dolce-gabbana'],
            ['name' => 'Ray-Ban', 'slug' => 'ray-ban'],
            ['name' => 'Oakley', 'slug' => 'oakley'],
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Apple', 'slug' => 'apple'],
            ['name' => 'Sony', 'slug' => 'sony'],
            ['name' => 'LG', 'slug' => 'lg'],
            ['name' => 'Dell', 'slug' => 'dell'],
            ['name' => 'HP', 'slug' => 'hp'],
            ['name' => 'Lenovo', 'slug' => 'lenovo'],
            ['name' => 'Microsoft', 'slug' => 'microsoft'],
            ['name' => 'Canon', 'slug' => 'canon'],
            ['name' => 'Nikon', 'slug' => 'nikon'],
            ['name' => 'GoPro', 'slug' => 'gopro'],
            ['name' => 'Bose', 'slug' => 'bose'],
            ['name' => 'Beats', 'slug' => 'beats'],
            ['name' => 'JBL', 'slug' => 'jbl'],
            ['name' => 'Fossil', 'slug' => 'fossil'],
            ['name' => 'Rolex', 'slug' => 'rolex'],
            ['name' => 'Casio', 'slug' => 'casio'],
            ['name' => 'Lacoste', 'slug' => 'lacoste'],
            ['name' => 'Tommy Hilfiger', 'slug' => 'tommy-hilfiger'],
            ['name' => 'Ralph Lauren', 'slug' => 'ralph-lauren'],
            ['name' => 'Mango', 'slug' => 'mango'],
            ['name' => 'Gap', 'slug' => 'gap'],
            ['name' => 'Old Navy', 'slug' => 'old-navy'],
            ['name' => 'American Eagle', 'slug' => 'american-eagle'],
            ['name' => 'Abercrombie & Fitch', 'slug' => 'abercrombie-fitch'],
            ['name' => 'Forever 21', 'slug' => 'forever-21'],
            ['name' => 'Sephora', 'slug' => 'sephora'],
            ['name' => 'L’Oréal', 'slug' => 'loreal'],
            ['name' => 'Maybelline', 'slug' => 'maybelline'],
            ['name' => 'Revlon', 'slug' => 'revlon'],
            ['name' => 'Dove', 'slug' => 'dove'],
            ['name' => 'Olay', 'slug' => 'olay'],
            ['name' => 'Nivea', 'slug' => 'nivea'],
            ['name' => 'Colgate', 'slug' => 'colgate'],
            ['name' => 'Gillette', 'slug' => 'gillette'],
            ['name' => 'Head & Shoulders', 'slug' => 'head-shoulders'],
            ['name' => 'Pampers', 'slug' => 'pampers'],
            ['name' => 'Nestlé', 'slug' => 'nestle'],
            ['name' => 'Coca-Cola', 'slug' => 'coca-cola'],
            ['name' => 'Pepsi', 'slug' => 'pepsi'],
            ['name' => 'Red Bull', 'slug' => 'red-bull'],
        ];

        foreach($brands as $brand){

            Brand::create($brand);

        }




    }
}
