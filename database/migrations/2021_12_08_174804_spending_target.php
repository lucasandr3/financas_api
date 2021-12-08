<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpendingTarget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spending_target', function(Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->unsignedInteger('category_target');
            $table->float('value_target');
            $table->integer('limit_target_alert');
            $table->foreign('category_target')->references('id')->on('financial_categories');
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
