<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryHistoriesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('inventory_histories', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('inventory_id');
         $table->unsignedBigInteger('user_id');
         $table->string('action');
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('inventory_id')->references('id')->on('inventories');
         $table->foreign('user_id')->references('id')->on('users');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('inventory_histories');
   }
}
