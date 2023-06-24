<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddmissiomNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmissiom_notes', function (Blueprint $table) {
            $table->id();
            
            $table->dateTime('date')->nullable(false);
            $table->text('notes')->nullable(false);

            $table->unsignedBigInteger('visit_id')->nullable(false);
            $table->foreign('visit_id')->references('id')->on('visits');

            $table->unsignedBigInteger('division_id')->nullable(false);
            $table->foreign('division_id')->references('id')->on('divisions');

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
        Schema::dropIfExists('addmissiom_notes');
    }
}
