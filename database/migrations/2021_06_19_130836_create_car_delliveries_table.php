<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarDelliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_delliveries', function (Blueprint $table) {
            $table->id();
            $table->date('from_date')->nullable(false);
            $table->date('to_date')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable(false);
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedBigInteger('car_id')->nullable(false);
            $table->foreign('car_id')->references('id')->on('cars');
            $table->unsignedBigInteger('car_dellivery_type_id')->nullable(false);
            $table->foreign('car_dellivery_type_id')->references('id')->on('car_dellivery_types');
            $table->longText('description')->nullable();
            $table->longText('accesories')->nullable();
            $table->longText('sub_accesories')->nullable();
            $table->Text('out_state')->nullable();
            $table->Text('in_state')->nullable();
            $table->Text('engine_state')->nullable();
            $table->Text('tires_state')->nullable();

            $table->Text('electricity_state')->nullable(false);
            $table->Text('battery_state')->nullable(false);
            $table->Text('dozan_state')->nullable(false);
            $table->Text('light_state')->nullable(false);
            $table->integer('tire_size')->nullable(false);
            $table->Text('delliver_person')->nullable(false);
            $table->date('tire_date')->nullable(false);
            $table->Text('kilometrage')->nullable(false);

            $table->longText('note')->nullable();
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
        Schema::dropIfExists('car_delliveries');
    }
}
