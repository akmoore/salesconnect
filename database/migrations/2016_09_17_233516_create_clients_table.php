<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agency_id')->nullable();
            $table->string('company_name');
            $table->string('slug')->unique();
            $table->string('primary_contact_first_name');
            $table->string('primary_contact_last_name');
            $table->string('primary_contact_title');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('postal');
            $table->string('public_phone');
            $table->string('primary_contact_phone');
            $table->string('primary_contact_email')->unique();
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
