<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['On Process', 'On Shipment', 'Finished', 'Canceled'])->default('On Process');
            $table->integer('total');
            $table->boolean('isVerified')->default(false);
            $table->enum('payment_status', ['UNPAID', 'PENDING', 'EXPIRED', 'CANCEL', 'SUCCESS'])->default('UNPAID');
            $table->string('snap_token', 36)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
