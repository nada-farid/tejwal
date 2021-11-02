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
            $table->time('start_time');
            $table->time('end_time');
            $table->string('companions');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
