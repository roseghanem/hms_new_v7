<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalIntrancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_intrances', function (Blueprint $table) {
            $table->id();
            $table->dateTime('in_date')->nullable(false);
            $table->dateTime('out_date')->nullable();
            $table->text('doctor_diagnosiss')->nullable();
            $table->text('patient_telephone')->nullable();
            $table->integer('hour_reservation')->nullable();

            $table->unsignedBigInteger('division_id')->nullable(false);
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->unsignedBigInteger('patient_id')->nullable(false);
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('doctor_id')->nullable(false);
            $table->foreign('doctor_id')->references('id')->on('doctors');


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
        Schema::dropIfExists('internal_intrances');
    }
}
