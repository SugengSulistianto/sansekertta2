<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_size', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 32);
            $table->unsignedBigInteger('size_id');
            $table->timestamps();

            $table->foreign('product_code')->references('code')
                ->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('size_id')->references('id')
                ->on('sizes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_size');
    }
}
