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
$factory->define(CodePub\User::class, function (Faker\Generator $faker) {
    static $password;

    // return [
    //         'name' => 'André',
    //         'email' => 'admin@domain.com',
    //         'password' => $password ?: $password = bcrypt('secret'),
    //         'remember_token' => str_random(10),
    //     ];

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CodePub\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CodePub\Models\Book::class, function (Faker\Generator $faker) {
    return [
        'title' => ucfirst($faker->word),
        'subtitle' => $faker->sentence,
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 999), // 48.8932,
        'user_id' => rand(1, 10)
    ];
});
