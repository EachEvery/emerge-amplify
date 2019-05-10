<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('poems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('email');
            $table->longText('json');
            $table->string('author')->nullable();
            $table->string('phone')->nullable();
            $table->string('video')->nullable();
            $table->string('photo')->nullable();
            $table->longText('all_text')->nullable();
            $table->unsignedInteger('text_id');
            $table->uuid('collection_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('poems');
    }
}
