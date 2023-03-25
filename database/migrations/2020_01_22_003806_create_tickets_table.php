<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('handle');
            $table->string('name');
            $table->string('company');
            $table->string('vat_id');
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('access_key');
            $table->text('comment');
            $table->text('internal_comment');
            $table->text('transportation');
            $table->boolean('is_anonymous');
            $table->integer('amount');
            $table->string('shirt_size');
            $table->integer('status')->unsigned();
            $table->string('ip_address');
            $table->string('user_agent');
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
        Schema::dropIfExists('tickets');
    }
}
