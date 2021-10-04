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
            'name'=>$this->faker->name,
            'description'=>$this->faker->sentences($nbWords =6,$variabeNbWords=true),
            'price'=>$this->faker->randomFloat($min=1,$max=100),
            'qty'=>$this->faker->randomNumber($min=1,$max=100),
            'image'=>$this->faker->imageUrl($width=200,$height=200),
        ];
    }
}
