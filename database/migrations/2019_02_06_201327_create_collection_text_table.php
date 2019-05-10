<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionTextTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('collection_text', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('collection_id');
            $table->unsignedInteger('text_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('collection_text');
    }
}
