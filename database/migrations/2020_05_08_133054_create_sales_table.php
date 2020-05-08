<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('sales', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('user_id');
         $table->unsignedBigInteger('client_id');
         $table->decimal('total_price', 10, 2)->default(0);
         $table->boolean('status')->nullable();
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
         $table->foreign('user_id')->references('id')->on('users');
         $table->foreign('client_id')->references('id')->on('clients');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('sales');
   }
}
