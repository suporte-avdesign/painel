<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 100)->unique();
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('image_color_id')->unsigned();
            $table->integer('grid_product_id')->unsigned();
            $table->string('grid', 30);
            $table->tinyInteger('quantity');
            $table->string('image', 200);
            $table->string('color', 50);
            $table->string('code', 50);
            $table->string('profile', 30);
            $table->tinyInteger('offer');
            $table->decimal('percent',8, 2)->nullable();
            $table->decimal('price_card',8, 2)->default(0);
            $table->decimal('price_cash',8, 2)->default(0);
            $table->string('slug', 200);
            $table->smallInteger('kit');
            $table->string('kit_name', 30)->nullable();
            $table->string('name', 50);
            $table->string('category', 50);
            $table->string('section', 50);
            $table->string('brand', 50);
            $table->float('unit');
            $table->string('measure', 30);
            $table->float('weight', 8, 3)->nullable();
            $table->float('width', 8, 3)->nullable();
            $table->float('height', 8, 3)->nullable();
            $table->float('length', 8, 3)->nullable();
            $table->decimal('cost', 8, 2)->nullable();
            $table->string('ip', 50);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
            $table->foreign('image_color_id')
                ->references('id')->on('image_colors')
                ->onDelete('cascade');
            $table->foreign('grid_product_id')
                ->references('id')->on('grid_products')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
