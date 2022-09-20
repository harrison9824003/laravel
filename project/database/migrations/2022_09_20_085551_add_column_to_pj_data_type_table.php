<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPjDataTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pj_data_type', function (Blueprint $table) {
            //
            $table->string('class_name', 255)->comment('Class 名稱');
            $table->tinyInteger('disabled')->comment('是否隱藏')->default(0);
            $table->string('icon')->comment('圖標')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pj_data_type', function (Blueprint $table) {
            $table->dropCloumn(['class_name', 'disabled', 'icon']);
        });
    }
}
