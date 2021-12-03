<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventRevenue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_expense', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->unsignedInteger('id_category_event_expense');
            $table->string('title');
            $table->string('description');
            $table->tinyInteger('installments')->default(0);
            $table->integer('quantity_installments')->default(1);
            $table->foreign('id_category_event_expense')->references('id')->on('financial_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_expense');
    }
}
