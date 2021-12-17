<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCardExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_expenses', function (Blueprint $table) {
            $table->foreign(['card'])->references(['id'])->on('cards')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['category'])->references(['id'])->on('financial_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_expenses', function (Blueprint $table) {
            $table->dropForeign('card_expenses_card_foreign');
            $table->dropForeign('card_expenses_category_foreign');
        });
    }
}
