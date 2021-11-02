<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExperiencesTable extends Migration
{
    public function up()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id', 'guide_fk_5203856')->references('id')->on('guides');
        });
    }
}
