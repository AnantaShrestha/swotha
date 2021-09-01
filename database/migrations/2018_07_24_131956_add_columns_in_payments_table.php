<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('payment', function (Blueprint $table) {
		    $table->bigInteger('grandtotal')->nullable();
		    $table->bigInteger('paid_amount_sum')->nullable();
		    $table->bigInteger('left_amount_sum')->nullable();
		    $table->boolean('online_paid')->nullable();
	    });
	
	    Schema::table('trippayment', function (Blueprint $table) {
		    $table->bigInteger('grandtotal')->nullable();
		    $table->bigInteger('paid_amount_sum')->nullable();
		    $table->bigInteger('left_amount_sum')->nullable();
		    $table->boolean('online_paid')->nullable();
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
