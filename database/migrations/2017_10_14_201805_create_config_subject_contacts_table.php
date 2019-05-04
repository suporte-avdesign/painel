<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigSubjectContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_subject_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 50);
            $table->longText('message');
            $table->tinyInteger('order');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('send_guest')->default(1);
            $table->tinyInteger('send_user')->default(1);
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
        Schema::dropIfExists('config_subject_contacts');
    }
}
