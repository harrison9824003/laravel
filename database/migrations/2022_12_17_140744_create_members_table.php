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
            $table->string('firstname')->comment('使用者姓氏');
            $table->string('lastname')->comment('使用者名子');
            $table->string('telephone')->comment('電話號碼');
            $table->string('account')->comment('使用者帳號');
            $table->text('email')->comment('使用者信箱');
            $table->string('address')->comment('地址')->nullable();
            $table->integer('city')->comment('縣市')->nullable();
            $table->integer('postCode')->comment('郵遞區號')->nullable();
            $table->integer('country')->comment('國家')->nullable();
            $table->integer('regionState')->comment('區域')->nullable();
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
