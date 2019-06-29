<?php

use CodeShopping\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use CodeShopping\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        /** @var Collection $categories */
        $categories = Category::all();
        //Aula: Atribuindo categorias aos produtos na seeder
        factory(Product::class, 10)
            ->create()
            ->each(function(Product $product) use ($categories) {
                $categoryId = $categories->random()->id;
                $product->categories()->attach($categoryId);
            });
    }
}
