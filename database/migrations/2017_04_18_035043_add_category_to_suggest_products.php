<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryToSuggestProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggest_products', function (Blueprint $table) {
            $table->string('product_name')->nullbale()->change();
            $table->string('category_name')->nullbale()->change();
            $table->string('sub_category_name')->nullbale();
            $table->integer('sub_category_id')->nullbale();
            $table->integer('category_id')->nullbale();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggest_products', function (Blueprint $table) {
            $table->string('product_name')->change();
            $table->string('category_name')->change();
            $table->dropColumn('sub_category_name');
            $table->dropColumn('sub_category_id');
            $table->dropColumn('category_id');
        });
    }
}
