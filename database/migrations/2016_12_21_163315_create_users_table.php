<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reg_no')->unique();
            $table->string('first_name',20);
            $table->string('last_name',20);
            $table->string('gender');
            $table->string('institute');
            $table->string('programme')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('plainPassword');
            $table->boolean('verified')->default(false);
            $table->string('token')->index()->nullable();
            $table->rememberToken()->nullable();
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
        Schema::dropIfExists('users');
    }
}
