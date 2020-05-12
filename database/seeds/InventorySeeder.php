<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventories')->insert([
           ['company_id' => 1, 'name' => 'Fralda MamyPoko Super Seca M Calça 30 Unidades', 'price' => 56.00, 'amount' => 10, 'min_amount' =>4,  'created_at' => now(), 'updated_at' => now()],
           ['company_id' => 1, 'name' => 'Fralda Huggies Supreme Care P Calça 20 Unidades', 'price' => 29.00, 'amount' => 10, 'min_amount' => 4,  'created_at' => now(), 'updated_at' => now()],
           ['company_id' => 1, 'name' => 'Fralda Pampers Super Seca G Calça 99 Unidades', 'price' => 64.00, 'amount' => 10, 'min_amount' => 4,  'created_at' => now(), 'updated_at' => now()],
           ['company_id' => 1, 'name' => 'Fralda PomPom Super Seca XG Calça 56 Unidades', 'price' => 32.00, 'amount' => 10, 'min_amount' => 4,  'created_at' => now(), 'updated_at' => now()],
           ['company_id' => 1, 'name' => 'Fralda BabySec Super Seca M Calça 24 Unidades', 'price' => 23.00, 'amount' => 10, 'min_amount' => 4,  'created_at' => now(), 'updated_at' => now()],
           ['company_id' => 1, 'name' => 'Fralda Hipopo Super Seca G Calça 64 Unidades', 'price' => 43.00, 'amount' => 10, 'min_amount' => 4,  'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
