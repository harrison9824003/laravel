<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_image', function (Blueprint $table) {
            $table->id()->increment();
            $table->integer('data_id')->comment('資料 id e.g. 商品');
            $table->integer('item_id')->comment('項目 id e.g. 商品編號 1');
            $table->string('path', 255)->comment('圖片路徑');
            $table->string('data_type', 50)->comment('圖檔類型');
            $table->string('description', 255)->comment('圖檔描述');

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
        Schema::dropIfExists('pj_image');
    }
}
