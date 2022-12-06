<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePjDataTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_data_type', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name', 255)->comment('資料類型名稱');
            $table->string('class_name', 255)->comment('Class 名稱');
            $table->tinyInteger('disabled')->comment('是否隱藏')->default(0);
            $table->string('icon')->comment('圖標')->nullable();
            $table->string('router_path')->comment('路由路徑');
            $table->integer('folder_id')->comment('分類 id');
            
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
        Schema::dropIfExists('pj_data_type');
    }
}
