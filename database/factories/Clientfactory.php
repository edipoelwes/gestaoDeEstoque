<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
   return [
      'company_id' => 1,
      'name' => $faker->name,
      'document' => $faker->numberBetween($min = 10000000000, $max = 30000000000),
      'phone' => $faker->phoneNumber,
      'stars' => 3,
      'created_at' => $faker->dateTime(),
      'updated_at' => $faker->dateTime(),
   ];
});
