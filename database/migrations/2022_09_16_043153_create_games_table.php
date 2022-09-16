<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team1_id');
            $table->unsignedBigInteger('team2_id');
            $table->unsignedBigInteger('progress_id');
            $table->unsignedBigInteger('captain1_id')->nullable();
            $table->unsignedBigInteger('captain2_id')->nullable();
            $table->date('date');
            $table->time('time');
            $table->integer('team1_goal')->default(0);
            $table->integer('team2_goal')->default(0);
            $table->timestamps();

            $table->foreign('team1_id')->references('id')->on('teams');
            $table->foreign('team2_id')->references('id')->on('teams');
            $table->foreign('captain1_id')->references('id')->on('players');
            $table->foreign('captain2_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
