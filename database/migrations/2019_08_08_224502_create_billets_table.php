<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBilletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('status');
            $table->string('status_label', 50);
            $table->smallInteger('method_payment');
            $table->string('brand')->nullable();
            $table->integer('card_number')->nullable();
            $table->smallInteger('parcels')->nullable();
            $table->decimal('parcels_value', 8, 2)->default(0);
            $table->string('reference')->unique();
            $table->string('code')->unique();
            $table->decimal('value',8, 2);
            $table->text('link');
            $table->date('date');
            $table->date('date_refersh_status')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billets');
    }
}
