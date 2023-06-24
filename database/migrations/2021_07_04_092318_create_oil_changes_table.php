<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_changes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('driver_id')->nullable(false);
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedBigInteger('car_id')->nullable(false);
            $table->foreign('car_id')->references('id')->on('cars');
            $table->date('change_date')->nullable(false);
            $table->Text('old_kilometrage')->nullable(false);
            $table->Text('new_kilometrage')->nullable(false);
            $table->Text('oil_type')->nullable(false);
            $table->float('quantity')->nullable(false);
            $table->boolean('filter')->nullable(false);
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
        Schema::dropIfExists('oil_changes');
    }
}
