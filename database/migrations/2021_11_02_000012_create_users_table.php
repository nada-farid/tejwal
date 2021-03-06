<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('fcm_token',2000)->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('city')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('user_type')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
