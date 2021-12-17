<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSpendingInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spending_installments', function (Blueprint $table) {
            $table->foreign(['spending_expense'])->references(['id'])->on('spending_expenses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['spending_limit'])->references(['id'])->on('spending')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spending_installments', function (Blueprint $table) {
            $table->dropForeign('spending_installments_spending_expense_foreign');
            $table->dropForeign('spending_installments_spending_limit_foreign');
        });
    }
}
