<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('suggestions_user_id_foreign');
            $table->unsignedInteger('category_suggestion')->index('suggestions_category_suggestion_foreign');
            $table->string('title');
            $table->longText('suggestion');
            $table->date('date_suggestion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggestions');
    }
}
