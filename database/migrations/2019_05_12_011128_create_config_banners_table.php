<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type',30);
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->string('path');
            $table->smallInteger('width');
            $table->smallInteger('height');
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
        Schema::dropIfExists('config_banners');
    }
}
