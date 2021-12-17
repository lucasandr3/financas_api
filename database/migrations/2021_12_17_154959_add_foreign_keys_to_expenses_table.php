<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreign(['id_category_expense'])->references(['id'])->on('financial_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['card'], 'FK_card')->references(['id'])->on('cards')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'FK_user_expense')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign('expenses_id_category_expense_foreign');
            $table->dropForeign('FK_card');
            $table->dropForeign('FK_user_expense');
        });
    }
}
