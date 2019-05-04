<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigStatusPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_status_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('order');
            $table->smallInteger('status');
            $table->enum('type', ['C', 'S']);
            $table->string('gateway', 50);
            $table->string('label', 50)->unique();
            $table->text('description');
            $table->smallInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_status_payments');
    }
}
