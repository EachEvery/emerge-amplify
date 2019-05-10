<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('subtitle');
            $table->unsignedInteger('photo_display_height')->default(100);
            $table->string('photo')->nullable();
            $table->string('portal')->nullable()->unique();
            $table->boolean('poems_are_public')->default(0);
            $table->longText('referrer_whitelist')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
