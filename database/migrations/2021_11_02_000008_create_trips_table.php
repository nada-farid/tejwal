<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trip_name');
            $table->longText('description');
            $table->decimal('price', 15, 2);
            $table->string('car');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
