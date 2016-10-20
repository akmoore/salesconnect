<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->index();
            $table->string('stations')->nullable();
            $table->string('editor')->nullable();
            $table->date('produced_by')->nullable();
            $table->double('edit_time')->default(0.0);
            $table->double('location_time')->default(0.0);
            $table->integer('vcd_vhs')->default(0);
            $table->integer('dvd')->default(0);
            $table->integer('beta_dub')->default(0);
            $table->integer('crawl')->default(0);
            $table->integer('ftp')->default(0);
            $table->integer('music_library')->default(0);
            $table->double('discount')->default(0);

            $table->date('vcd_vhs_date')->nullable();
            $table->date('dvd_date')->nullable();
            $table->date('beta_dub_date')->nullable();
            $table->date('crawl_date')->nullable();
            $table->date('ftp_date')->nullable();
            $table->date('music_library_date')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
