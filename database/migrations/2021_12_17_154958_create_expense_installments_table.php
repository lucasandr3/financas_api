<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('FK_expense_installment_user');
            $table->unsignedInteger('expense')->index('FK_expense');
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
        Schema::dropIfExists('expense_installments');
    }
}
