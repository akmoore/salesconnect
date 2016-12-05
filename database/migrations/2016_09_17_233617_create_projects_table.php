<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->index();
            $table->integer('campaign_id')->index();
            $table->boolean('active');
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->integer('length');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('air_date')->nullable();
            $table->string('c_number')->nullable();
            $table->string('isci')->nullable();
            $table->boolean('production_free')->nullable();
            $table->string('music_track')->nullable();
            $table->boolean('production_promotional')->nullable();
            $table->string('youtube_link')->nullable();
            $table->boolean('new_client')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
