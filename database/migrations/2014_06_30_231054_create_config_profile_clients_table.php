<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigProfileClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_profile_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->char('order', 2);
            $table->string('name', 50)->unique();
            $table->float('percent_cash');
            $table->float('percent_card');
            $table->enum('sum', ['+', '-']);
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
        Schema::dropIfExists('config_profile_clients');
    }
}
