<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpendingInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spending_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('spending_limit');
            $table->unsignedInteger('spending_expense');
            $table->integer('installment');
            $table->float('value_installment');
            $table->date('pay');
            $table->foreign('spending_limit')->references('id')->on('spending');
            $table->foreign('spending_expense')->references('id')->on('spending_expenses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spending_installments');
    }
}
