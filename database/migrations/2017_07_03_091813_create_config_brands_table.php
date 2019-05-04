<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('info');
            $table->smallInteger('grids');
            $table->smallInteger('description');
            $table->enum('img_default', ['D', 'B']);
            $table->string('path', 190);
            $table->smallInteger('img_logo');
            $table->smallInteger('width_logo');
            $table->smallInteger('height_logo');
            $table->smallInteger('img_banner');
            $table->smallInteger('width_banner');
            $table->smallInteger('height_banner');
            $table->smallInteger('width_modal');
            $table->smallInteger('height_modal');
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
        Schema::dropIfExists('config_brands');
    }
}
