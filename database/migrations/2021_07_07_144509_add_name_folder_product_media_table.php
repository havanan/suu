<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameFolderProductMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_media', function (Blueprint $table) {
            //
            $table->string('name')->nullable()->after('id');
            $table->string('folder')->nullable()->after('type');
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_media', function (Blueprint $table) {
            //
            $table->dropColumn('name');
            $table->dropColumn('folder');
        });
    }
}
