<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExpenseInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expense_installments', function (Blueprint $table) {
            $table->foreign(['expense'], 'FK_expense')->references(['id'])->on('expenses')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['user_id'], 'FK_expense_installment_user')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expense_installments', function (Blueprint $table) {
            $table->dropForeign('FK_expense');
            $table->dropForeign('FK_expense_installment_user');
        });
    }
}
