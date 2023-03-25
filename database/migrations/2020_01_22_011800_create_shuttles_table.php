<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShuttlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shuttles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('airport_id')->unsigned()->index()->nullable();
            $table->dateTime('departs_at')->nullable();
            $table->dateTime('arrives_at')->nullable();
            $table->integer('price');
            $table->integer('seats');
            $table->integer('travel_time');
            $table->string('direction');
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->foreign('airport_id')->references('id')->on('airports')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shuttles');
    }
}
