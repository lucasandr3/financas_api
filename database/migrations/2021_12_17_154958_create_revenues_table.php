<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('FK_user_revenue');
            $table->unsignedInteger('id_category')->index('revenues_id_category_foreign');
            $table->unsignedInteger('card')->nullable()->index('FK_card_revenue');
            $table->string('title');
            $table->string('description')->nullable();
            $table->double('value', 8, 2);
            $table->tinyInteger('installments')->default(0);
            $table->integer('quantity_installments')->default(1);
            $table->string('photo')->nullable();
            $table->dateTime('date_revenue')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revenues');
    }
}
