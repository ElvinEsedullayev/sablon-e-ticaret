<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $name=$this->faker->sentence(2);
        return [
            
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->paragraph(5),
            'price'=>rand(1,100)/10
            
        ];
    }
}
