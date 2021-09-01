<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomPaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custompayment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname',200)->nullable();
            $table->string('address',200)->nullable();
            $table->string('email',100)->nullable();
            $table->bigInteger('phone')->nullable();
            $table->date('tripdate')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('purpose')->nullable();
            $table->boolean('success')->nullable();
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
        Schema::dropIfExists('custompayment');
    }
}
