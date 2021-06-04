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
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('image', 250)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('type')->default(0)->comment('product = 0,combo = 1 '); //
            $table->tinyInteger('status')->default(1)->comment('active = 1, disable = 0');
            $table->double('price', 8, 3)->nullable();
            $table->integer('permission_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('ordering')->default(1);
            $table->integer('expiration')->default(0);
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
