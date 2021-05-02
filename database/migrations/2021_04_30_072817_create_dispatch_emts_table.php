<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchEmtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_emts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dispatch_id')->comment('派車id');
            $table->integer('user_id')->comment('救護員');
            $table->integer('state')->comment('狀態');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatch_emts');
    }
}
