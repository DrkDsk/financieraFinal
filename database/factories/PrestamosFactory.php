<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'montoSuministrado' => $faker->numberBetween(1000,5000),
        'fechaMinistracion' => $faker->date,
        'fechaVencimiento'  => $faker->date,
        'noPagos' => $faker ->randomDigit,
        'cuota' => $faker ->numberBetween(100,200),
        'total_a_pagar' => $faker ->numberBetween(1000,5000),
    ];
});
