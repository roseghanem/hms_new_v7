<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->text('scientific_name')->unique()->nullable(false);
            $table->text('arabic_name')->unique()->nullable(false);
            $table->text('effective_components')->nullable();
            $table->text('medicine_interactions')->nullable();
            $table->text('indications')->nullable();
            $table->text('dose')->nullable();
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
        Schema::dropIfExists('medicines');
    }
}
