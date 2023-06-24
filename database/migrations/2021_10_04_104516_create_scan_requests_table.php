<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scan_requests', function (Blueprint $table) {
            $table->id();
            $table->dateTime('req_date')->nullable(false);
            $table->boolean('pregnant_woman');
            $table->boolean('patient_preparation');
            $table->unsignedBigInteger('out_patient_id')->nullable(false);
            //$table->foreign('out_patient_id')->references('id')->on('out_patients');
            $table->unsignedBigInteger('doctor_id')->nullable(false);
            //$table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedBigInteger('scan_unit_id')->nullable(false);
          //  $table->foreign('scan_unit_id')->references('id')->on('scan_units');
            $table->unsignedBigInteger('visit_id')->nullable(false);
            // $table->foreign('visit_id')->references('id')->on('visits');

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
        Schema::dropIfExists('scan_requests');
    }
}
