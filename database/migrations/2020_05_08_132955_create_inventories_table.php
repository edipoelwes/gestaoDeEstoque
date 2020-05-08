<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('inventories', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->string('name');
         $table->decimal('price', 10, 2)->default(0);
         $table->integer('amount')->default(0);
         $table->integer('min_amount')->default(0);
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('inventories');
   }
}
