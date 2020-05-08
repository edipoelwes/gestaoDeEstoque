<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('sale_products', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('sale_id');
         $table->unsignedBigInteger('inventory_id');

         $table->integer('amount')->default(1);
         $table->decimal('sale_price', 10, 2);

         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('sale_id')->references('id')->on('sales');
         $table->foreign('inventory_id')->references('id')->on('inventories');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('sale_products');
   }
}
