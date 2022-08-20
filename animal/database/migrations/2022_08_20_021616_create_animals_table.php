<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->string('area')->nullable();
            $table->boolean('fix')->default();
            $table->text('description')->nullbale();
            $table->text('personality')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // 軟刪除
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
