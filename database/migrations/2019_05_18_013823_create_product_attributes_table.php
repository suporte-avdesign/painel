<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id')->unsigned();
            $table->integer('image_color_id')->unsigned();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('stock')->unsigned()->default(0);

            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('image_color_id')
                ->references('id')->on('image_colors')->onDelete('cascade');
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
        Schema::dropIfExists('product_attributes');
    }
}
