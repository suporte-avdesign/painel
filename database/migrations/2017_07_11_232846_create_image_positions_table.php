<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_color_id')->unsigned();
            $table->foreign('image_color_id')
                ->references('id')->on('image_colors')->onDelete('cascade');
            $table->string('image',190);
            $table->char('order', 2);
            $table->tinyInteger('active');
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
        Schema::dropIfExists('image_positions');
    }
}
