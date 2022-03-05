<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRichmenuSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('richmenu_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('multiBtnA')->nullable();
            $table->json('multiBtnB')->nullable();
            $table->json('multiBtnC')->nullable();
            $table->mediumText('displayTextA')->nullable();
            $table->mediumText('displayTextB')->nullable();
            $table->mediumText('displayTextC')->nullable();
            $table->boolean('showRichmenu')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('richmenu_settings');
    }
}