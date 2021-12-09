<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CardInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->unsignedInteger('card');
            $table->unsignedInteger('card_expense');
            $table->integer('installment');
            $table->float('value_installment');
            $table->date('pay');
            $table->foreign('card')->references('id')->on('cards');
            $table->foreign('card_expense')->references('id')->on('card_expenses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_installments');
    }
}
