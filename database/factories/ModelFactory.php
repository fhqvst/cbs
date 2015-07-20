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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Instrument::class, function($faker) {

    $label = $faker->company;
    $name = snake_case($label);

   return [
       'symbol' => str_random(3),
       'name' => $name,
       'label' => $label,
       'market_id' => 1
   ];
});

$factory->define(App\Market::class, function($faker) {

    $label = $faker->cityPrefix . $faker->citySuffix;
    $name = snake_case($label);

    return [
        'name' => $name,
        'label' => $label
    ];
});
