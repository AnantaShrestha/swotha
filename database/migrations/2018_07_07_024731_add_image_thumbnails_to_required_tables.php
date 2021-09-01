<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageThumbnailsToRequiredTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coverimage', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });
        Schema::table('trips', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });
        Schema::table('trippackages', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });
        Schema::table('about', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });
        Schema::table('cities', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });
        Schema::table('gallery', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });

        Schema::table('themes', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->string('image_url_thumb')->nullable();
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
