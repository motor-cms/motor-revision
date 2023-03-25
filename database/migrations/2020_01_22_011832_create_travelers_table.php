<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTravelersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travelers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->integer('number_of_people');
            $table->string('mobile_phone');
            $table->string('flight_number');
            $table->string('flight_time');
            $table->string('direction');
            $table->integer('shuttle_id')->unsigned()->index()->nullable();
            $table->integer('airport_id')->unsigned()->index()->nullable();
            $table->string('ip_address');
            $table->string('user_agent');
            $table->datetime('info_sent_at')->nullable();
            $table->datetime('confirmation_sent_at')->nullable();
            $table->timestamps();

            $table->foreign('airport_id')->references('id')->on('airports')->onDelete('set null');
            $table->foreign('shuttle_id')->references('id')->on('shuttles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travelers');
    }
}
