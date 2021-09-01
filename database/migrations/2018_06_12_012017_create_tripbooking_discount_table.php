<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripbookingDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripbookings_discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('early_booking_discount')->nullable();
            $table->mediumInteger('group_discount')->nullable();
            $table->mediumInteger('special_discount')->nullable();
            $table->mediumInteger('coupon_discount')->nullable();
            $table->unsignedInteger('book_id');
            $table->timestamps();

            $table->foreign('book_id')->references('bid')->on('trippayment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tripbookings_discounts');
    }
}
