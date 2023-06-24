<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_tasks', function (Blueprint $table) {
            $table->id();
            $table->dateTime('from_date')->nullable(false);
            $table->dateTime('to_date')->nullable(false);
            $table->text('line')->nullable(false);
            $table->text('length')->nullable(false);

            $table->text('kilo_start')->nullable(false);
            $table->text('kilo_end')->nullable(false);
            $table->text('responsible_person')->nullable(false);
            $table->text('note')->nullable();

            $table->integer('fuel')->nullable(false);



            $table->unsignedBigInteger('driver_id')->nullable(false);
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->unsignedBigInteger('car_id')->nullable(false);
            $table->foreign('car_id')->references('id')->on('cars');
            $table->unsignedBigInteger('car_task_type_id')->nullable(false);
            $table->foreign('car_task_type_id')->references('id')->on('car_task_types');
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
        Schema::dropIfExists('car_tasks');
    }
}
