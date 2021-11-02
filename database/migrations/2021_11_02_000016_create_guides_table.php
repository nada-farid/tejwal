<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuidesTable extends Migration
{
    public function up()
    {
        Schema::create('guides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('brief_intro');
            $table->string('driving_licence');
            $table->string('car');
            $table->string('degree');
            $table->string('major');
            $table->decimal('cost', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
