<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_product', function (Blueprint $table) {
            $table->id()->increment();
            $table->string('name', 255)->comment('商品名稱');
            $table->integer('price')->comment('售價');
            $table->integer('market_price')->comment('建議售價');
            $table->string('simple_intro', 255)->comment('簡介');
            $table->text('intro')->comment('介紹');
            $table->string('part_number', 20)->comment('料號');
            $table->timestamp('start_date')->comment('上架日期');

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
        Schema::dropIfExists('pj_product');
    }
}
