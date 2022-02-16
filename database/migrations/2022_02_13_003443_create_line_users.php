<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('LINEの名前');
            $table->string('line_id')->nullable()->comment('LINEのID');
            $table->string('provider')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('postcode')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('mode')->nullable()->comment('チャネルの状態'); // `standby` は送信すべきでない
            $table->timestamps();

            $table->unsignedBigInteger('account_id')->nullable()->comment('aid');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('line_users');
    }
}