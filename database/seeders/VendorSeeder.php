<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $vendors =[
                [
                    'name' => 'Elite Clothing Co.',
                    'email' => 'contact@eliteclothing.com',
                    'password' => Hash::make('vendor123'), // Hashed password
                    'shop_name' => 'Elite Clothing',
                    'slug' => Str::slug('Elite Clothing'),
                    'description' => 'High-quality clothing for fashion-conscious individuals.',


                ],
                [
                    'name' => 'Tech Haven',
                    'email' => 'info@techhaven.com',
                    'password' => Hash::make('vendor123'), // Hashed password
                    'shop_name' => 'Tech Haven',
                    'slug' => Str::slug('Tech Haven'),
                    'description' => 'Your one-stop shop for the latest gadgets and electronics.',


                ],
                [
                    'name' => 'Green Grocers',
                    'email' => 'sales@greengrocers.com',
                    'password' => Hash::make('vendor123'), // Hashed password
                    'shop_name' => 'Green Grocers',
                    'slug' => Str::slug('Green Grocers'),
                    'description' => 'Organic fruits, vegetables, and farm-fresh produce.',


                ],
                [
                    'name' => 'Fitness Gear Pro',
                    'email' => 'support@fitnessgearpro.com',
                    'password' => Hash::make('vendor123'), // Hashed password
                    'shop_name' => 'Fitness Gear Pro',
                    'slug' => Str::slug('Fitness Gear Pro'),
                    'description' => 'Top-quality fitness equipment and accessories.',


                ],
                [
                    'name' => 'Gourmet Delights',
                    'email' => 'orders@gourmetdelights.com',
                    'password' => Hash::make('vendor123'), // Hashed password
                    'shop_name' => 'Gourmet Delights',
                    'slug' => Str::slug('Gourmet Delights'),
                    'description' => 'Exquisite gourmet food and specialty items.',

                ]
            ];


        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }
    }
}
