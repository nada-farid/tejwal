<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRattingsTable extends Migration
{
    public function up()
    {
        Schema::table('rattings', function (Blueprint $table) {
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id', 'guide_fk_5203868')->references('id')->on('guides');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5203869')->references('id')->on('users');
        });
    }
}
