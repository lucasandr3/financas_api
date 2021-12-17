<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLendingInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lending_installments', function (Blueprint $table) {
            $table->foreign(['lending'])->references(['id'])->on('lendings')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lending_installments', function (Blueprint $table) {
            $table->dropForeign('lending_installments_lending_foreign');
        });
    }
}
