<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloumnEndDateToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pj_product', function (Blueprint $table) {
            $table->timestamp('end_date')->useCurrent()->comment('商品下架日期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pj_product', function (Blueprint $table) {
            $table->dropColumn('end_date');
        });
    }
}
