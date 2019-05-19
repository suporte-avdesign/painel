<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->string('brand', 30);
            $table->string('section', 30);
            $table->string('category', 30);
            $table->string('color', 30);
            $table->string('code', 30);            
            $table->string('image',190);
            $table->string('slug', 190)->unique();            
            $table->string('html', 30)->nullable();
            $table->tinyInteger('kit')->default(0);
            $table->integer('stock')->unsigned()->default(0);
            $table->string('kit_name', 30)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('cover')->default(0);
            $table->char('order', 2);
            $table->tinyInteger('active');
            $table->smallInteger('visits')->default(0);
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
        Schema::dropIfExists('image_colors');
    }
}
