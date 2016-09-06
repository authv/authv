<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_tokens', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->increments('id');
            $table->string('email');
            $table->string('token')->unique();
            $table->boolean('confirmed')->default(false);
            $table->boolean('expired')->default(false);
            $table->timestamps();
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
        Schema::dropIfExists('email_tokens');
    }
}
