<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('drivers', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
        Schema::table('tours', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('image', 100);
            $table->string('seats', 10);
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
