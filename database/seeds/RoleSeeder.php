<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('roles')->insert([
         ['name' => 'Desenvolvedor', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Administrador', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Funcionario', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
      ]);
   }
}
