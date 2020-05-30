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
         ['name' => 'Visualizar Usuarios', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Usuario', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Time', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Usuario', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Clientes */
         ['name' => 'Cadastrar Cliente', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Cliente', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Clientes', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Cliente', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Produtos */
         ['name' => 'Cadastrar Produto', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Produto', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Produtos', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Produto', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Vendas */
         ['name' => 'Cadastrar Venda', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Venda', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Vendas', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Venda', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Compras */
         ['name' => 'Cadastrar Compra', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Compra', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Compras', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Compra', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Empresa */
         ['name' => 'Cadastrar Empresa', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Empresa', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Empresas', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Empresa', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Perfil */
         ['name' => 'Cadastrar Perfil', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Perfil', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Perfil', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Perfil', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Permissoes de Permissoes */
         ['name' => 'Cadastrar Permissão', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Permissão', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Permissões', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Permissão', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /**Dashboard itens */
         ['name' => 'Visualizar Configurações', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Relatorios', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /** Home */
         ['name' => 'Visualizar itens', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

         /**Categorias */
         ['name' => 'Cadastrar Categoria', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Editar Categoria', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Visualizar Categorias', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
         ['name' => 'Deletar Categoria', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

      ]);
   }
}
