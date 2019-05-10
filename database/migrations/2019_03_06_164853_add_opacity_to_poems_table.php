<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpacityToPoemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('poems', function (Blueprint $table) {
            $table->string('opacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('poems', function (Blueprint $table) {
            $table->dropColumn('opacity');
        });
    }
}
