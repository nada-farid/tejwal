<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripTripCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('trip_trip_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id', 'trip_id_fk_5412508')->references('id')->on('trips')->onDelete('cascade');
            $table->unsignedBigInteger('trip_category_id');
            $table->foreign('trip_category_id', 'trip_category_id_fk_52512t08')->references('id')->on('trip_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }
}
