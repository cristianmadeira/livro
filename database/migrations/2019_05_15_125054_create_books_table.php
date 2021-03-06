<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');

      if(!Schema::hasTable("books")){
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("author");
            $table->string("title");
            $table->string("isbn")->unique();
          
            //$table->timestamps();
        });
      }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
