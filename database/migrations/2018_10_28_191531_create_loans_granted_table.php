<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansGrantedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_granted', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedInteger('loan_type_id');
            $table->foreign('loan_type_id')->references('id')->on('loan_types');
            $table->integer('payments');
            $table->float('payment_amount');
            $table->integer('loan_fee');
            $table->float('amount');
            $table->float('total_amount');
            $table->float('updated_amount')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('loan_created_date')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('loans_granted');
    }
}