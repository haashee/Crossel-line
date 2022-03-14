<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMultiplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_multiples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_identifier')->nullable();
            $table->mediumText('message')->nullable();
            $table->string('image_text')->nullable();
            $table->string('image_url')->nullable();
            $table->string('image')->nullable();
            $table->boolean('isAfter')->default(1);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();

            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
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
        Schema::dropIfExists('chat_multiples');
    }
}