<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('invites', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('email');
          $table->string('token', 32)->unique();
          $table->integer('redeemed_id')->nullable()->unsigned();
          $table->timestamp('redeemed_at')->nullable();
          $table->timestamps();
          $table->unique(['user_id', 'email']);
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('redeemed_user_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invites');
    }
}
