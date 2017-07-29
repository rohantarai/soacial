<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersinfo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_regno')->index();
            $table->string('academicYear_from', 4)->nullable();
            $table->string('academicYear_to', 4)->nullable();
            $table->string('high_school', 100)->nullable();
            $table->string('current_city', 20)->nullable();
            $table->string('hometown', 20)->nullable();
            $table->unsignedTinyInteger('born_day');
            $table->string('born_month', 10);
            $table->unsignedSmallInteger('born_year')->nullable();
            $table->string('relationship', 30)->nullable();
            $table->text('quotes')->nullable();
            $table->text('achievements')->nullable();
            $table->text('about')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('loggedIn')->default(false);
            $table->ipAddress('ipAddress')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usersInfo');
    }
}
