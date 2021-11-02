<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('naitev_language_id')->nullable();
            $table->foreign('naitev_language_id', 'naitev_language_fk_5203774')->references('id')->on('languages');
        });
    }
}
