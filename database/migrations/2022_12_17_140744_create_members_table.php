<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_members', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('使用者別稱');
            $table->string('account')->comment('使用者帳號');
            $table->string('email')->comment('使用者信箱');
            $table->string('pwd')->comment('使用者密碼');
            $table->timestamp('login_time')->comment('登入時間');
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
        Schema::dropIfExists('members');
    }
}
