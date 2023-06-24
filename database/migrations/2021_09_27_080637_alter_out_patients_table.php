<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOutPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('out_patients', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id')->nullable(false);
            $table->unique(["patient_id"], 'patient_id_unique_name');
            $table->foreign('patient_id')->on('patients')->references('id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
