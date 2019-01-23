<?php

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
            $table->dateTime('usetime');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('employees');
            $table->string('telephone');
            $table->integer('type');
            $table->integer('manager');
            $table->foreign('manager')->references('id')->on('employees');
            $table->text('reason')->nullable();
            $table->string('passenger');
            $table->string('mobilephone');
            $table->boolean('isweekend')->default(false);
            $table->boolean('isreturn')->default(false);
            //$table->string('origin');
            //$table->string('end');
            $table->text('workers')->nullable();
            $table->integer('state')->default(0);
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
        Schema::drop('orders');
    }
}
