<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('code', 32)->primary()->index();
            $table->string('category_code', 32);
            $table->string('name');
            $table->string('photo');
            $table->integer('price');
            $table->double('weight');
            $table->integer('stock')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('category_code')->references('code')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
