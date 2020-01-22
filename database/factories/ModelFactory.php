<?php

$factory->define(\Motor\Revision\Models\Ticket::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Motor\Revision\Models\Airport::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Motor\Revision\Models\Traveler::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Motor\Revision\Models\Shuttle::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Motor\Revision\Models\Ride::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Motor\Revision\Models\Sponsor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Motor\Revision\Models\Hotel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});
