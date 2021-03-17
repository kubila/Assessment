<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $file = Storage::disk('public')->allFiles('images');
        return [
            'productName' => $this->faker->word(5, true),
            'price' => $this->faker->numberBetween(100, 3000),
            'description' => $this->faker->words(10, true),
            'image' => $this->faker->randomElement($file), //$this->faker->image(),
            'category_id' => function () {
                return Category::all('id')->random();
            },
        ];
    }
}
