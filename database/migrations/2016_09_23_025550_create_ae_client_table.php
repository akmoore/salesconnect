<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAeClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ae_client', function (Blueprint $table) {
            $table->integer('ae_id');
            $table->integer('client_id');
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
        Schema::dropIfExists('ae_client');
    }
}
