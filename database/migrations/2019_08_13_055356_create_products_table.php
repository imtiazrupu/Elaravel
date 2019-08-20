<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->text('description');
            $table->longText('long_description');
            $table->float('price');
            $table->string('image');
            $table->string('color');
            $table->string('stock');
            $table->boolean('status')->default(false);
            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');
                  $table->foreign('subcategory_id')
                  ->references('id')->on('sub_categories')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
