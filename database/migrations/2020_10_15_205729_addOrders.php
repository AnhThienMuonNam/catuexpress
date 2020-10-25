<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name', 100);
            $table->string('customer_email', 100);
            $table->string('customer_phone', 12);
            $table->integer('no_of_passengers');
            $table->string('pick_up_location', 100);
            $table->dateTime('pick_up_time');

            $table->decimal('price', 9, 0);

            $table->integer('driver_id')->nullable()->unsigned();
            $table->foreign('driver_id')->references('id')->on('drivers');

            $table->integer('tour_id')->nullable()->unsigned();
            $table->foreign('tour_id')->references('id')->on('tours');

            $table->integer('order_status_id')->nullable()->unsigned();
            $table->foreign('order_status_id')->references('id')->on('order_statuses');

            $table->string('note', 5000)->nullable();
            $table->string('detail', 5000)->nullable();

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
        //
    }
}
