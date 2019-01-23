<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accept_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('u_id')->unsigned();
            $table->foreign('u_id')->references('id')->on('employees');
            $table->integer('d_id')->unsigned()->nullable();
            $table->foreign('d_id')->references('id')->on('drivers');
            $table->integer('c_id')->unsigned()->nullable();
            $table->foreign('c_id')->references('id')->on('cars');
            $table->text('remark')->nullable();
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
        Schema::drop('accept_logs');
    }
}
