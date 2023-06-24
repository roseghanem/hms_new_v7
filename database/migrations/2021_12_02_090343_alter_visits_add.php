<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVisitsAdd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->text('patient_history')->nullable(true);
            $table->text('medical_history')->nullable(true);
            $table->text('surgical_history')->nullable(true);
            $table->text('family_history')->nullable(true);
            $table->text('allergic_history')->nullable(true);
            $table->text('habits')->nullable(true);
            $table->unsignedBigInteger('scan_req_id')->nullable(false);
            $table->foreign('scan_req_id')->references('id')->on('scan_requests');
   });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits', function (Blueprint $table) {
            //
        });
    }
}
