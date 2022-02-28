<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRichMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rich_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('image')->nullable();
            $table->string('display_text')->nullable();
            $table->string('richmenu_id')->nullable();
            $table->boolean('default')->default(0);
            $table->string('text_a')->nullable();
            $table->string('text_b')->nullable();
            $table->string('text_c')->nullable();
            $table->string('text_d')->nullable();
            $table->string('text_e')->nullable();
            $table->string('text_f')->nullable();
            $table->string('url_a')->nullable();
            $table->string('url_b')->nullable();
            $table->string('url_c')->nullable();
            $table->string('url_d')->nullable();
            $table->string('url_e')->nullable();
            $table->string('url_f')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('account_id')->nullable();
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
        Schema::dropIfExists('rich_menus');
    }
}