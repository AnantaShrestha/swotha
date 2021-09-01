<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coverimage', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
        Schema::table('trips', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
        Schema::table('trippackages', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
        Schema::table('about', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
        Schema::table('cities', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
        Schema::table('gallery', function (Blueprint $table) {
            $table->string('image_url')->nullable();
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
