<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendingExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spending_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->unsignedInteger('spending')->index('spending_expenses_spending_foreign');
            $table->unsignedInteger('category')->index('spending_expenses_category_foreign');
            $table->string('title');
            $table->string('description')->nullable();
            $table->double('value', 8, 2);
            $table->tinyInteger('installments')->default(0);
            $table->integer('quantity_installments')->default(1);
            $table->string('photo')->nullable();
            $table->date('date_spending_expense');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spending_expenses');
    }
}
