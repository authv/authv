<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOAuthUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_users', function (Blueprint $table) {
          $table->integer('user_id')->unsigned()->nullable();
          $table->integer('provider_id')->unsigned();
          $table->string('id');
          $table->string('nickname')->nullable();
          $table->string('name')->nullable();
          $table->string('email')->nullable();
          $table->string('avatar')->nullable();
          $table->string('token');
          $table->string('refresh_token')->nullable();
          $table->string('expires_in')->nullable();
          $table->string('token_secret')->nullable();
          $table->timestamps();
          $table->primary(['provider_id', 'id']);
          $table->unique(['user_id', 'provider_id']);
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('provider_id')->references('id')->on('oauth_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('oauth_users');
    }
}
