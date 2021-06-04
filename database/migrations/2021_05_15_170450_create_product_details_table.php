<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->string('title', 250)->nullable();
            $table->integer('ordering')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1); // active = 1
            $table->double('price', 8, 2)->nullable();
            $table->double('discount_price', 8, 2)->nullable();
            $table->integer('product_id');
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
        Schema::dropIfExists('product_details');
    }
}
