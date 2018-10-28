<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function(Faker $faker) {

    return [
        'name'                => $faker->name,
        'email'               => $faker->unique()->safeEmail,
        'email_verified_at'   => now(),
        'password'            => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token'      => str_random(10),
        'score'               => rand(40, 95),
        'country'             => 'cy',
        'registration_number' => 'HE' . rand(160, 170000),
    ];
});

$factory->state(App\User::class, 'boc', [
    'email'               => 'demo@boc.com',
    'role'                => 'lender',
    'registration_number' => 'HE165'
]);

$factory->state(App\User::class, 'lender', [
    'role' => 'lender',
]);

$factory->state(App\User::class, 'borrower', [
    'role' => 'borrower',
]);
