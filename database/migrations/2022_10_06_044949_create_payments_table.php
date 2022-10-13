<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('organization_id', 36);
            $table->string('card_name');
            $table->string('last_4digits');
            $table->string('expiration_date');
            $table->string('cvv');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });

        Schema::create('payment_charges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('card_id', 36);
            $table->string('organization_id', 36);
            $table->string('charge_event');
            $table->integer('amount');
            $table->dateTime('payment_date');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('payment_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('payment_cards');
        Schema::dropIfExists('payment_charges');
    }
}
