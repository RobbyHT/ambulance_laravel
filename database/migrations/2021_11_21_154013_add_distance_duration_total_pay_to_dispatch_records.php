<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDistanceDurationTotalPayToDispatchRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatch_records', function (Blueprint $table) {
            $table->float('distance')->nullable()->comment('距離(km)');
            $table->integer('duration')->nullable()->comment('預估時間(mins)');
            $table->integer('totalPay')->nullable()->comment('預估車資(twd)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dispatch_records', function (Blueprint $table) {
            $table->dropColumn('distance');
            $table->dropColumn('duration');
            $table->dropColumn('totalPay');
        });
    }
}
