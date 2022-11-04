<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjProductSpecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_product_spec', function (Blueprint $table) {
            $table->id()->increment();
            $table->integer('category_id')->comment('規格類別 id');
            $table->integer('product_id')->comment('商品 id');
            $table->integer('reserve_num')->comment('庫存');
            $table->integer('low_reserve_num')->comment('最低庫存');
            $table->string('volume', 100)->comment('材積');
            $table->string('weight', 100)->comment('重量');
            $table->integer('order')->comment('排序');

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
        Schema::dropIfExists('pj_product_spec');
    }
}
