<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('last_name');
            $table->string('mother_name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('city');//الأمانة//
            $table->string('code');//اللقيد//
            $table->string('gender');
            $table->string('address')->nullable(true);
            $table->integer('national_number');//الرقم الوطني//
            $table->integer('identity_number');//رقم الهوية//
            $table->unique(["first_name", "father_name","last_name","mother_name","birth_date"], 'patients_unique_name');
            $table->unique(["national_number"], 'patients_unique_national_number');
            $table->unique('national_number');
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
        Schema::dropIfExists('employees');
    }
}
