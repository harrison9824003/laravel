<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_article', function (Blueprint $table) {
            $table->id()->increment();
            $table->string('title', 255)->comment('文章標題');
            $table->timestamp('start_date')->comment('上架日期');
            $table->text('content')->comment('內容');

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
        Schema::dropIfExists('pj_article');
    }
}
