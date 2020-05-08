<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePucharseProductsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('pucharse_products', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('purchase_id');

         $table->string('name');
         $table->integer('amount');
         $table->decimal('pucharse_price', 10, 2);

         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('purchase_id')->references('id')->on('purchases');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('pucharse_products');
   }
}
