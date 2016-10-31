<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSSOClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sso_clients', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned();
            $table->uuid('secret');
            $table->text('redirect');
            $table->boolean('revoked');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sso_clients');
    }
}
