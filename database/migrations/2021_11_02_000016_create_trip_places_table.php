<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('place_name');
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id', 'trip_fk_52509567')->references('id')->on('trips');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id', 'city_fk_52500327')->references('id')->on('cities');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_places');
    }
}
