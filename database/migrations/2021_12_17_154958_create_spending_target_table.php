<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendingTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spending_target', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('FK_spending_target_user');
            $table->unsignedInteger('category_target')->index('spending_target_category_target_foreign');
            $table->double('value_target', 8, 2);
            $table->integer('limit_target_alert');
            $table->string('final_date', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spending_target');
    }
}
