<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('short_code')->nullable();
            $table->integer('phone_number')->nullable();
            $table->string('phone_code')->nullable();
            $table->boolean('active')->default(1)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
