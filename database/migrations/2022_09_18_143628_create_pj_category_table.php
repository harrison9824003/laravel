<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_category', function (Blueprint $table) {
            $table->id()->increment();
            $table->integer('parent_id')->comment('父 id');
            $table->string('name', 255)->comment('分類名稱');
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
        Schema::dropIfExists('pj_category');
    }
}
