<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->text('description');
            $table->smallInteger('billet')->default(1);
            $table->smallInteger('cash')->default(1);
            $table->smallInteger('credit_card')->default(1);
            $table->smallInteger('debit_card')->default(1);
            $table->smallInteger('debit_account')->default(1);
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
        Schema::dropIfExists('companies');
    }
}
