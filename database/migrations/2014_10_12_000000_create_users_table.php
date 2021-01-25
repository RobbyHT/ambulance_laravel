<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->unique()->comment('員工編號');
            $table->string('name')->comment('姓名');
            $table->string('gender')->comment('性別');
            $table->string('birther')->comment('生日');
            $table->string('perid')->unique()->comment('身分證');
            $table->string('license_VP')->comment('EMT證照有效期');
            $table->integer('c_id')->comment('公司ID');
            $table->string('permission')->default('common')->comment('身分權限');
            $table->smallInteger('login_attempt')->nullable()->comment('嘗試登入次數');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
