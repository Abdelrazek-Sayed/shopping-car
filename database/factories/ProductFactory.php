<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6),
            'image' => $this->faker->imageUrl($width = 640, $height = 480, 'products'),
            // 'image' => 'https://cdn.shopify.com/s/files/1/0070/7032/files/diy-product-photography.jpg?v=1599161908',
            'price' => $this->faker->numberBetween(50, 300),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
