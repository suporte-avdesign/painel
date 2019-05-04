<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('config_form_payment_id')->unsigned();
            $table->integer('config_status_payment_id')->unsigned();
            $table->smallInteger('qty')->default(0);
            $table->decimal('percent',8, 2)->nullable();
            $table->decimal('price_cash',8, 2)->default(0);
            $table->decimal('price_card',8, 2)->default(0);
            $table->decimal('subtotal',8, 2)->default(0);
            $table->decimal('discount',8, 2)->default(0);
            $table->decimal('freight',8, 2)->default(0);
            $table->decimal('tax',8, 2)->default(0);
            $table->float('weight', 8, 3)->nullable();
            $table->float('width', 8, 3)->nullable();
            $table->float('height', 8, 3)->nullable();
            $table->float('length', 8, 3)->nullable();
            $table->string('ip', 50);
            $table->string('token', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('config_form_payment_id')
                ->references('id')->on('config_form_payments')
                ->onDelete('cascade');
            $table->foreign('config_status_payment_id')
                ->references('id')->on('config_status_payments')
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
        Schema::dropIfExists('orders');
    }
}
