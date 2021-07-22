<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AfterTableProductsUpdateRow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price',15,0)->change();
            $table->decimal('price_discount',15,0)->nullable()->after('price');
            $table->decimal('price_import',15,0)->nullable()->after('price_discount');
            $table->tinyInteger('color')->nullable()->after('expiration');
            $table->string('size')->nullable()->after('expiration');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price_discount');
            $table->dropColumn('price_import');
            $table->dropColumn('color');
            $table->dropColumn('size');
        });
    }
}
