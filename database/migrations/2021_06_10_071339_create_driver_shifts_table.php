<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->nullable(false);
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedBigInteger('park_shift_id')->nullable(false);
            $table->foreign('park_shift_id')->references('id')->on('park_shifts');
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
        Schema::dropIfExists('driver_shifts');
    }
}
