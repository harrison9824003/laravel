<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            //
            $table->text('_user_check')->nullable()->comment('使用者驗證token');
            $table->text('_token_')->nullable()->comment('使用者驗證token');
            $table->timestamp('_access_token_time', $precision = 0)->nullable()->comment('token使用時間');
            $table->timestamp('_refersh_token_time', $precision = 0)->nullable()->comment('token可更新時間');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
            $table->dropColumn('_user_check');
            $table->dropColumn('_token_');
            $table->dropColumn('_access_token_time');
            $table->dropColumn('_refersh_token_time');
        });
    }
}
