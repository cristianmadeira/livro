<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //DB::statement('SET FOREIGN_KEY_CHECKS=0');

      if(!Schema::hasTable("users_books")){
        Schema::create('users_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean("readed")->default(0);
            $table->boolean("desired")->default(0);
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger("book_id");
            $table->foreign("book_id")->references("id")->on("books")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();

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
        Schema::dropIfExists('users_books');
    }
}
