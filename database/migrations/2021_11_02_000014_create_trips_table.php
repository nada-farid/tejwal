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
            $table->string('name_ar');
            $table->string('name_en');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->decimal('price', 15, 2);
            $table->string('currency_type');
            $table->string('car');
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id', 'guide_fk_5203889')->references('id')->on('guides');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
