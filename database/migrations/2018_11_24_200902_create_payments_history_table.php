<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loan_granted_id');
            $table->foreign('loan_granted_id')->references('id')->on('loans_granted');
            $table->unsignedInteger('collector_id');
            $table->dateTime('payment_date')->nullable();
            $table->float('payment_amount_paid')->nullable();
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
        Schema::dropIfExists('payments_history');
    }
}
