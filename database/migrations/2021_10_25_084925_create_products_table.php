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
            $table->bigIncrements('id');
            $table->text('sku')->nullable();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->text('price')->nullable();
            $table->text('sale_price')->nullable();
            $table->text('desc')->nullable();
            $table->longtext('content')->nullable();
            $table->text('image')->nullable();
            $table->text('more_image')->nullable();
            $table->integer('is_new')->nullable();
            $table->integer('hot')->nullable();
            $table->integer('review')->nullable();
            $table->integer('selling')->nullable();
            $table->integer('status')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
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
