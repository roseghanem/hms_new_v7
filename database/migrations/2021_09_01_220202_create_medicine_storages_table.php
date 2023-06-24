<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_storages', function (Blueprint $table) {
            $table->id();
            $table->integer('num')->nullable(false)->default(0);
            $table->integer('min')->nullable(false)->default(0);
            $table->integer('max')->nullable(false)->default(0);
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
        Schema::dropIfExists('medicine_storages');
    }
}
