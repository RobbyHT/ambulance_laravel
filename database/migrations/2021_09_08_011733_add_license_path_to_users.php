<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLicensePathToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->comment('電子郵件');
            $table->string('password')->nullable()->comment('密碼');
            $table->string('telphone')->nullable()->comment('連絡電話');
            $table->text('license_path')->nullable()->comment('EMT證照圖片路徑');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('telphone');
            $table->dropColumn('license_path');
        });
    }
}
