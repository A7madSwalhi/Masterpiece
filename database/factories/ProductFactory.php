<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'name' => $name,
            'vendor_id' => Vendor::inRandomOrder()->first()->id, // Random vendor ID
            'catetgory_id' => Category::inRandomOrder()->first()->id, // Random category ID
            'slug' => Str::slug($name),
            'SKU' => $this->faker->unique()->bothify('??###'), // Example SKU
            'long_description' => $this->faker->paragraph(),
            'short_description' => $this->faker->sentence(),
            'regular_price' => $this->faker->randomFloat(2, 10, 1000), // Price between 10 and 1000
            'discount_price' => $this->faker->randomFloat(2, 1, 999), // Price between 1 and 999
            'quantitiy' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'options' => json_encode(['color' => $this->faker->colorName, 'size' => $this->faker->word]), // Example options
            'image' => $this->faker->imageUrl(640, 480, 'products'), // Random image URL
            'status' => $this->faker->randomElement(['active', 'draft', 'inactive']), // Random status
            'brand_id' => Brand::inRandomOrder()->first()->id, // Random brand ID
            'featured' => $this->faker->boolean(50), // Randomly featured or not
        ];
    }
}
