<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GithubSteamColumnUsersinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usersinfo', function (Blueprint $table) {
            $table->string('github')->nullable()->after('youtube');
            $table->string('steam')->nullable()->after('github');
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
            $table->dropColumn('github');
            $table->dropColumn('steam');
        });
    }
}
