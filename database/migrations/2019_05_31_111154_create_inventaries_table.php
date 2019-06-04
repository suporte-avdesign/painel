<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('grid_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->enum('profile_name', [
                constLang('profile_name.admin'),
                constLang('profile_name.user')
            ]);
            $table->enum('type_movement', [
                constLang('type_movement.input'),
                constLang('type_movement.output')
            ]);
            $table->text('note')->nullable();
            $table->string('brand', 30);
            $table->string('section', 30);
            $table->string('category', 30);
            $table->string('product', 60);
            $table->string('image')->nullable();
            $table->string('code', 20);
            $table->string('color', 20)->nullable();
            $table->string('grid')->nullable();
            $table->integer('amount')->default(0);
            $table->tinyInteger('kit');
            $table->string('kit_name', 30)->nullable();
            $table->tinyInteger('units')->default(0);
            $table->tinyInteger('offer');
            $table->decimal('cost_unit', 8, 2)->default(0);
            $table->decimal('cost_total', 8, 2)->default(0);
            $table->string('price_profile')->nullable();
            $table->decimal('price_unit', 8, 2)->default(0);
            $table->decimal('price_total', 8, 2)->default(0);
            $table->integer('stock')->default(0);
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
        Schema::dropIfExists('inventaries');
    }
}
