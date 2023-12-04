<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('companions');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5203964')->references('id')->on('users');
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id', 'trip_fk_5203965')->references('id')->on('trips');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
