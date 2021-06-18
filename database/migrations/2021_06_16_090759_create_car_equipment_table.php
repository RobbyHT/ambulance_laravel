<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_equipment', function (Blueprint $table) {
            $table->increments('id')->comment('車輛設備id');
            $table->integer('car_id')->comment('車輛id');
            $table->integer('equipment_id')->comment('設備id');
            $table->integer('amount')->comment('數量');
            $table->date('expiry_date')->comment('有效日期');
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
        Schema::dropIfExists('car_equipment');
    }
}
