<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTruckLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_loads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id');
            $table->string('description')->nullable();
            $table->dateTime('load_date');
            $table->boolean('status')->default(0);
            $table->integer('book_id');
            $table->decimal('total_price', 10, 3);
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
        Schema::dropIfExists('truck_loads');
    }
}
