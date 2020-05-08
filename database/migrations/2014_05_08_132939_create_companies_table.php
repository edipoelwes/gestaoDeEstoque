<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('companies', function (Blueprint $table) {
         $table->id();
         $table->string('social_name');
         $table->string('alias_name');
         $table->string('document_company');
         $table->string('document_company_secondary');
         /** address */
         $table->string('zipcode')->nullable();
         $table->string('street')->nullable();
         $table->string('number')->nullable();
         $table->string('complement')->nullable();
         $table->string('neighborhood')->nullable();
         $table->string('state')->nullable();
         $table->string('city')->nullable();

         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('companies');
   }
}
