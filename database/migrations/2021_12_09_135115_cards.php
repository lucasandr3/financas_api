<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function(Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->string('institution');
            $table->string('title');
            $table->float('limit_card')->nullable();
            $table->float('annuity')->nullable();
            $table->bigInteger('percent_alert')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
