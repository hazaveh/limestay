<?php

use Faker\Generator as Faker;

$factory->define(App\Property::class, function (Faker $faker) {
    return [
        'property_id' => uniqid('id'),
        'property_name' => 'test-property',
        'address' => $faker->address,
        'href' => $faker->url
    ];
});
