<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_visits', function (Blueprint $table) {

            $table->id();

            $table->dateTime('date');

            $table->text('patient_history')->nullable(true);// القصة المرضية
            $table->text('medical_history')->nullable(true);// السوابق المرضية
            $table->text('surgical_history')->nullable(true);// السوابق الجراحية
            $table->text('family_history')->nullable(true); // السوابق العائلية
            $table->text('allergic_history')->nullable(true); //السوابق التحسسيية
            $table->text('habits')->nullable(true); // العادات

            $table->unsignedBigInteger('clinic_id')->nullable(false);
            $table->foreign('clinic_id')->references('id')->on('clinics');

            $table->unsignedBigInteger('doctor_id')->nullable(false);
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->unsignedBigInteger('out_patient_id')->nullable(false);
            $table->foreign('out_patient_id')->references('id')->on('out_patients');

            $table->unsignedBigInteger('disease_id')->nullable(false);
            $table->foreign('disease_id')->references('id')->on('diseases');

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
        Schema::dropIfExists('patient_visits');
    }
}
