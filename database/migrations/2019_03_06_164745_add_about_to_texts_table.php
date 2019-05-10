<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAboutToTextsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('texts', function (Blueprint $table) {
            $table->longText('about_text')->nullable();
            $table->string('about_link')->nullable();
            $table->string('about_button_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('texts', function (Blueprint $table) {
            $table->dropColumn('about_text');
            $table->dropColumn('about_link');
            $table->dropColumn('about_button_text');
        });
    }
}
