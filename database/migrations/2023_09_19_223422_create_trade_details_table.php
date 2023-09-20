<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_details', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('trades_id');
            $table->enum('crypto_coins', ['litecoin','bitcoin','ethereum']);
            $table->float('amount',36,18);
            $table->string('currency', 4);
            $table->timestamps();

            $table->foreign('trades_id')->references('id')->on('trades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_details');
    }
};
