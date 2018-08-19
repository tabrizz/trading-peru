<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_100')->nullable();
            $table->integer('bill_50')->nullable();
            $table->integer('bill_20')->nullable();
            $table->integer('bill_10')->nullable();
            $table->integer('coin_5')->nullable();
            $table->integer('coin_2')->nullable();
            $table->integer('coin_1')->nullable();
            $table->integer('cent_50')->nullable();
            $table->integer('cent_20')->nullable();
            $table->integer('cent_10')->nullable();
            $table->integer('clearing_id');
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
        Schema::dropIfExists('incomes');
    }
}
