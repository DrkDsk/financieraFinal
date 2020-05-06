<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker ->name,
        'montoSuministrado' => $faker->numberBetween(1000,5000),
        'financiado' => $faker->numberBetween(1000,5000),
        'fechaMinistrado' => $faker->date,
        'fechaVencimiento' => $faker->date,
        'cuota' => $faker->numberBetween(100,200),
        'noPagos' => $faker->randomDigit,
        'pagosRealizados' => $faker->randomDigit,
        'abonado' => $faker->numberBetween(100,200),
        'saldoPendiente' => $faker->numberBetween(100,1000)
    ];
});
