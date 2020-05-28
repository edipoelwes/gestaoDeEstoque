<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
   $date = $faker->dateTimeBetween($startDate = '2020-05-01 00:00:00', $endDate = 'now');
   return [
      'company_id' => 1,
      'user_id' => 1,
      'client_id' => $faker->numberBetween(1, 30),
      'discount' => $faker->randomFloat(2, 1, 4),
      'total_price' => $faker->randomFloat(2, 10, 50),
      'status' => $faker->numberBetween(1, 3),
      'created_at' => $date,
      'updated_at' => $date,
   ];
});
