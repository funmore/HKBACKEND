<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationsOfUses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations_of_uses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('use_id')->unsigned();
            $table->string('origin');
            $table->string('destination');
            $table->foreign('use_id')->references('id')->on('use_logs');
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
        Schema::drop('destinations_of_uses');
    }
}
