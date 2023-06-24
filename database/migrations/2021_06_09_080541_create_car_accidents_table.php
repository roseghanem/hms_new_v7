<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarAccidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_accidents', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(false);
            $table->unsignedBigInteger('driver_id')->nullable(false);
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedBigInteger('car_id')->nullable(false);
            $table->foreign('car_id')->references('id')->on('cars');
            $table->longText('description')->nullable(false);
            $table->text('police_no')->nullable();
            $table->date('police_date')->nullable();
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
        Schema::dropIfExists('car_accidents');
    }
}
