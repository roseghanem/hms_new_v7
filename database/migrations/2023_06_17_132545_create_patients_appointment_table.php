<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_appointment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable(false);
            $table->foreign('patient_id')->on('patients')->references('id');
            $table->dateTime('appointment_time');
            $table->dateTime('payment_time')->nullable();
            $table->boolean('is_temporary')->default(1);
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
        Schema::dropIfExists('patients_appointment');
    }
}
