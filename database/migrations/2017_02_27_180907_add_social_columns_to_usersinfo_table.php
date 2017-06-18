<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialColumnsToUsersinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usersInfo', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('avatar');
            $table->string('googleplus')->nullable()->after('facebook');
            $table->string('instagram')->nullable()->after('googleplus');
            $table->string('linkedin')->nullable()->after('instagram');
            $table->string('skype')->nullable()->after('linkedin');
            $table->string('snapchat')->nullable()->after('skype');
            $table->string('telegram')->nullable()->after('snapchat');
            $table->string('twitter')->nullable()->after('telegram');
            $table->string('whatsapp',13)->nullable()->after('twitter');
            $table->string('youtube')->nullable()->after('whatsapp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usersInfo', function (Blueprint $table) {
            $table->dropColumn('facebook');
            $table->dropColumn('googleplus');
            $table->dropColumn('instagram');
            $table->dropColumn('linkedin');
            $table->dropColumn('skype');
            $table->dropColumn('snapchat');
            $table->dropColumn('telegram');
            $table->dropColumn('twitter');
            $table->dropColumn('whatsapp');
            $table->dropColumn('youtube');
        });
    }
}
