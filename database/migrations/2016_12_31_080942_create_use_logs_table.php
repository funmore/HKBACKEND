<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUseLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            //$table->string('start_addr');
            //$table->string('end_addr');
            $table->text('worker')->nullable();
            $table->decimal('mileage')->nullable();
            $table->decimal('gq_fee')->nullable();
            $table->decimal('pause_fee')->nullable();
            $table->decimal('gs_fee')->nullable();
            $table->decimal('account');
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
        Schema::drop('use_logs');
    }
}
