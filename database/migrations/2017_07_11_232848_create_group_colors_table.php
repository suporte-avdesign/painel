<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('config_color_group_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('image_color_id')->unsigned();
            $table->string('pinker', 30);
            $table->string('label', 30);

            $table->foreign('config_color_group_id')->references('id')
                ->on('config_color_groups')->onDelete('cascade');

            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');

            $table->foreign('image_color_id')->references('id')
                ->on('image_colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_colors');
    }
}
