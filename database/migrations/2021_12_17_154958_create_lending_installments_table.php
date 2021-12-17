<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendingInstallmentsTable extends Migration
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
            $table->unsignedInteger('lending')->index('lending_installments_lending_foreign');
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
        Schema::dropIfExists('lending_installments');
    }
}
