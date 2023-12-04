<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('trip_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
