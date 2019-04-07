<?php

use Faker\Generator as Faker;
use CodeShopping\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
