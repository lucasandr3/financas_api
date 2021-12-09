<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LendingInstallments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->unsignedInteger('lending');
            $table->integer('installment');
            $table->float('value_installment');
            $table->date('pay');
            $table->foreign('lending')->references('id')->on('lendings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lending_installments');
    }
}
