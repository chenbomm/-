<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJyBrandTable extends Migration
{
    /**
     * Run the migrations.
     *商品品牌表
     * @return void
     */
    public function up()
    {
        Schema::create('jy_brand', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name',20)->default('')->comment('品牌名字');
            $table->enum('status',[1,2])->default('1')->comment('状态1,可用，2，禁用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jy_brand');
    }
}
