<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('price_default', 30);
            $table->tinyInteger('config_prices');
            $table->tinyInteger('view_prices');
            $table->tinyInteger('price_profile');
            $table->tinyInteger('cost');
            $table->tinyInteger('stock');
            $table->tinyInteger('freight');
            $table->tinyInteger('kit');
            $table->tinyInteger('colors');
            $table->tinyInteger('group_colors');
            $table->tinyInteger('positions');
            $table->tinyInteger('grids');
            $table->tinyInteger('reviews');
            $table->tinyInteger('quickview');
            $table->tinyInteger('wishlist');            
            $table->tinyInteger('compare');
            $table->tinyInteger('countdown');
            $table->tinyInteger('video');
            $table->string('mini_colors', 10);
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
        Schema::dropIfExists('config_products');
    }
}
