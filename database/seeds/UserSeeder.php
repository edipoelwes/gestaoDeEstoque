<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('users')->insert([
         'company_id'     => 1,
         'name'           => 'Edipo Elwes',
         'document'       => '03570590348',
         'email'          => 'edipoelwes2@gmail.com',
         'password'       => bcrypt('12345678'),
         'remember_token' => Str::random(10),
         'created_at'     => now(),
         'updated_at'     => now(),
      ]);
   }
}
