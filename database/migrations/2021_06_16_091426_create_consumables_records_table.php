<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumablesRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumables_records', function (Blueprint $table) {
            $table->increments('id')->comment('耗材紀錄id');
            $table->integer('dispatch_id')->comment('車趟id');
            $table->integer('consumables_id')->comment('耗材id');
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
        Schema::dropIfExists('consumables_records');
    }
}
