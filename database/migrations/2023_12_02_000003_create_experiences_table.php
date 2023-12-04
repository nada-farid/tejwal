<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->integer('years_of_experience');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_9231412570')->references('id')->on('cities');
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id', 'guide_fk_5203856')->references('id')->on('guides');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
