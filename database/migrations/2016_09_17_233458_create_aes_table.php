<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manager_id')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('work_phone');
            $table->string('cell_phone');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aes');
    }
}
