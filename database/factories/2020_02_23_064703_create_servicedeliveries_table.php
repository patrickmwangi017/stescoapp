<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicedeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicedeliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('bookedservice_id')->references('id')->on('bookedservices');
            $table->text('booking');
            $table->text('address')->nullable();
            $table->string('name')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('offerstatus')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicedeliveries');
    }
}
