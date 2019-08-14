<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->string('company_name',30);
            $table->smallInteger('method_payment');
            $table->smallInteger('status');
            $table->string('status_label', 50);
            $table->string('brand');
            $table->string('card_name');
            $table->string('card_document');
            $table->string('card_phone');
            $table->date('card_birth_date');
            $table->integer('card_number');
            $table->smallInteger('date_month');
            $table->smallInteger('date_year');
            $table->smallInteger('card_cvv');
            $table->smallInteger('parcels');
            $table->decimal('parcels_value', 8, 2)->default(0);
            $table->string('reference')->unique();
            $table->string('code')->unique();
            $table->decimal('value',8, 2);
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
        Schema::dropIfExists('payment_cards');
    }
}
