<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('expenses', function (Blueprint $table) {
         $table->id();
         $table->unsignedBigInteger('company_id');
         $table->unsignedBigInteger('user_id');
         $table->string('name')->nullable();
         $table->text('description')->nullable();
         $table->integer('status')->nullable();
         $table->date('due_date')->nullable();
         $table->decimal('value', 10, 2)->default(0);
         $table->string('month_year')->default(strval(date('m/yy', strtotime(now()))));
         $table->timestamps();
         $table->softDeletes();

         $table->foreign('company_id')->references('id')->on('companies');
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
      Schema::dropIfExists('expenses');
   }
}
