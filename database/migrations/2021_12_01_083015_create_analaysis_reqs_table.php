<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalaysisReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analaysis_reqs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->nullable(false);
            $table->text('notes')->nullable(false);

            $table->unsignedBigInteger('visit_id')->nullable(false);
            $table->foreign('visit_id')->references('id')->on('visits');

            $table->unsignedBigInteger('analaysis_category_id')->nullable(false);
            $table->foreign('analaysis_category_id')->references('id')->on('analysis_categories');
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
        Schema::dropIfExists('analaysis_reqs');
    }
}
