<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class,5)->create();


       $products = Product::select('id')->get();

       foreach ($products as $product){
           $product->addMediaFromUrl('http://via.placeholder.com/640x480')->toMediaCollection('products');
       }

    }
}
