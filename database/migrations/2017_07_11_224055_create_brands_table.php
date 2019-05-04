<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('contact', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('number', 20)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('state', 30)->nullable();
            $table->string('zip_code', 30)->nullable();
            $table->text('description')->nullable();
            $table->string('slug', 150)->unique();
            $table->string('tags', 255);
            $table->integer('visits');
            $table->char('order', 5);
            $table->enum('status', ['Ativo', 'Inativo']);
            $table->enum('status_logo', ['Ativo', 'Inativo'])->default('Inativo');
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
        Schema::dropIfExists('brands');
    }
}
