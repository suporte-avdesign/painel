<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('image_color_id')->unsigned();
            $table->integer('product_attribute_id')->unsigned();
            $table->integer('amount')->unsigned()->default(1);

            $table->foreign('product_attribute_id')
                ->references('id')->on('product_attributes');

            $table->foreign('image_color_id')
                ->references('id')->on('image_colors');

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
        Schema::dropIfExists('product_inputs');
    }
}
