<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageSlidersTable extends Migration
{
    /**
     * Imagens dos sliders da home
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type',30);
            $table->string('title', 30)->nullable();
            $table->string('text', 30)->nullable();
            $table->text('description')->nullable();
            $table->text('link')->nullable();
            $table->string('image');
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->char('order', 2);
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
        Schema::dropIfExists('image_sliders');
    }
}
