<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjRelationshipCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_relationship_category', function (Blueprint $table) {
            $table->id()->increment();
            $table->integer('data_id')->comment('資料 id e.g. 商品');
            $table->integer('category_id')->comment('類別 id');
            $table->integer('item_id')->comment('項目 id e.g. 商品編號 1');

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
        Schema::dropIfExists('pj_relationship_category');
    }
}
