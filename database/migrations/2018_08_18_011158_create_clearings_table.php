<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClearingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id');
            $table->decimal('income', 10, 3)->nullable();
            $table->decimal('expense', 10, 3)->nullable();
            $table->decimal('discount', 10, 3)->nullable();
            $table->decimal('credit', 10, 3)->nullable();
            $table->decimal('payment', 10, 3)->nullable();
            $table->decimal('balance', 10, 3)->nullable();
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
        Schema::dropIfExists('clearings');
    }
}
