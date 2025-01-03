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
            // $table->id(); // bigint, auto_increment, primary key, ten field: id
            $table->increments('id'); //int, auto_increment, primary key
            $table->string('name', 200); //varchar(299), ten field: name
            $table->text('description')->nullable(); //text, ten field: description
            $table->timestamps(); // create_at, updated_at => timestamp
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
