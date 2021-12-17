<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRevenueInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('revenue_installments', function (Blueprint $table) {
            $table->foreign(['revenue'], 'FK_installment_revenue')->references(['id'])->on('revenues')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'FK_user_installment_revenue')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revenue_installments', function (Blueprint $table) {
            $table->dropForeign('FK_installment_revenue');
            $table->dropForeign('FK_user_installment_revenue');
        });
    }
}
