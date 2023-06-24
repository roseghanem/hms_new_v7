<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComiteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comitees', function (Blueprint $table) {
            $table->id();
            $table->dateTime('from_date')->nullable(false);
            $table->dateTime('to_date')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('comitee_type_id')->nullable(false);
            $table->foreign('comitee_type_id')->references('id')->on('comitee_types');
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
        Schema::dropIfExists('comitees');
    }
}
