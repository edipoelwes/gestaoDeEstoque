<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('users', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->string('name');
         $table->string('email')->unique();
         $table->timestamp('email_verified_at')->nullable();
         $table->string('password');


         /** data */
         // $table->string('genre')->nullable();
         $table->string('document')->unique();
         // $table->string('document_secondary', 20)->nullable();
         // $table->string('document_secondary_complement')->nullable();
         // $table->date('date_of_birth')->nullable();
         // $table->string('place_of_birth')->nullable();
         // $table->string('civil_status')->nullable();
         $table->string('cover')->nullable();

         /** address */
         $table->string('zipcode')->nullable();
         $table->string('street')->nullable();
         $table->string('number')->nullable();
         $table->string('complement')->nullable();
         $table->string('neighborhood')->nullable();
         $table->string('state')->nullable();
         $table->string('city')->nullable();

         /** contact */
         $table->string('telephone')->nullable();
         $table->string('cell')->nullable();

         $table->boolean('admin')->default(1);

         $table->rememberToken();
         $table->dateTime('last_login_at')->nullable();
         $table->string('last_login_ip')->nullable();
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
      Schema::dropIfExists('users');
   }
}
