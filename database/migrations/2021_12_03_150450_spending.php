<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Spending extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spending', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_spending_limit');
            $table->float('limit_value');
            $table->bigInteger('percent_alert');
            $table->date('final_date_spending');
            $table->foreign('category_spending_limit')->references('id')->on('financial_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spending');
    }
}
