<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->index();
            $table->boolean('prepro_schedule')->default(0);
            $table->boolean('shoot_schedule')->default(0);
            $table->boolean('initial_edit_done')->default(0);
            $table->boolean('first_revision')->default(0);
            $table->boolean('client_final_approval')->default(0);
            $table->boolean('received_po')->default(0);
            $table->boolean('upload_master_control')->default(0);
            $table->boolean('upload_youtube')->default(0);
            $table->boolean('archived')->default(0);
            $table->boolean('aired')->default(0);
            $table->integer('sum')->default(0);
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
        Schema::dropIfExists('progresses');
    }
}
