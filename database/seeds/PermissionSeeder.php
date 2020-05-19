<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      DB::table('permissions')->insert([

         /** Permissoes de Usuarios */
         ['name' => 'Cadastrar Usuario', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Usuario', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Vizualizar Usuarios', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Usuario', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Clientes */
         ['name' => 'Cadastrar Cliente', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Cliente', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Clientes', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Cliente', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Produtos */
         ['name' => 'Cadastrar Produto', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Produto', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Vizualizar Produtos', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Produto', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Vendas */
         ['name' => 'Cadastrar Venda', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Venda', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Vizualizar Vendas', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Venda', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Compras */
         ['name' => 'Cadastrar Compra', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Compra', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Vizualizar Compras', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Compra', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
      ]);
   }
}
