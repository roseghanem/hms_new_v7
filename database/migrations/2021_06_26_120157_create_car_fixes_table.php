<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarFixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_fixes', function (Blueprint $table) {
            $table->id();

            $table->date('date')->nullable(false);



            $table->Text('fix_place')->nullable();
            $table->Text('rubish_parts')->nullable();
            $table->longText('comitee_opinion')->nullable();
            $table->longText('fix_details')->nullable();
            $table->longText('description')->nullable();
            $table->longText('fix_price')->nullable();

            $table->unsignedBigInteger('driver_id')->nullable(false);
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedBigInteger('car_id')->nullable(false);
            $table->foreign('car_id')->references('id')->on('cars');
            $table->unsignedBigInteger('car_fix_type_id')->nullable(false);
            $table->foreign('car_fix_type_id')->references('id')->on('car_fix_types');
            $table->unsignedBigInteger('comitee_id')->nullable(false);
            $table->foreign('comitee_id')->references('id')->on('comitees');
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
        Schema::dropIfExists('car_fixes');
    }
}
