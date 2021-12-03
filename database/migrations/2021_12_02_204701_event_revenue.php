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
            $table->integer('id_category_event_expense');
            $table->string('title');
            $table->string('description');
            $table->tinyInteger('installments')->default(0);
            $table->integer('quantity_installments')->nullable();
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
