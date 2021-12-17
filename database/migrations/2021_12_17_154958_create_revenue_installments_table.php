<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('FK_user_installment_revenue');
            $table->unsignedInteger('revenue')->index('FK_installment_revenue');
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
        Schema::dropIfExists('revenue_installments');
    }
}
