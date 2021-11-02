<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTripsTable extends Migration
{
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id', 'guide_fk_5203889')->references('id')->on('guides');
        });
    }
}
