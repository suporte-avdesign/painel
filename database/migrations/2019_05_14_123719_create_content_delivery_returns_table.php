<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentDeliveryReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_delivery_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->char('order', 3);
            $table->enum('status', ['Ativo', 'Inativo']);
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
        Schema::dropIfExists('content_delivery_returns');
    }
}
