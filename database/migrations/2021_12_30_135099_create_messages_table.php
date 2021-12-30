<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message');
            $table->tinyInteger('seen')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5226956')->references('id')->on('users');
            $table->unsignedBigInteger('conversation_id');
            $table->foreign('conversation_id', 'conversation_fk_5259956')->references('id')->on('conversations');
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
        Schema::dropIfExists('messages');
    }
}
