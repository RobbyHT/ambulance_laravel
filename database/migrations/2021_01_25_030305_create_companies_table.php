<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_name')->comment('公司全名');
            $table->string('c_tel')->comment('公司電話');
            $table->string('c_addr')->comment('公司地址');
            $table->string('tax_id')->unique()->comment('統一編號');
            $table->string('principal')->comment('負責人');
            $table->string('principal_tel')->nullable()->comment('負責人電話');
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
        Schema::dropIfExists('companies');
    }
}
