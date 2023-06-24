<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_lots', function (Blueprint $table) {
            $table->id();
            $table->text('code')->unique()->nullable(false);
            $table->date('production_date')->nullable(false);
            $table->date('expire_date')->nullable(false);
            $table->date('insert_date')->nullable(false);
            $table->unsignedBigInteger('medicine_source_id')->nullable(false);
            $table->foreign('medicine_source_id')->references('id')->on('medicine_sources');
            $table->unsignedBigInteger('pharmacy_company_id')->nullable(false);
            $table->foreign('pharmacy_company_id')->references('id')->on('pharmacy_companies');
            $table->unsignedBigInteger('medicine_id')->nullable(false);
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->unsignedBigInteger('medicine_commercial_form_id')->nullable(false);
            $table->foreign('medicine_commercial_form_id')->references('id')->on('medicine_commercial_forms');
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
        Schema::dropIfExists('medicine_lots');
    }
}
