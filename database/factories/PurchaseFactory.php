<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
   $date = $faker->dateTimeBetween($startDate = '2020-05-01 00:00:00', $endDate = 'now');
   return [
      'company_id' => 1,
      'user_id' => 1,
      'payment_method' => $faker->numberBetween(0, 3),
      'total' => $faker->randomFloat(2, 10, 30),
      'status' => $faker->numberBetween(1, 2),
      'provider' => $faker->name,
      'due_date' => $faker->dateTimeBetween('now', '+3 month'),
      'created_at' => $date,
      'updated_at' => $date,
   ];
});
