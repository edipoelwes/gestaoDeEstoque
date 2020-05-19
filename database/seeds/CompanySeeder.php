<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('companies')->insert([
         [
            'social_name' => 'Sonhos de Ninar LTDA',
            'alias_name' => 'Sonhos de Ninar',
            'document_company' => '63565720000114',
            'document_company_secondary' => '5026485-1',
            /** address */
            'zipcode' => '64017705',
            'street' => 'Rua Cristo Redentor',
            'number' => '609',
            'neighborhood' => 'Três Andares',
            'state' => 'PI',
            'city' => 'Teresina',
            'created_at' => now(),
            'updated_at' => now(),
         ],
      ]);
   }
}
