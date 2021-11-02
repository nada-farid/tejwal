<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRattingsTable extends Migration
{
    public function up()
    {
        Schema::create('rattings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('rate', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
