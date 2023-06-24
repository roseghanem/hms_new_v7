<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterScanRequestAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_requests', function (Blueprint $table) {
            $table->foreign('scan_unit_id')->references('id')->on('scan_units');
            $table->foreign('visit_id')->references('id')->on('visits');

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scan_requests', function (Blueprint $table) {
            //
        });
    }
}
