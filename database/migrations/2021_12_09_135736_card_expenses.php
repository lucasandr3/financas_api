<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CardExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_expenses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->unsignedInteger('card');
            $table->unsignedInteger('category');
            $table->string('title');
            $table->string('description')->nullable();
            $table->float('value');
            $table->tinyInteger('installments')->default(0);
            $table->integer('quantity_installments')->default(1);
            $table->string('photo')->nullable();
            $table->date('date_pay');
            $table->foreign('card')->references('id')->on('cards');
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
        Schema::dropIfExists('card_expenses');
    }
}
