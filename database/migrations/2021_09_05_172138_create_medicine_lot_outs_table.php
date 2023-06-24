<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineLotOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_lot_outs', function (Blueprint $table) {
            $table->id();
            $table->text('code')->nullable(false)->unique();
            $table->date('export_date')->nullable(false);
            $table->unsignedBigInteger('medicine_id')->nullable(false);
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->unsignedBigInteger('medicine_commercial_form_id')->nullable(false);
            $table->foreign('medicine_commercial_form_id')->references('id')->on('medicine_commercial_forms');
            $table->unsignedBigInteger('medicine_out_type_id')->nullable(false);
            $table->foreign('medicine_out_type_id')->references('id')->on('medicine_out_types');
            $table->unsignedBigInteger('medicine_out_destination_id')->nullable(false);
            $table->foreign('medicine_out_destination_id')->references('id')->on('medicine_out_destinations');






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
        Schema::dropIfExists('medicine_lot_outs');
    }
}
