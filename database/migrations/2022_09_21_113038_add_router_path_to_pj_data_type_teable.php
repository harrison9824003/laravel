<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRouterPathToPjDataTypeTeable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pj_data_type', function (Blueprint $table) {
            $table->string('router_path')->comment('路由路徑');
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
            $table->dropColumn('router_path');
        });
    }
}
