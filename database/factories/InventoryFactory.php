<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inventory;
use Faker\Generator as Faker;
use phpDocumentor\Reflection\Types\Null_;

$factory->define(Inventory::class, function (Faker $faker) {
   return [
      'company_id' => 1,
      'category_id' => $faker->numberBetween(1, 5),
      'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
      'price' => $faker->randomFloat(1, 2, 10),
      'amount' => $faker->randomDigitNotNull,
      'min_amount' => $faker->randomDigitNotNull,
   ];
});
