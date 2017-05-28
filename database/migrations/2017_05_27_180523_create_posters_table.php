<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32)->unique()->comment('活动名称');
            $table->string('key', 32)->unique()->comment('菜单中事件用的key');
            $table->string('get_message', 512)->comment('获取海报发送消息');
            $table->string('subscribe_message', 512)->comment('发送二维码被扫描的消息');
            $table->string('success_message', 512)->comment('达成次数的消息');
            $table->string('end_message', 512)->comment('活动结束的消息');
            $table->string('end_time', 512)->comment('活动名称');
            $table->string('number', 512)->comment('需要完成的数量');
            $table->boolean('is_send')->comment('完成后是否继续发送达成次数的消息');
            $table->string('img_url', 512)->nullable()->comment('海报图片url地址');
            $table->integer('avatar_size')->default(100)->comment('头像的宽和高');
            $table->integer('avatar_width')->default(200)->comment('头像距离左上角的宽度');
            $table->integer('avatar_height')->default(100)->comment('头像距离左上角的高度');
            $table->integer('nickname_size')->default(200)->comment('昵称长度');
            $table->string('nickname_color', 10)->default('#ffffff')->comment('头像距离左上角的宽度');
            $table->string('nickname_backgroup_color', 10)->default('#000000')->comment('头像距离左上角的高度');
            $table->integer('nickname_width')->default(410)->comment('昵称距离左上角的宽度');
            $table->integer('nickname_height')->default(100)->comment('昵称距离左上角的高度');
            $table->integer('qrcode_size')->default(400)->comment('头像的宽和高');
            $table->integer('qrcode_width')->default(400)->comment('头像距离左上角的宽度');
            $table->integer('qrcode_height')->default(600)->comment('头像距离左上角的高度');
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
        Schema::dropIfExists('posters');
    }
}
