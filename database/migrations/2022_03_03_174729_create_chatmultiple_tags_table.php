<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatmultipleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_multiple_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('chat_multiple_id')->unsigned();
            $table->unsignedBigInteger('tag_id')->unsigned();

            $table->foreign('chat_multiple_id')
                ->references('id')
                ->on('chat_multiples')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_multiple_tags');
    }
}