<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescuiptionReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('prescuiption_reqs');
        Schema::create('prescuiption_reqs', function (Blueprint $table) {
            $table->id();
            $table->text('scientific_name');
            $table->decimal('gag');
            $table->string('gag_unit');
            $table->integer('quantity')->nullable(false);
            $table->string('quantity_unit');
            $table->string('method_of_use');
            $table->dateTime('req_date')->nullable(false);
            $table->string('Treatment_Peroid');
            $table->unsignedBigInteger('drug_form_id')->nullable(false);
//            $table->foreign('drug_form_id')->references('id')->on('drug_forms');
            $table->unsignedBigInteger('visit_id')->nullable(false);
            $table->foreign('visit_id')->references('id')->on('visits');
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
        Schema::dropIfExists('prescuiption_reqs');
    }
}
