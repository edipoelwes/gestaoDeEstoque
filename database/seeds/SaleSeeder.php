<?php

use App\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      factory(Sale::class, 100)->create();
   }
}
