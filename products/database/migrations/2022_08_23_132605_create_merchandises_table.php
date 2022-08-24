<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchandisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandises', function (Blueprint $table) {
            $table->increments('id');

            // 狀態 D : 下架
            // 狀態 L : 預上架
            // 狀態 S : 可販售
            $table->string( 'status', 1)->default('D');

            $table->string('name', 80)->nullable();
            $table->string('name_en', 80)->nullable();
            $table->text('introduction');
            $table->text('introduction_en');
            $table->string('photo')->default(0);
            $table->integer('price')->default(0);
            $table->integer('remain_count')->default(0);
            $table->timestamps();

            // 設定索引
            $table->index(['status'], 'merchandise_status_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchandises');
    }
}
