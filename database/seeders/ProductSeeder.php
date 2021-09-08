<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Product::truncate();
        //DB::truncate('product_details');
        /*
        for ($i=0; $i < 30; $i++) { 
            //$name=$this->faker->sentence(2);
            Product::create([
                'name'=>$this->faker->sentence(2),
                'slug'=>Str::slug($this->faker->sentence(2)),
                'description'=>$this->faker->sentence(20),
                'price'=>$this->faker->randomFloat(3,1,20)
            ]);
        }
        */
        
 
        \App\Models\Product::factory(10)->create();
    }
}
