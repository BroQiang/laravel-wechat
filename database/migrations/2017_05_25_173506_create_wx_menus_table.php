<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wx_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',32)->comment('菜单名称,最多4个汉字');
            $table->string('type',16)->comment('菜单类型，暂时只支持 click 和 view');
            $table->string('action')->comment('根据菜单类型对应的动作，click 时候保存 Key，view 时保存跳转 url');
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
        Schema::dropIfExists('wx_menus');
    }
}
