<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTemplatesTable extends Migration
{
    /**
     * Configuração dos modulos das páginas do site
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('config_page_id')->unsigned();
            $table->foreign('config_page_id')
                ->references('id')->on('config_pages');
            $table->smallInteger('tmp');
            $table->string('name', 100);
            $table->string('module', 100);
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
        Schema::dropIfExists('config_templates');
    }
}
