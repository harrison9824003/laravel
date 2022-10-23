<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEditToArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pj_article', function (Blueprint $table) {
            $table->timestamp('start_date')->unllable()->useCurrent();
            $table->timestamp('end_date')->unllable()->useCurrent();
            $table->string('sub_title', 255)->comment('文章副標題')->nullable();
            $table->tinyInteger('is_active')->comment('是否上架')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pj_article', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('sub_title');
            $table->dropColumn('is_active');
        });
    }
}
