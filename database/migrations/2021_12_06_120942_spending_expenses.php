<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpendingExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spending_expenses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->unsignedInteger('spending');
            $table->unsignedInteger('category');
            $table->string('title');
            $table->string('description')->nullable();
            $table->float('value');
            $table->tinyInteger('installments')->default(0);
            $table->integer('quantity_installments')->default(1);
            $table->string('photo')->nullable();
            $table->date('date_spending_expense');
            $table->foreign('spending')->references('id')->on('spending');
            $table->foreign('category')->references('id')->on('financial_categories');
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
