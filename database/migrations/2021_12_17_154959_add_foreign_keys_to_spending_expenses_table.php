<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSpendingExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spending_expenses', function (Blueprint $table) {
            $table->foreign(['category'])->references(['id'])->on('financial_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['spending'])->references(['id'])->on('spending')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spending_expenses', function (Blueprint $table) {
            $table->dropForeign('spending_expenses_category_foreign');
            $table->dropForeign('spending_expenses_spending_foreign');
        });
    }
}
