<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSpendingTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spending_target', function (Blueprint $table) {
            $table->foreign(['user_id'], 'FK_spending_target_user')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['category_target'])->references(['id'])->on('financial_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spending_target', function (Blueprint $table) {
            $table->dropForeign('FK_spending_target_user');
            $table->dropForeign('spending_target_category_target_foreign');
        });
    }
}
