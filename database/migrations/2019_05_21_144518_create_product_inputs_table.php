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
            $table->unsignedBigInteger('image_color_id');
            $table->unsignedBigInteger('product_attribute_id');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('image_color_id')->references('id')
                ->on('image_colors') ;
            $table->foreign('product_attribute_id')->references('id')
                ->on('product_attributes') ;

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
