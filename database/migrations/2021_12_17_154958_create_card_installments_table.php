<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardInstallmentsTable extends Migration
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
            $table->unsignedInteger('card')->index('card_installments_card_foreign');
            $table->unsignedInteger('card_expense')->index('card_installments_card_expense_foreign');
            $table->integer('installment');
            $table->double('value_installment', 8, 2);
            $table->date('pay');
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
