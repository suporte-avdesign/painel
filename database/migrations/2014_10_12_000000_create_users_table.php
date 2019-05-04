<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')
                ->references('id')->on('config_profile_clients')->onDelete('cascade');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 50)->unique();
            $table->string('document1', 50);
            $table->string('document2', 50);
            $table->string('phone', 30);
            $table->string('cell', 30)->nullable();
            $table->string('admin', 30)->nullable();
            $table->string('token')->nullable();
            $table->string('password');
            $table->string('date', 10);
            $table->tinyInteger('client')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('newsletter')->default(0);
            $table->integer('visits')->default(0);
            $table->string('ip', 30);
            $table->dateTime('last_login')->nullable();
            $table->dateTime('logout')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

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
