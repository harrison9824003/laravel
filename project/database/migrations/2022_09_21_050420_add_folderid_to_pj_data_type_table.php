<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFolderidToPjDataTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pj_data_type', function (Blueprint $table) {
            $table->integer('folder_id')->comment('分類 id');
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
            $table->droppColumn('folder_id');
        });
    }
}
