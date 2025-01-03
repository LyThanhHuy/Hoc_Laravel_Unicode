<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueSkuProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku', 10)->unique('sku_unique'); // tao field + danh index unique
            $table->unique('name'); // danh index unique cho field name
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique('sku_unique'); //Xoa index unique
            $table->dropColumn('sku'); //Xoa cot sku
            $table->dropUnique('products_name_unique'); //Xoa index unique
        });
    }
}
