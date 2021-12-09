<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lendings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lendings', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category');
            $table->string('company');
            $table->string('title');
            $table->longText('reason')->nullable();
            $table->float('value_lending');
            $table->float('interest')->nullable();
            $table->tinyInteger('installments')->default(0);
            $table->integer('quantity_installments')->default(1);
            $table->date('pay_date');
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
        Schema::dropIfExists('lendings');
    }
}
