<?php

$factory->define(App\Manager::class, function (Faker\Generator $faker) {
    $stations = ['nbc', 'fox'];
    $station = array_rand($stations, 1);
    $first_name = $faker->firstName;
    $last_name = $faker->lastName;
    $slug = strtolower($first_name) . '-' . strtolower($last_name);

    return [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'slug' => $slug,
        'work_phone' => $faker->tollFreePhoneNumber,
        'cell_phone' => $faker->tollFreePhoneNumber,
        'email' => $faker->email,
        'team' => $stations[$station]
    ];
});
