<?php

use Faker\Generator as Faker;

$factory->define(App\LendingContract::class, function(Faker $faker) {

    return [
        'user_id'         => factory(\App\User::class)->state('lender')->create()->id,
        'subscription_id' => 'lender_subscription',
        'access_token'    => 'lender_token',
        'from'            => \Illuminate\Support\Carbon::now()->addMonth(1)->day(10),
        'to'              => \Illuminate\Support\Carbon::now()->addMonth(1)->day(20),
        'amount'          => rand(1000, 200000),
        'rate'            => rand(2, 15),
        'suggested_rate'  => rand(1, 10),
    ];
});
