<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('products', function ($table) {

            // Neu khong ton tai filed content
            if (!Schema::hasColumn('products', 'content')) {
                $table->text('content')->nullable()->after('description');
            }

            if (!Schema::hasColumn('products', 'status')) {
                $table->boolean('status')
                    ->default(0)
                    ->comment('Trang thai: 0 - Chua duyet, 1 - Da duyet')
                    ->after('content');
            }
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
        Schema::table('products', function ($table) {
            if (Schema::hasColumn('products', 'content')) {
                $table->dropColumn('content');
            }

            if (Schema::hasColumn('products', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
}
