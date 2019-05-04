<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')
                ->references('id')->on('sections')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('section', 50);
            $table->text('description')->nullable();
            $table->string('slug', 150)->unique();
            $table->string('tags', 255);
            $table->integer('visits');
            $table->char('order', 5);
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->enum('status_featured', ['Ativo', 'Inativo'])->default('Inativo');
            $table->enum('status_banner', ['Ativo', 'Inativo'])->default('Inativo');
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
        Schema::dropIfExists('categories');
    }
}
