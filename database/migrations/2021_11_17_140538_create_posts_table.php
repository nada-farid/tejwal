<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 15, 2);
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('tourist_id');
            $table->foreign('tourist_id', 'tourist_fk_5203896')->references('id')->on('tourists');
            $table->foreign('lang_id', 'lang_fk_52509571')->references('id')->on('languages');
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
        Schema::dropIfExists('posts');
    }
}
