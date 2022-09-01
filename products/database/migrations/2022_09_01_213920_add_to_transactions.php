<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
            $table->string('send_user')->comment('寄送人員');
            $table->string('send_email')->comment('寄送email');
            $table->string('user')->comment('收件人員');
            $table->string('email')->comment('收件email');
            $table->text('address')->comment('收件地址');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
            $table->dropColumn('send_user');
            $table->dropColumn('send_email');
            $table->dropColumn('user');
            $table->dropColumn('email');
            $table->dropColumn('address');
        });
    }
}
