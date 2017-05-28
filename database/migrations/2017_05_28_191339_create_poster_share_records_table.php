<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosterShareRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_share_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poster_id')->comment('海报ID');
            $table->string('share_user_openid')->comment('分享海报的用户的ID');
            $table->string('scan_user_openid')->comment('分享海报的用户的ID');
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
        Schema::dropIfExists('poster_share_records');
    }
}
