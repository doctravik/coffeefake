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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->text,
        'price' => $faker->numberBetween($min = 100, $max = 500),
        'stock' => $faker->numberBetween($min = 1, $max = 5)
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'hash' => bin2hex(random_bytes(32)),
        'paid' => false,
        'subtotal' => 0,
        'address_id' => factory(\App\Address::class)->create()->id,
        'customer_id' => factory(\App\Customer::class)->create()->id,
    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {
    return [
        'country' => $faker->country,
        'city' => $faker->city,
        'address1' => $faker->streetAddress,
        'address2' => $faker->streetAddress,
        'postal_code' => $faker->postcode
    ];
});

$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    return [
        'amount' => $faker->numberBetween($min = 100, $max = 500),
        'success' => true,
        'order_id' => factory(App\Order::class)->create()->id,
        'transaction_id' => 'transaction_id'
    ];
});