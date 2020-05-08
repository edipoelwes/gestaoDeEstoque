<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('clients')->insert([
         'company_id' => 1,
         'name' => 'Cliente de Teste',
         'created_at' => now(),
         'updated_at' => now(),
      ]);
   }
}
