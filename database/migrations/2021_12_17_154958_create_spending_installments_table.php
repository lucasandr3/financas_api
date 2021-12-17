<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendingInstallmentsTable extends Migration
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
            $table->string('company');
            $table->unsignedInteger('spending_limit')->index('spending_installments_spending_limit_foreign');
            $table->unsignedInteger('spending_expense')->index('spending_installments_spending_expense_foreign');
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
        Schema::dropIfExists('spending_installments');
    }
}
