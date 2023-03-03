<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_mocks', function (Blueprint $table) {
            $table->integer('score')->default(null);
            $table->string('score_status');
            $table->string('user_id');
            $table->unsignedBigInteger('mock_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mock_id')->references('id')->on('mocks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_mocks');
    }
};
