<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('about_us', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('fax');
            $table->string('website');
            $table->string('facebook');
            $table->string('intro');
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
