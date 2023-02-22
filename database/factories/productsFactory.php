<?php

namespace Database\Factories;

use App\Models\sections;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class productsFactory extends Factory
{





    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name'=>fake()->name(),
            'description'=>Str::random(30),
            // 'description'=>text(),
            'sections_id'=>rand(1,sections::get()->count()),
        ];
    }
}
