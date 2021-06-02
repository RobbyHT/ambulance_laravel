<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_records', function (Blueprint $table) {
            $table->increments('id');
            $table->text('start')->comment('起點');
            $table->double('start_lat')->comment('起點經度');
            $table->double('start_lng')->comment('起點緯度');
            $table->text('end')->comment('終點');
            $table->double('end_lat')->comment('終點經度');
            $table->double('end_lng')->comment('終點緯度');
            $table->string('d_date')->comment('日期');
            $table->string('d_time')->comment('時間');
            $table->boolean('o2')->comment('是否氧氣');
            $table->boolean('elevator')->comment('是否電梯');
            $table->boolean('special')->comment('是否特護');
            $table->double('weight')->comment('患者體重');
            $table->string('phone')->comment('患者電話');
            $table->text('remark')->nullable()->comment('備註');
            $table->integer('driver_id')->comment('司機編號');
            $table->integer('state')->comment('狀態');
            $table->integer('user_id')->comment('發布人編號');
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
        Schema::dropIfExists('dispatch_records');
    }
}
