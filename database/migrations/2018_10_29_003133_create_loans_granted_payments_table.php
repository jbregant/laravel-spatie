<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansGrantedPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_granted_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loan_granted_id');
            $table->foreign('loan_granted_id')->references('id')->on('loans_granted');
            $table->integer('payment_number');
            $table->dateTime('due_date');
            $table->float('payment_amount')->nullable();
//            $table->float('payment_partial')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->float('payment_amount_paid')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('loans_granted_payments');
    }
}
