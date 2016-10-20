<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_user', function (Blueprint $table) {
            $table->integer('client_id');
            $table->integer('user_id');
        });

        // Schema::table('client_user', function ($table) {
        //    $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        //    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_user');
    }
}
