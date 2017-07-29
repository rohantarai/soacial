<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableModifierToUserRegnoUsersinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usersinfo', function (Blueprint $table) {
            $table->unsignedBigInteger('user_regno')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usersinfo', function (Blueprint $table) {
            $table->unsignedBigInteger('user_regno')->nullable(false)->change();
        });
    }
}
