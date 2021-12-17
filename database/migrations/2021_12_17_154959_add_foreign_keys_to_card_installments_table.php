<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCardInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_installments', function (Blueprint $table) {
            $table->foreign(['card_expense'])->references(['id'])->on('card_expenses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['card'])->references(['id'])->on('cards')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_installments', function (Blueprint $table) {
            $table->dropForeign('card_installments_card_expense_foreign');
            $table->dropForeign('card_installments_card_foreign');
        });
    }
}
