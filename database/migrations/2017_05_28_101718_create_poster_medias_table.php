<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosterMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('poster_id')->comment('海报ID');
            $table->string('openid')->comment('缓存用户的openid');
            $table->string('media_id')->comment('缓存图片的media_id');
            $table->string('url')->comment('缓存图片的url');
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
        Schema::dropIfExists('poster_medias');
    }
}
