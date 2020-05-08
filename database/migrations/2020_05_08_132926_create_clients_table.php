<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('clients', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');

         $table->string('name');
         $table->string('document')->unique()->nullable();
         $table->string('phone')->nullable();
         $table->string('phone_secondary')->nullable();

         /** address */
         $table->string('zipcode')->nullable();
         $table->string('street')->nullable();
         $table->string('number')->nullable();
         $table->string('complement')->nullable();
         $table->string('neighborhood')->nullable();
         $table->string('state')->nullable();
         $table->string('city')->nullable();

         /**obs clients */
         $table->integer('stars')->default(3);
         $table->text('internal_obs')->nullable();

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
      Schema::dropIfExists('clients');
   }
}
