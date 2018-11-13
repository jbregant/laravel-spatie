<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('min_loan_payments');
            $table->string('max_loan_payments');
            $table->string('loan_fee');
            $table->unsignedInteger('frecuency_type_id');
            $table->foreign('frecuency_type_id')->references('id')->on('frecuency_types');
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
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('loan_types');

        Schema::enableForeignKeyConstraints();

    }
}

