<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwitchToClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switch_to_clinics', function (Blueprint $table) {
            $table->id();
            $table->dateTime('req_date')->nullable(false);
            $table->text('notes')->nullable(true);


            $table->unsignedBigInteger('clinic_id')->nullable(false);
            $table->foreign('clinic_id')->references('id')->on('clinics');

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
        Schema::dropIfExists('switch_to_clinics');
    }
}
