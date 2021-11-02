<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFavoritesTable extends Migration
{
    public function up()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5203970')->references('id')->on('users');
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id', 'trip_fk_5203971')->references('id')->on('trips');
        });
    }
}
