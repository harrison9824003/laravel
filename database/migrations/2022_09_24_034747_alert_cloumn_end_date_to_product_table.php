<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertCloumnEndDateToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pj_product', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');            
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
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent();
        });
    }
}
