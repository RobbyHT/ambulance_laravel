<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferentials', function (Blueprint $table) {
            $table->increments('id')->comment('耗材id');
            $table->string('title')->comment('名稱');
            $table->text('content')->comment('地址');
            $table->integer('discount')->comment('電話');
            $table->softDeletes();
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
        Schema::dropIfExists('preferentials');
    }
}
