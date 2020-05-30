<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
   return [
      'company_id' => 1,
      'name' => $faker->sentence($nbWords = 1),
   ];
});
