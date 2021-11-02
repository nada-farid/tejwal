<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFollowingsTable extends Migration
{
    public function up()
    {
        Schema::table('followings', function (Blueprint $table) {
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id', 'guide_fk_5203861')->references('id')->on('guides');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5203862')->references('id')->on('users');
        });
    }
}
