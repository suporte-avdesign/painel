<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('config_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->smallInteger('delay')->nullable();
            $table->string('path');
            $table->smallInteger('width');
            $table->smallInteger('height');
            $table->smallInteger('width_thumb');
            $table->smallInteger('height_thumb');
            $table->smallInteger('width_modal');
            $table->smallInteger('height_modal');
            $table->timestamps();
        });
        /*
        Schema::create('config_slider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 30)->nullable();
            $table->string('text', 30)->nullable();
            $table->text('description')->nullable();
            $table->text('link')->nullable();
            $table->string('image');
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->char('order', 2);
            $table->smallInteger('delay')->nullable();
            $table->timestamps();
        });

        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_sliders');
    }
}
