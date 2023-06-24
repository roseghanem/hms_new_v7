<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDepartmentIntrancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_department_intrances', function (Blueprint $table) {
            $table->id();
            $table->text('note');

            $table->date('visit_date');
            $table->unsignedBigInteger('patient_id')->nullable(false);
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('department_id')->nullable(false);
            $table->foreign('department_id')->references('id')->on('departments');



            $table->text('referral_number')->nullable();
            $table->date('referral_date')->nullable();
            $table->text('bill_number')->nullable();
            $table->date('bill_date')->nullable();
            $table->text('doctor_diagnosiss')->nullable();
            $table->text('drugs')->nullable();
            $table->boolean('intrance')->nullable();
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
        Schema::dropIfExists('patient_department_intrances');
    }
}
