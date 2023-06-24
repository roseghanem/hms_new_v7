<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->text('type')->nullable(false);
            $table->text('name')->nullable(false);
            $table->text('number')->nullable(false)->unique();
            $table->text('engine_number')->nullable()->unique();

            $table->text('fuel_type')->nullable(false);
            $table->integer('cylender_num')->nullable(false);
            $table->integer('cc_size')->nullable(false);
            $table->integer('fuel_size')->nullable(false);
            $table->text('car_code')->nullable(false)->unique();
            $table->text('chasse_number')->nullable()->unique();

            $table->text('city')->nullable(false);
            $table->text('color')->nullable(false);
            $table->float('weight')->nullable(false);
            $table->text('note')->nullable();
            $table->date('year_of_production')->nullable(false);
            $table->date('year_of_registration')->nullable(false);
            $table->unsignedBigInteger('car_type_id')->nullable(false);
            $table->foreign('car_type_id')->references('id')->on('car_types');
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
        Schema::dropIfExists('cars');
    }
}
