<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop\Customers\Customer;
use App\Shop\ProductComments\ProductComment;
use App\Shop\Products\Product;

$factory->define(ProductComment::class, function (Faker\Generator $faker) {
    $customer = factory(Customer::class)->create();
    $product = factory(Product::class)->create();

    return [
        'customer_id' => $customer->id,
        'product_id'  => $product->id,
        'comment'     => $faker->paragraph,
        'approved'    => $faker->boolean,
        'evaluation'  => $faker->numberBetween(0, 5),
    ];
});
