<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('image_color_id');
            $table->string('grid', 30);
            $table->tinyInteger('quantity');
            $table->string('image', 200);
            $table->string('color', 50);
            $table->string('code', 50);
            $table->tinyInteger('offer');
            $table->decimal('percent',8, 2);
            $table->decimal('price_card',8, 2);
            $table->decimal('price_cash',8, 2);
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
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('order_items');
    }
}
